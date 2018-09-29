<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 25.09.18
 * Time: 21:35
 */

namespace itscoding\flickrgallery\fields;


use Craft;
use craft\base\ElementInterface;
use craft\base\Field;
use craft\helpers\Json;
use h2g\ytilitu\assetbundles\field\FieldAsset;
use itscoding\flickrgallery\entities\FlickrAlbum;
use itscoding\flickrgallery\jobs\AlbumJob;
use itscoding\flickrgallery\services\FlickrAlbumClient;
use itscoding\flickrgallery\services\FlickrClient;
use itscoding\flickrgallery\services\parser\AlbumParser;
use yii\db\Schema;


/**
 * Class FlickrField
 * @package itscoding\flickrgallery\fields
 */
class FlickrField extends Field
{

    const FLICKR_ID = 'id';

    const LOAD_FROM_FRONTEND = 'load_fe';

    /**
     * @var FlickrAlbumClient
     */
    private $flickrAlbumClient;

    /**
     * @return string The display name of this class.
     */
    public static function displayName(): string
    {
        return Craft::t('flickr-gallery', 'youtube.link');
    }


    public function init()
    {
        parent::init();
        $this->flickrAlbumClient = new FlickrAlbumClient(
            new FlickrClient(),
            new AlbumParser()
        );
    }

    /**
     * @param $value
     * @param ElementInterface|null $element
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \yii\base\Exception
     * @throws \yii\base\InvalidConfigException
     */
    public function getInputHtml($value, ElementInterface $element = null): string
    {

        // Register our asset bundle
        Craft::$app->getView()->registerAssetBundle(FieldAsset::class);

        // Get our id and namespace
        $id = Craft::$app->getView()->formatInputId($this->handle);
        $namespacedId = Craft::$app->getView()->namespaceInputId($id);

        // Variables to pass down to our field JavaScript to let it namespace properly
        $jsonVars = [
            'id' => $id,
            'name' => $this->handle,
            'namespace' => $namespacedId,
            'prefix' => Craft::$app->getView()->namespaceInputId('link'),
        ];
        $jsonVars = Json::encode($jsonVars);
        Craft::$app->getView()->registerJs("$('#{$namespacedId}-field').Ytilitu(" . $jsonVars . ");");

        $value = Json::decode($value);

        return Craft::$app->getView()->renderTemplate('flickr-gallery/flickr_field', [
            'flickr_id' => [
                'name' => $this->handle . '[' . self::FLICKR_ID . ']',
                'id' => 'flickr_id',
                'value' => $value[self::FLICKR_ID] ?? '',
            ],
            'load_fe' => [
                'name' => $this->handle . '[' . self::LOAD_FROM_FRONTEND . ']',
                'id' => 'load_fe',
                'value' => $value[self::LOAD_FROM_FRONTEND] ?? '',
            ],
        ]);
    }

    /**
     * @return string
     */
    public function getContentColumnType(): string
    {
        return Schema::TYPE_STRING;
    }

    /**
     * @inheritdoc
     */
    public function normalizeValue($value, ElementInterface $element = null)
    {
        if (Craft::$app->request->isCpRequest) {
            return $value;
        }

        $options = JSON::decode($value);
        $id = $options['id'] ?: '-1';
        if (Craft::$app->cache->exists($id)) {
            return Craft::$app->cache->get($id);
        }
        //if loading from frontend is activated --> load the album from the frontend and store it to the cache
        if (array_key_exists(self::LOAD_FROM_FRONTEND, $options ?? []) && $options[self::LOAD_FROM_FRONTEND]) {
            $album = $this->flickrAlbumClient->getAlbumByIdOrEmpty($id);
            if ($album->getImages()) {
                Craft::$app->cache->set($id, $album);
            }
            return $album;

        } elseif (isset($options[self::FLICKR_ID])) {
            //if loading from frontend is inactive --> create a job and do it on the next login
            Craft::$app->queue->push(new AlbumJob(['id' => $options[self::FLICKR_ID]]));
        }
        $album = new FlickrAlbum();
        $album->setError();

        return $album;
    }

    /**
     * @param $value
     * @param ElementInterface|null $element
     * @return array|mixed|null|string
     */
    public function serializeValue($value, ElementInterface $element = null)
    {
        if (array_key_exists(self::FLICKR_ID, $value)) {
            //simply check if the album is available
            $answer = $this->flickrAlbumClient->getRawAlbumByPhotoSetId((int)$value['id']);
            $answer = json_decode($answer, true);
            if (array_key_exists('code', $answer) && $answer['code'] === AlbumParser::ERROR_CODE || !$answer) {
                //if there was an error on request send a message to the user
                Craft::$app->session->setError('Flickr Album not found for id:' . $value[self::FLICKR_ID]);
            } else {
                // create a job to fetch the album in the queue
                Craft::$app->queue->push(new AlbumJob(['id' => $value[self::FLICKR_ID]]));
            }
        }

        return $value;
    }


}