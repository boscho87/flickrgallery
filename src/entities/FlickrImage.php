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
    private $id = '';
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
    private $xlargeUrl = '';
    /**
     * @var string
     */
    private $xxlargeUrl = '';
    /**
     * @var bool
     */
    private $hasError = false;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

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
    public function getXlargeUrl(): string
    {
        return $this->xlargeUrl;
    }

    /**
     * @param string $xlargeUrl
     */
    public function setXlargeUrl(string $xlargeUrl): void
    {
        $this->xlargeUrl = $xlargeUrl;
    }

    /**
     * @return string
     */
    public function getXxlargeUrl(): string
    {
        return $this->xxlargeUrl;
    }

    /**
     * @param string $xxlargeUrl
     */
    public function setXxlargeUrl(string $xxlargeUrl): void
    {
        $this->xxlargeUrl = $xxlargeUrl;
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
     * @param array $sizes
     */
    public function setSizes(array $sizes): void
    {

        foreach ($sizes as $letter => $size) {
            if (array_key_exists($letter, $this->sizes)) {
                $this->{$this->sizes[$letter] . 'Url'} = $size;
            }
        }
        $this->url = end($sizes);
    }

}