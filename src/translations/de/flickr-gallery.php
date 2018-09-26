<?php
/**
 * FlickrGallery plugin for Craft CMS 3.x
 *
 * Use FlickrImages
 *
 * @link      https://blog.itscoding.ch
 * @copyright Copyright (c) 2018 Simon Müller
 */


/*
 * Load the Original Translation File (EN)
 */
$en = require_once __DIR__ . '/../en/flickr-gallery.php';


/**
 * Extends the English Translation File
 *
 */
return array_merge(
    $en,
    [
        'api.key.instructions' => 'Flickr Api Key hier eingeben Key <a href="https://www.flickr.com/services/api/misc.api_keys.html">hier</a> anfordern.',
        'app.secret.instructions' => 'Sicherheitsschlüssel hier eingeben',
        'api.id.instructions' => 'Flcikr Album Id hier eingeben',
        'api.error.label' => 'Bei Fehler Seite nicht anzeigen',
    ]
);
