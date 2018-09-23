<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 23.09.18
 * Time: 11:47
 */

namespace FlickrGalleryTest\services\parser;


use boscho87\flickrgallery\entities\FlickrAlbum;
use boscho87\flickrgallery\services\parser\AlbumParser;
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
     */
    public function testIfRawResponseToEntityReturnsAlbums()
    {
        $rawResponse = $this->jsonFromFile('photoset.json');
        $albums = $this->parser->rawResponseToEntity($rawResponse);
        foreach ($albums as $album) {
            $this->assertInstanceOf(FlickrAlbum::class, $album);
        }
    }


}