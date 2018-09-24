<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 23.09.18
 * Time: 12:14
 */

namespace itscoding\flickrgallery\hydrators;


use itscoding\flickrgallery\entities\FlickrImage;
use Zend\Hydrator\Strategy\StrategyInterface;

/**
 * Class PhotoStrategy
 * @package itscoding\flickrgallery\hydrators
 */
class PhotoStrategy implements StrategyInterface
{

    /**
     * https://www.flickr.com/services/api/flickr.photos.getSizes.html
     *
     * @var array
     */
    private $sizes = [
        's' => 'square',
        'm' => 'small',
        't' => 'thumbnail',
        'z' => 'medium',
        'c' => 'large',
        'b' => 'xlarge',
        'h' => 'xxlarge',
    ];

    /**
     * Converts the given value so that it can be extracted by the hydrator.
     *
     * @param mixed $value The original value.
     * @param object $object (optional) The original object for context.
     * @return mixed Returns the value that should be extracted.
     */
    public function extract($value, $data = null)
    {
        // TODO: Implement extract() method.
    }

    /**
     * Converts the given value so that it can be hydrated by the hydrator.
     *
     * @param mixed $value The original value.
     * @param array $data (optional) The original data for context.
     * @return mixed Returns the value that should be hydrated.
     * @throws \Exception
     */
    public function hydrate($values, $data = null): array
    {
        foreach ($values as $imageData) {
            $image = new FlickrImage();
            $url = $this->createImageUrl($imageData);
            $image->setUrl($url);
            $image->setTitle($imageData['title']);
            $image->setId($imageData['id']);
            foreach ($this->sizes as $flickrSize => $sizeName) {
                $url = $this->createImageUrl($imageData, $flickrSize);
                $method = 'set' . ucfirst($sizeName) . 'Url';
                $image->$method($url, $sizeName);
            }
            $images[] = $image;
        }
        return $images ?? [];
    }

    /**
     * @param array $values
     */
    private function createImageUrl(array $values, string $size = '')
    {
        $url = 'https://farm';
        $url .= $values['farm'];
        $url .= '.staticflickr.com/';
        $url .= $values['server'] . '/';
        $url .= $values['id'] . '_';
        $url .= $values['secret'];
        if ($size) {
            $url .= '_' . $size;
        }
        $url .= '.jpg';

        return $url;
    }

}