<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 23.09.18
 * Time: 11:45
 */

namespace boscho87\flickrgallery\services\parser;


use boscho87\flickrgallery\services\FlickrClient;

/**
 * Class AlbumParser
 * @package boscho87\flickrgallery\services\parser
 */
class AlbumParser
{


    const PHOTO_SET = 'photoset';

    /**
     * @param string $jsonResponse
     * @return array
     */
    public function rawResponseToEntity(string $jsonResponse): array
    {
        $parsedData = json_decode($jsonResponse);
        if (!array_key_exists(self::PHOTO_SET, $parsedData)) {
            //Todo throw the right exception type here
            throw new \Exception(sprintf('The response does not contain %s', FlickrClient::PHOTO_SET));
        }


        return [];
    }

}