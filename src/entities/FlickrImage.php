<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 23.09.18
 * Time: 11:19
 */

namespace itscoding\flickrgallery\entities;

/**
 * Class FlickrImage
 * @package itscoding\flickrgallery\entities
 */
class FlickrImage
{
    /**
     * @var string
     */
    private $url = '';
    /**
     * @var string
     */
    private $title = '';
    /**
     * @var string
     */
    private $squareUrl = '';
    /**
     * @var string
     */
    private $smallUrl = '';
    /**
     * @var string
     */
    private $thumbnailUrl = '';
    /**
     * @var string
     */
    private $mediumUrl = '';
    /**
     * @var string
     */
    private $largeUrl = '';
    /**
     * @var string
     */
    private $bigUrl = '';
    /**
     * @var string
     */
    private $originalUrl = '';

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @throws \Exception
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
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
    public function getSquareUrl(): string
    {
        return $this->squareUrl;
    }

    /**
     * @param string $squareUrl
     */
    public function setSquareUrl(string $squareUrl): void
    {
        $this->squareUrl = $squareUrl;
    }

    /**
     * @return string
     */
    public function getSmallUrl(): string
    {
        return $this->smallUrl;
    }

    /**
     * @param string $smallUrl
     */
    public function setSmallUrl(string $smallUrl): void
    {
        $this->smallUrl = $smallUrl;
    }

    /**
     * @return string
     */
    public function getThumbnailUrl(): string
    {
        return $this->thumbnailUrl;
    }

    /**
     * @param string $thumbnailUrl
     */
    public function setThumbnailUrl(string $thumbnailUrl): void
    {
        $this->thumbnailUrl = $thumbnailUrl;
    }

    /**
     * @return string
     */
    public function getMediumUrl(): string
    {
        return $this->mediumUrl;
    }

    /**
     * @param string $mediumUrl
     */
    public function setMediumUrl(string $mediumUrl): void
    {
        $this->mediumUrl = $mediumUrl;
    }

    /**
     * @return string
     */
    public function getLargeUrl(): string
    {
        return $this->largeUrl;
    }

    /**
     * @param string $largeUrl
     */
    public function setLargeUrl(string $largeUrl): void
    {
        $this->largeUrl = $largeUrl;
    }

    /**
     * @return string
     */
    public function getBigUrl(): string
    {
        return $this->bigUrl;
    }

    /**
     * @param string $bigUrl
     */
    public function setBigUrl(string $bigUrl): void
    {
        $this->bigUrl = $bigUrl;
    }

    /**
     * @return string
     */
    public function getOriginalUrl(): string
    {
        return $this->originalUrl;
    }

    /**
     * @param string $originalUrl
     */
    public function setOriginalUrl(string $originalUrl): void
    {
        $this->originalUrl = $originalUrl;
    }
    
}