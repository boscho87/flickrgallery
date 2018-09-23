<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 23.09.18
 * Time: 10:51
 */

namespace itscoding\flickrgallery\services;

use itscoding\flickrgallery\FlickrGallery;

/**
 * Class FlickrClient
 * @package itscoding\flickrgallery\services
 */
class FlickrClient
{

    /**
     * @var string
     */
    private $baseUrl = 'https://api.flickr.com/services/rest/?';
    /**
     * @var string
     */
    private $apiKey = '';
    /**
     * @var string
     */
    private $secret = '';

    /**
     * Api Options
     */
    const NO_JSON_CALLBACK = '1';
    const FORMAT = 'json';
    const EXTRAS = 'description';
    const MEDIA = 'photos';

    /**
     * Methods
     */
    const GET_PHOTOS = 'flickr.photosets.getPhotos';

    const PHOTO_SET = 'photoset_id';

    /**
     * FlickrClient constructor.
     * @param string $apiKey
     * @param string $secret
     */
    public function __construct(string $apiKey = '', string $secret = '')
    {

        $this->apiKey = $apiKey;
        $this->secret = $secret;

        if (!$this->apiKey) {
            $this->apiKey = FlickrGallery::$plugin->getSettings()->apiKey;
        }
        if (!$this->secret) {
            $this->secret = FlickrGallery::$plugin->getSettings()->appSecret;
        }
    }


    /**
     * @param string $method
     * @param array $queryParams
     * @return string
     */
    public function get(string $method, array $queryParams): string
    {
        $url = $this->createRequestUrl($method, $queryParams);
        $options = ['http' => ['ignore_errors' => true,]];
        $context = stream_context_create($options);
        $data = file_get_contents($url, null, $context);
        return $data;
    }


    /**
     * @param array $queryParameters
     * @return string
     */
    public function createRequestUrl(string $method, $queryParameters = []): string
    {
        $queryParameters['method'] = $method;
        $queryParameters['nojsoncallback'] = self::NO_JSON_CALLBACK;
        $queryParameters['format'] = self::FORMAT;
        $queryParameters['extras'] = self::EXTRAS;
        $queryParameters['api_key'] = $this->apiKey;
        $queryParameters['meida'] = self::MEDIA;
        $queryParameters['secret'] = $this->secret;
        foreach ($queryParameters as $parameter => $value) {
            $encodedParams[] = sprintf('%s=%s', urlencode($parameter), urlencode($value));
        }
        return $this->baseUrl . implode('&', $encodedParams);
    }

    /**
     * @return string
     */
    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

}