<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 29.09.18
 * Time: 17:51
 */


namespace itscoding\flickrgallery\jobs;


use Craft;
use craft\queue\BaseJob;
use craft\queue\QueueInterface;
use itscoding\flickrgallery\services\FlickrAlbumClient;
use itscoding\flickrgallery\services\FlickrClient;
use itscoding\flickrgallery\services\parser\AlbumParser;

/**
 * Class AlbumJob
 * @package itscoding\flickrgallery\jobs
 */
class AlbumJob extends BaseJob
{

    /**
     * @var string
     */
    public $id = '';
    /**
     * @var bool
     */
    public $exception = false;
    /**
     * @var FlickrAlbumClient
     */
    private $flickrAlbumClient;


    /**
     * Initialize class
     */
    public function init()
    {
        parent::init();
        $this->flickrAlbumClient = new FlickrAlbumClient(
            new FlickrClient(),
            new AlbumParser()
        );

    }


    /**
     * @param \yii\queue\Queue|QueueInterface $queue The queue the job belongs to
     */
    public function execute($queue)
    {
        if ($this->exception) {
            $album = $this->flickrAlbumClient->getAlbumById($this->id);
        } else {
            $album = $this->flickrAlbumClient->getAlbumByIdOrEmpty($this->id);
        }
        
        Craft::$app->cache->delete($this->id);
        if ($album->getImages()) {
            Craft::$app->cache->set($this->id, $album);
        }
    }

    /**
     * @inheritdoc
     */
    public function getDescription(): string
    {
        return \Craft::t('flickr-gallery', 'update.albums');
    }

}