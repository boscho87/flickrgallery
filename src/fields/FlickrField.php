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

    /**
     * @return string The display name of this class.
     */
    public static function displayName(): string
    {
        return Craft::t('flickr-gallery', 'youtube.link');
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
                'name' => $this->handle . '[id]',
                'id' => 'flickr_id',
                'value' => $value['id'] ?? '',
            ],
            'flickr_exception' => [
                'name' => $this->handle . '[exception]',
                'id' => 'flickr_exception',
                'value' => $value['exception'] ?? '',
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

        $flickrAlbumClient = new FlickrAlbumClient(
            new FlickrClient(),
            new AlbumParser()
        );

        $options = JSON::decode($value);
        $id = $options['id'] ?: '-1';
        if (Craft::$app->cache->exists($id)) {
            return Craft::$app->cache->get($id);
        }
        if (array_key_exists('exception', $options) && $options['exception']) {
            $album = $flickrAlbumClient->getAlbumById($id);
        } else {
            $album = $flickrAlbumClient->getAlbumByIdOrEmpty($id);
        }
        if ($album->getImages()) {
            Craft::$app->cache->set($id, $album);
        }
        return $album;
    }


    /**
     * @param $value
     * @param ElementInterface|null $element
     * @return array|mixed|null|string
     */
    public function serializeValue($value, ElementInterface $element = null)
    {

        return $value;
    }


}