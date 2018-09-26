<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 23.09.18
 * Time: 11:24
 */

namespace itscoding\flickrgallery\entities;

/**
 * Class FlickrAlbum
 * @package itscoding\flickrgallery\entities
 */
class FlickrAlbum
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var FlickrImage[]|array
     */
    private $images;
    /**
     * @var string
     */
    private $title;
    /**
     * @var string
     */
    private $ownerId;
    /**
     * @var string
     */
    private $ownerName;
    /**
     * @var bool
     */
    private $hasError;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return array|FlickrImage[]
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param array|FlickrImage[] $images
     */
    public function setImages($images): void
    {
        $this->images = $images;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title ?: '';
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }


    /**
     * @return string
     */
    public function getOwnerId(): string
    {
        return $this->ownerId;
    }

    /**
     * @param string $ownerId
     */
    public function setOwnerId(string $ownerId): void
    {
        $this->ownerId = $ownerId;
    }

    /**
     * @return string
     */
    public function getOwnerName(): string
    {
        return $this->ownerName;
    }

    /**
     * @param string $ownerName
     */
    public function setOwnerName(string $ownerName): void
    {
        $this->ownerName = $ownerName;
    }

    /**
     * @return bool
     */
    public function hasError(): bool
    {
        return $this->hasError ?: false;
    }

    /**
     * @param bool $error
     */
    public function setError(bool $error = true): void
    {
        $this->hasError = $error;
    }

}