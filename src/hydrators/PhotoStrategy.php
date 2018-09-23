<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 23.09.18
 * Time: 12:14
 */

namespace boscho87\flickrgallery\hydrators;


use Zend\Hydrator\Strategy\StrategyInterface;

/**
 * Class PhotoStrategy
 * @package boscho87\flickrgallery\hydrators
 */
class PhotoStrategy implements StrategyInterface
{

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
     */
    public function hydrate($value, $data = null)
    {
        // TODO: Implement hydrate() method.
    }
}