<?php
/**
 * FlickrGallery plugin for Craft CMS 3.x
 *
 * Use FlickrImages
 *
 * @link      https://blog.itscoding.ch
 * @copyright Copyright (c) 2018 Simon Müller
 */

namespace boscho87\flickrgallery\services;

use boscho87\flickrgallery\FlickrGallery;

use Craft;
use craft\base\Component;

/**
 * Class FlickrGalleryService
 * @package boscho87\flickrgallery\services
 */
class FlickrGalleryService extends Component
{

    /**
     * @var FlickrClient
     */
    private $client;

    /**
     * FlickrGalleryService constructor.
     * @param FlickrClient $client
     */
    public function __construct(FlickrClient $client)
    {
        parent::__construct();
        $this->client = $client;
    }

    /**
     * @param int $id
     * @return string
     */
    public function getRawAlbumByPhotoSetId(int $id) : string
    {
        return $this->client->get(FlickrClient::GET_PHOTOS, [FlickrClient::PHOTO_SET => $id]);
    }


}
