<?php
/**
 * FlickrGallery plugin for Craft CMS 3.x
 *
 * Use FlickrImages
 *
 * @link      https://blog.itscoding.ch
 * @copyright Copyright (c) 2018 Simon Müller
 */

namespace itscoding\flickrgallery\services;

use itscoding\flickrgallery\entities\FlickrAlbum;
use itscoding\flickrgallery\FlickrGallery;

use itscoding\flickrgallery\services\parser\AlbumParser;
use Craft;
use craft\base\Component;

/**
 * Class FlickrGalleryService
 * @package itscoding\flickrgallery\services
 */
class FlickrAlbumClient extends Component
{

    /**
     * @var FlickrClient
     */
    private $client;
    /**
     * @var AlbumParser
     */
    private $parser;

    /**
     * FlickrAlbumClient constructor.
     * @param FlickrClient|null $client
     * @param AlbumParser|null $parser
     */
    public function __construct(
        FlickrClient $client = null,
        AlbumParser $parser = null
    )
    {
        parent::__construct();
        $this->client = $client ?: new FlickrClient();
        $this->parser = $parser ?: new AlbumParser();
    }

    /**
     * @param int $id
     * @return string
     */
    public function getRawAlbumByPhotoSetId(int $id): string
    {
        return $this->client->get(FlickrClient::GET_PHOTOS, [FlickrClient::PHOTO_SET => $id]);
    }

    /**
     * @param int $id
     * @return FlickrAlbum
     * @throws \Exception
     */
    public function getAlbumById(int $id): FlickrAlbum
    {
        return $this->parser->rawResponseToEntity(
            $this->getRawAlbumByPhotoSetId($id)
        );
    }

    /**
     * @param int $id
     * @return FlickrAlbum
     */
    public function getAlbumByIdOrEmpty(int $id): FlickrAlbum
    {
        try {
            $album = $this->parser->rawResponseToEntity(
                $this->getRawAlbumByPhotoSetId($id)
            );
        } catch (\Exception $e) {
            $album = new FlickrAlbum();
            $album->setTitle($e->getMessage());
            $album->setError();
        }
        return $album;
    }


}
