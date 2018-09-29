<?php
/**
 * FlickrGallery plugin for Craft CMS 3.x
 *
 * Use FlickrImages
 *
 * @link      https://blog.itscoding.ch
 * @copyright Copyright (c) 2018 Simon Müller
 */

namespace itscoding\flickrgallery;

use craft\events\RegisterCacheOptionsEvent;
use craft\services\Dashboard;
use craft\services\Fields;
use craft\services\Utilities;
use craft\utilities\ClearCaches;
use itscoding\flickrgallery\fields\FlickrField;
use itscoding\flickrgallery\jobs\AlbumJob;
use itscoding\flickrgallery\services\FlickrAlbumClient;
use itscoding\flickrgallery\models\Settings;

use Craft;
use craft\base\Plugin;
use craft\services\Plugins;
use craft\events\PluginEvent;

use yii\base\Event;

/**
 * Class FlickrGallery
 * @package itscoding\flickrgallery
 */
class FlickrGallery extends Plugin
{

    /**
     * @var FlickrGallery
     */
    public static $plugin;
    /**
     * @var string
     */
    public $schemaVersion = '1.0.0';

    /*
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        self::$plugin = $this;
        $this->setComponents([
            'flickrGalleryService' => FlickrAlbumClient::class,
        ]);

        Event::on(
            Plugins::class,
            Plugins::EVENT_AFTER_INSTALL_PLUGIN,
            function (PluginEvent $event) {
                if ($event->plugin === $this) {
                }
            }
        );

        Event::on(
            Fields::class,
            Fields::EVENT_REGISTER_FIELD_TYPES,
            function ($event) {
                $event->types[] = FlickrField::class;
            }
        );

        Craft::info(
            Craft::t(
                'flickr-gallery',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
    }

    /**
     * @inheritdoc
     */
    protected function createSettingsModel()
    {
        return new Settings();
    }

    /**
     * @inheritdoc
     */
    protected function settingsHtml(): string
    {
        return Craft::$app->view->renderTemplate(
            'flickr-gallery/settings',
            [
                'settings' => $this->getSettings()
            ]
        );
    }
}
