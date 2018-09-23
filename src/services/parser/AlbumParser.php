<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 23.09.18
 * Time: 11:45
 */

namespace itscoding\flickrgallery\services\parser;


use itscoding\flickrgallery\entities\FlickrAlbum;
use itscoding\flickrgallery\hydrators\AlbumHydrator;
use itscoding\flickrgallery\services\FlickrClient;

/**
 * Class AlbumParser
 * @package itscoding\flickrgallery\services\parser
 */
class AlbumParser
{

    const ERROR_CODE = 1;
    const PHOTO_SET = 'photoset';
    /**
     * @var AlbumHydrator
     */
    private $hydrator;

    /**
     * AlbumParser constructor.
     * @param AlbumHydrator|null $hydrator
     */
    public function __construct(AlbumHydrator $hydrator = null)
    {

        $this->hydrator = $hydrator ?: new AlbumHydrator();
    }

    /**
     * @param string $jsonResponse
     * @return FlickrAlbum
     * @throws \Exception
     */
    public function rawResponseToEntity(string $jsonResponse): FlickrAlbum
    {
        $parsedData = json_decode($jsonResponse, true);

        if (isset($parsedData['code']) && $parsedData['code'] === self::ERROR_CODE) {
            //Todo log and throw the right exception type here
            throw  new \Exception(sprintf('The Flickr Api Responsed with an Error: %s', $parsedData['message']));
        }


        if (!array_key_exists(self::PHOTO_SET, $parsedData)) {
            //Todo log and throw the right exception type here
            throw new \Exception(sprintf('The response does not contain %s', FlickrClient::PHOTO_SET));
        }
        return $this->hydrator->hydrate($parsedData[self::PHOTO_SET], new FlickrAlbum());
    }

}