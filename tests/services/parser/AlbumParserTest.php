<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 23.09.18
 * Time: 11:47
 */

namespace FlickrGalleryTest\services\parser;


use itscoding\flickrgallery\entities\FlickrAlbum;
use itscoding\flickrgallery\services\parser\AlbumParser;
use FlickrGalleryTest\BaseTestCase;

/**
 * Class AlbumParserTest
 * @package FlickrGalleryTest\services\parser
 */
class AlbumParserTest extends BaseTestCase
{

    /**
     * @var AlbumParser
     */
    private $parser;

    /**
     * Test Setup
     */
    public function setUp()
    {
        parent::setUp();
        $this->parser = new AlbumParser();
    }

    /**
     * @group unit
     * @throws \Exception
     */
    public function testIfRawResponseToEntityReturnsAlbums()
    {
        $rawResponse = $this->jsonFromFile('photoset.json');
        $album = $this->parser->rawResponseToEntity($rawResponse);
        $this->assertInstanceOf(FlickrAlbum::class, $album);
        $this->assertSame(1234, $album->getId());
        $this->assertSame('37996600159@N01', $album->getOwnerId());
        $this->assertSame('esr2', $album->getOwnerName());
    }


}