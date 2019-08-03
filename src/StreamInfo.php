<?php
/**
 * Created by Fernando Robledo <overdesign@gmail.com>.
 */

namespace Overdesign\StreamTag;

class StreamInfo
{
    /** @var int|null */
    protected $bitRate;

    /** @var int|null */
    protected $metaInt;

    /** @var string|null */
    protected $contentType;

    /** @var string|null */
    protected $url;

    /** @var string|null */
    protected $name;

    /** @var string|null */
    protected $genere;

    /** @var string|null */
    protected $public;

    /**
     * @return int|null
     */
    public function getBitRate(): ?int
    {
        return $this->bitRate;
    }

    /**
     * @param int|null $bitRate
     *
     * @return StreamInfo
     */
    public function setBitRate(?int $bitRate): StreamInfo
    {
        $this->bitRate = $bitRate;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getMetaInt(): ?int
    {
        return $this->metaInt;
    }

    /**
     * @param int|null $metaInt
     *
     * @return StreamInfo
     */
    public function setMetaInt(?int $metaInt): StreamInfo
    {
        $this->metaInt = $metaInt;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getContentType(): ?string
    {
        return $this->contentType;
    }

    /**
     * @param string|null $contentType
     *
     * @return StreamInfo
     */
    public function setContentType(?string $contentType): StreamInfo
    {
        $this->contentType = $contentType;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param string|null $url
     *
     * @return StreamInfo
     */
    public function setUrl(?string $url): StreamInfo
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     *
     * @return StreamInfo
     */
    public function setName(?string $name): StreamInfo
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getGenere(): ?string
    {
        return $this->genere;
    }

    /**
     * @param string|null $genere
     *
     * @return StreamInfo
     */
    public function setGenere(?string $genere): StreamInfo
    {
        $this->genere = $genere;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPublic(): ?string
    {
        return $this->public;
    }

    /**
     * @param string|null $public
     *
     * @return StreamInfo
     */
    public function setPublic(?string $public): StreamInfo
    {
        $this->public = $public;

        return $this;
    }
}
