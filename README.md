# FlickrGallery plugin for Craft CMS 3.x

## Support on Beerpay
Hey dude! Help me out for a couple of :beers:!

[![Beerpay](https://beerpay.io/boscho87/flickrgallery/badge.svg?style=beer-square)](https://beerpay.io/boscho87/flickrgallery)  [![Beerpay](https://beerpay.io/boscho87/flickrgallery/make-wish.svg?style=flat-square)](https://beerpay.io/boscho87/flickrgallery?focus=wish)

<img src="https://github.com/boscho87/flickrgallery/raw/master/src/icon.svg?sanitize=true" alt="Screenshot" width="80px" height=80px>

## Requirements

This plugin requires Craft CMS 3.0.0-beta.23 or later.

## Installation

To install the plugin, follow these instructions.

1. Open your terminal and go to your Craft project:

        cd /path/to/project

2. Then tell Composer to load the plugin:

        composer require itscoding/flickr-gallery

3. In the Control Panel, go to Settings → Plugins and click the “Install” button for FlickrGallery.

## Configuring FlickrGallery

Get a Flickr [Api Key](https://www.flickr.com/services/api/misc.api_keys.html) and store the "apikey" and "secret" in to your plguin options


## Using FlickrGallery

The Plugins adds a method calles flickrAlbum() to Craft's twig environment

### Prameters:

#### id [int] - required
The id of the Flickr Gallery you want to request


#### exception [bool] - optional
*default*: `true`  
If this is set to false, the plugin returns an empty array on any error, so if your apikey,secret is not correct, or your id just is invalid, there will be an empty album object, with the error message in the title.  
In Production mode its recommended to set this to true, so the page will even load if the flickr api has any problems

```twig
    {% set album = flickrAlbum({id:'72157667785439498',exception:true}) %}
           <h2>{{ album.title }}</h2>
           {% for image in album.images %}
               <img src="{{ image.url }}" alt="{{ image.title }}"/>
           {% endfor %}
     {% endfor %}
```

### Edge Cases / Nice to know
- The plugin internally uses Craft's cache to cache the requests, so its recommended to warm the cache after you changed images in the flickr gallery.
- The plugin has no Pagination implementations for the Flickr Images, so its not Possible to load more than 500 images (Limit of one Request on Flickrs Site). If there are request about this, i maybe will implement this later
- Image Sizes , there are even more Sizes than just `{{ image.url }}`, but not every flickr Image can serve every size. Atm there is no error handling implemented. The ["Flickr" Sizes](https://www.flickr.com/services/api/flickr.photos.getSizes.html)
   - squareUrl `{{ image.squareUrl }}`
   - smallUrl
   - thumbnailUrl
   - mediumUrl
   - largeUrl
   - xlargeUrl
   - xxlargeUrl
  
## Roadmap

- Write more tests
- Add Travis CI and Codacy Stuff (Coverage etc.)
- Implement a Cronjob/Task for Cache warming the Flickr stuff
- Do a request for every single image to check the available sizes etc. (This can not be done "on request" and needs a Cronjob)
- Implement a proper error handling when the Flickr Api is offline


## Contributions / Issues
If you have feature Request or you want something done of the Roadmap, create an Issue. OR YOU FOUND A BUG IN BY CODE (even that could happen)


Brought to you by [Simon Müller](https://blog.itscoding.ch)

