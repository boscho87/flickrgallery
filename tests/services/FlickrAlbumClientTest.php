<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 23.09.18
 * Time: 11:35
 */

namespace FlickrGalleryTest\services;


use boscho87\flickrgallery\services\FlickrClient;
use boscho87\flickrgallery\services\FlickrAlbumClient;
use FlickrGalleryTest\BaseTestCase;

/**
 * Class FlickrGallerServiceTest
 * @package FlickrGalleryTest\services
 */
class FlickrAlbumClientTest extends BaseTestCase
{

    /**
     * @var FlickrAlbumClient
     */
    private $galleryService;

    /**
     * Test Setup
     */
    public function setUp()
    {
        parent::setUp();
        $flickrClient = $this->createMock(FlickrClient::class);
        $flickrClient->method('get')->willReturn($this->jsonFromFile('photoset.json'));
        $this->galleryService = new FlickrAlbumClient($flickrClient);
    }


    /**
     * @group unit
     */
    public function testGetRawAlbum()
    {
        $answer = $this->galleryService->getRawAlbumByPhotoSetId(1234);
        $prepared = str_replace([PHP_EOL, ' '], '', $answer);
        $this->assertStringStartsWith('{"photoset":{"id":"1234"', $prepared);
        $this->assertStringEndsWith('"pages":1,"title":"esr2\'sGallery","total":6},"stat":"ok"}',$prepared);

    }

}