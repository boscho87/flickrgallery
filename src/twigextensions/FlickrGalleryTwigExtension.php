<?php
/**
 * FlickrGallery plugin for Craft CMS 3.x
 *
 * Use FlickrImages
 *
 * @link      https://blog.itscoding.ch
 * @copyright Copyright (c) 2018 Simon Müller
 */

namespace itscoding\flickrgallery\twigextensions;

use itscoding\flickrgallery\entities\FlickrAlbum;
use itscoding\flickrgallery\FlickrGallery;

use itscoding\flickrgallery\services\FlickrAlbumClient;
use itscoding\flickrgallery\services\FlickrClient;
use itscoding\flickrgallery\services\parser\AlbumParser;
use Craft;

/**
 * Class FlickrGalleryTwigExtension
 * @package itscoding\flickrgallery\twigextensions
 */
class FlickrGalleryTwigExtension extends \Twig_Extension
{


    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'FlickrGallery';
    }

    /**
     * @inheritdoc
     */
    public function getFilters()
    {
        return [
            //  new \Twig_SimpleFilter('someFilter', [$this, 'someInternalFunction']),
        ];
    }

    /**
     * @inheritdoc
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('flickrAlbum', [$this, 'flickrAlbum']),
        ];
    }

    /**
     * @param null $text
     *
     * @return string
     * @throws \Exception
     */
    public function flickrAlbum(array $options): ?FlickrAlbum
    {
        $flickrAlbumClient = new FlickrAlbumClient(
            new FlickrClient(),
            new AlbumParser()
        );
        $id = $options['id'] ?: '-1';
        if (Craft::$app->cache->exists($id && false)) {
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
}
