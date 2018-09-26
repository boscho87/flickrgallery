<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 26.09.18
 * Time: 20:11
 */

namespace itscoding\flickrgallery\services\parser;

use itscoding\flickrgallery\services\FlickrClient;

/**
 * Class PhotoParser
 * @package itscoding\flickrgallery\services\parser
 */
class PhotoParser
{

    const ERROR_CODE = 1;
    const SIZES = 'sizes';

    /**
     * @param string $rawResponse
     */
    public function sizesResponseToSizeArray(string $rawResponse): array
    {
        $parsedData = json_decode($rawResponse, true);

        if (isset($parsedData['code']) && $parsedData['code'] === self::ERROR_CODE) {
            //Todo log and throw the right exception type here
            throw  new \Exception(sprintf('The Flickr Api Responsed with an Error: %s', $parsedData['message']));
        }

        if (!array_key_exists(self::SIZES, $parsedData)) {
            //Todo log and throw the right exception type here
            throw new \Exception(sprintf('The response does not contain %s', FlickrClient::PHOTO));
        }

        foreach ($parsedData['sizes']['size'] as $size) {
            $sizeLetter = substr($size['source'], -5, 1);
            $sizes[$sizeLetter] = $size['source'];
        }

        return $sizes ?? [];
    }
}