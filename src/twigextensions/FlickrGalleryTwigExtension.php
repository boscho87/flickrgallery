<?php
/**
 * FlickrGallery plugin for Craft CMS 3.x
 *
 * Use FlickrImages
 *
 * @link      https://blog.itscoding.ch
 * @copyright Copyright (c) 2018 Simon Müller
 */

namespace boscho87\flickrgallery\twigextensions;

use boscho87\flickrgallery\FlickrGallery;

use Craft;

/**
 * Class FlickrGalleryTwigExtension
 * @package boscho87\flickrgallery\twigextensions
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
            new \Twig_SimpleFilter('someFilter', [$this, 'someInternalFunction']),
        ];
    }

    /**
     * @inheritdoc
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('someFunction', [$this, 'someInternalFunction']),
        ];
    }

    /**
     * @param null $text
     *
     * @return string
     */
    public function someInternalFunction($text = null)
    {
        $result = $text . " in the way";

        return $result;
    }
}
