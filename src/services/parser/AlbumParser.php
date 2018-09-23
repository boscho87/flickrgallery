<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 23.09.18
 * Time: 11:45
 */

namespace boscho87\flickrgallery\services\parser;


use boscho87\flickrgallery\entities\FlickrAlbum;
use boscho87\flickrgallery\hydrators\AlbumHydrator;
use boscho87\flickrgallery\services\FlickrClient;

/**
 * Class AlbumParser
 * @package boscho87\flickrgallery\services\parser
 */
class AlbumParser
{


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
     */
    public function rawResponseToEntity(string $jsonResponse): FlickrAlbum
    {
        $parsedData = json_decode($jsonResponse, true);
        if (!array_key_exists(self::PHOTO_SET, $parsedData)) {
            //Todo throw the right exception type here
            throw new \Exception(sprintf('The response does not contain %s', FlickrClient::PHOTO_SET));
        }
        return $this->hydrator->hydrate($parsedData[self::PHOTO_SET], new FlickrAlbum());
    }

}