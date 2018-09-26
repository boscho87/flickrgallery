<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 23.09.18
 * Time: 10:58
 */

namespace FlickrGalleryTest\services;


use itscoding\flickrgallery\services\FlickrClient;
use FlickrGalleryTest\BaseTestCase;

/**
 * Class FlickrClientTest
 * @package FlickrGalleryTest\servicesd
 */
class FlickrClientTest extends BaseTestCase
{

    /**
     * @var FlickrClient
     */
    private $client;

    /**
     * Test Setup
     */
    public function setUp()
    {
        parent::setUp();
        $this->client = new FlickrClient('key', 'secret');
    }

    /**
     * @group unit
     * @dataProvider requestUrlDataProvider()
     */
    public function testCreateRequestUrl(string $method, array $params, string $expected)
    {
        $url = $this->client->createRequestUrl($method, $params);
        $this->assertEquals($expected, $url);
    }

    /**
     * @return array
     */
    public function requestUrlDataProvider()
    {
        return [
            [
                '',
                [],
                'https://api.flickr.com/services/rest/?method=&nojsoncallback=1&format=json&extras=description&api_key=key&meida=photos&secret=secret',
            ],
            [
                FlickrClient::GET_PHOTOS,
                ['stuff' => 'stuff'],
                'https://api.flickr.com/services/rest/?stuff=stuff&method=flickr.photosets.getPhotos&nojsoncallback=1&format=json&extras=description&api_key=key&meida=photos&secret=secret',
            ],
        ];
    }


    /**
     * @group integration
     */
    public function testRequest()
    {
        $answer = $this->client->get(FlickrClient::GET_PHOTOS, []);
        $data = json_decode($answer, true);
        $this->assertEquals(100, $data['code']);
    }


}