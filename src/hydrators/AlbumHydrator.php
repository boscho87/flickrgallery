<?php

namespace boscho87\flickrgallery\hydrators;


use boscho87\flickrgallery\entities\FlickrAlbum;
use Zend\Hydrator\ClassMethods;
use Zend\Hydrator\NamingStrategy\MapNamingStrategy;

/**
 * Created by PhpStorm.
 * User: simon
 * Date: 23.09.18
 * Time: 12:11
 */

/**
 * Class AlbumHydrator
 */
class AlbumHydrator extends ClassMethods
{

    /**
     * @var array
     */
    public static $nameMapping = [
        'id' => 'albumId',
        'owner' => 'ownerId',
        'ownerName' => 'ownerName',
        'photo' => 'images',
    ];

    /**
     * AlbumHydrator constructor.
     */
    public function __construct()
    {
        $this->setNamingStrategy(new MapNamingStrategy(self::$nameMapping));
        $this->addStrategy('images', new PhotoStrategy());
        parent::__construct();
    }

    /**
     * @param array $data
     * @param object $object
     * @return FlickrAlbum
     */
    public function hydrate(array $data, $object): FlickrAlbum
    {
        return parent::hydrate($data, $object);
    }


}