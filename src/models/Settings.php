<?php
/**
 * FlickrGallery plugin for Craft CMS 3.x
 *
 * Use FlickrImages
 *
 * @link      https://blog.itscoding.ch
 * @copyright Copyright (c) 2018 Simon Müller
 */

namespace boscho87\flickrgallery\models;

use boscho87\flickrgallery\FlickrGallery;

use Craft;
use craft\base\Model;

/**
 * @author    Simon Müller
 * @package   FlickrGallery
 * @since     1.0.0
 */
class Settings extends Model
{
    /**
     * @var string
     */
    public $apiKey = '';
    /**
     * @var string
     */
    public $appSecret = '';

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['apiKey', 'string'],
            ['appSecret', 'string'],
        ];
    }
}
