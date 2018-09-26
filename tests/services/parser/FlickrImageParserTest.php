<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 26.09.18
 * Time: 20:22
 */

namespace FlickrGalleryTest\services\parser;


use FlickrGalleryTest\BaseTestCase;
use itscoding\flickrgallery\entities\FlickrImage;
use itscoding\flickrgallery\services\parser\PhotoParser;

/**
 * Class FlickrImageParserTest
 * @package FlickrGalleryTest\services\parser
 */
class FlickrImageParserTest extends BaseTestCase
{


    /**
     * @var PhotoParser
     */
    private $parser;

    /**
     * Test Setup
     */
    public function setUp()
    {
        $this->parser = new PhotoParser();
    }

    /**
     * @group unit
     * @throws \Exception
     */
    public function testParseSizesResponse()
    {
        $rawResponse = $this->jsonFromFile('photo_sizes.json');
        $sizes = $this->parser->sizesResponseToSizeArray($rawResponse);
        $this->assertArrayHasKey('s',$sizes);



    }

}