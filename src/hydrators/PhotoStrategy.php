<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 23.09.18
 * Time: 12:14
 */

namespace itscoding\flickrgallery\hydrators;


use itscoding\flickrgallery\entities\FlickrImage;
use itscoding\flickrgallery\services\FlickrImageClient;
use Zend\Hydrator\Strategy\StrategyInterface;

/**
 * Class PhotoStrategy
 * @package itscoding\flickrgallery\hydrators
 */
class PhotoStrategy implements StrategyInterface
{

    /**
     * @var FlickrImageClient
     */
    private $imageClient;

    /**
     * PhotoStrategy constructor.
     * @param FlickrImageClient|null $imageClient
     */
    public function __construct(FlickrImageClient $imageClient = null)
    {
        $this->imageClient = $imageClient ?: new FlickrImageClient();
    }

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
            $image->setTitle($imageData['title']);
            $image->setId($imageData['id']);
            $image = $this->imageClient->fillImagesWithSizes($image);
            $images[] = $image;
        }
        return $images ?? [];
    }

}