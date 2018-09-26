<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 23.09.18
 * Time: 11:35
 */

namespace FlickrGalleryTest\services;


use FlickrGalleryTest\BaseTestCase;
use itscoding\flickrgallery\services\FlickrAlbumClient;
use itscoding\flickrgallery\services\FlickrClient;
use itscoding\flickrgallery\services\parser\AlbumParser;

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
     * @throws \Exception
     */
    public function setUp()
    {
        parent::setUp();
        $flickrClient = $this->createMock(FlickrClient::class);
        $flickrClient->method('get')->willReturn($this->jsonFromFile('photoset.json'));
        $albumParser = $this->createMock(AlbumParser::class);
        $this->galleryService = new FlickrAlbumClient($flickrClient, $albumParser);
    }


    /**
     * @group unit
     */
    public function testGetRawAlbum()
    {
        $answer = $this->galleryService->getRawAlbumByPhotoSetId(1234);
        $prepared = str_replace([PHP_EOL, ' '], '', $answer);
        $this->assertStringStartsWith('{"photoset":{"id":"1234"', $prepared);
        $this->assertStringEndsWith('"pages":1,"title":"esr2\'sGallery","total":6},"stat":"ok"}', $prepared);

    }

}