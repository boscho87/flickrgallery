# FlickrGallery plugin for Craft CMS 3.x

Use FlickrImages

![Screenshot](resources/img/plugin-logo.png)

## Requirements

This plugin requires Craft CMS 3.0.0-beta.23 or later.

## Installation

To install the plugin, follow these instructions.

1. Open your terminal and go to your Craft project:

        cd /path/to/project

2. Then tell Composer to load the plugin:

        composer require itscoding/flickr-gallery

3. In the Control Panel, go to Settings → Plugins and click the “Install” button for FlickrGallery.

## FlickrGallery Overview

```twig
     {% set album = flickrAlbum({id:'72157667785439498',exception:true}) %}
     <h2>{{ album.title }}</h2>
     {% for image in album.images %}
         {{ image.url() }}
     {% endfor %}

```

## Configuring FlickrGallery

-Insert text here-

## Using FlickrGallery

-Insert text here-

## FlickrGallery Roadmap

Some things to do, and ideas for potential features:

* Release it

Brought to you by [Simon Müller](https://blog.itscoding.ch)
