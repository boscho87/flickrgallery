<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 23.09.18
 * Time: 11:24
 */

namespace boscho87\flickrgallery\entities;

/**
 * Class FlickrAlbum
 * @package boscho87\flickrgallery\entities
 */
class FlickrAlbum
{
    /**
     * @var FlickrImage[]|array
     */
    private $images;

    /**
     * @return array|FlickrImage[]
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param array|FlickrImage[] $images
     */
    public function setImages($images): void
    {
        $this->images = $images;
    }




}