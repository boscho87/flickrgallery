<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 26.09.18
 * Time: 20:06
 */

namespace itscoding\flickrgallery\services;


use itscoding\flickrgallery\entities\FlickrImage;
use itscoding\flickrgallery\services\parser\PhotoParser;

/**
 * Class FlickrImageClient
 * @package itscoding\flickrgallery\services
 */
class FlickrImageClient
{

    /**
     * @var FlickrClient
     */
    private $client;
    /**
     * @var PhotoParser
     */
    private $parser;

    /**
     * FlickrImageClient constructor.
     * @param FlickrClient|null $client
     * @param PhotoParser|null $parser
     */
    public function __construct(
        FlickrClient $client = null,
        PhotoParser $parser = null

    )
    {
        $this->client = $client ?: new FlickrClient();
        $this->parser = $parser ?: new PhotoParser();
    }


    /**
     * @param int $id
     * @throws \Exception
     */
    public function fillImagesWithSizes(FlickrImage $image): FlickrImage
    {
        $response = $this->client->get(FlickrClient::GET_SIZES, [FlickrClient::PHOTO => $image->getId()]);
        $sizes = $this->parser->sizesResponseToSizeArray($response);
        $image->setSizes($sizes);
        return $image;
    }

    /**
     * @param int $id
     */
    public function getImageByIdOrEmpty(FlickrImage $image)
    {
        try {
            $image = $this->fillImagesWithSizes($image);
        } catch (\Exception $e) {
            $image->setError();
        }
        return $image;
    }

}