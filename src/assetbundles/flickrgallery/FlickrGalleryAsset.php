<?php
/**
 * FlickrGallery plugin for Craft CMS 3.x
 *
 * Use FlickrImages
 *
 * @link      https://blog.itscoding.ch
 * @copyright Copyright (c) 2018 Simon Müller
 */

namespace boscho87\flickrgallery\assetbundles\FlickrGallery;

use Craft;
use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

/**
 * @author    Simon Müller
 * @package   FlickrGallery
 * @since     1.0.0
 */
class FlickrGalleryAsset extends AssetBundle
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->sourcePath = "@boscho87/flickrgallery/assetbundles/flickrgallery/dist";

        $this->depends = [
            CpAsset::class,
        ];

        $this->js = [
            'js/FlickrGallery.js',
        ];

        $this->css = [
            'css/FlickrGallery.css',
        ];

        parent::init();
    }
}
