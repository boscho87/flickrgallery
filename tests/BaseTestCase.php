<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 23.09.18
 * Time: 10:15
 */


namespace FlickrGalleryTest;

use PHPUnit\Framework\TestCase;

/**
 * Class BaseTestCase
 */
abstract class BaseTestCase extends TestCase
{
    /**
     * @param string $fileName
     * @return string
     * @throws \Exception
     */
    public function jsonFromFile(string $fileName): string
    {
        $dir = __DIR__ . '/TestData/response';
        $file = $dir . '/' . $fileName;
        if (file_exists($file)) {
            return file_get_contents($file);
        }
        throw new \Exception('File not found ' . $file);
    }

}