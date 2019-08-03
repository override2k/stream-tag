<?php
/**
 * Created by Fernando Robledo <overdesign@gmail.com>.
 */

namespace Overdesign\StreamTag;

/**
 * Class CurlHttpClient
 * @package Overdesign\StreamTag
 * @internal
 */
final class CurlHttpClient
{
    private const USER_AGENT       = 'iTunes/9.0 (Macintosh; Intel Mac OS X 10.5.8)';
    private const META_FIELD_SIZE  = 512;
    private const CURL_TIME_OUT    = 15;

    public const DEFAULT_META_INT = 16000;

    private const DEFAULT_HEADERS = [
        'User-Agent: ' . self::USER_AGENT,
        'icy-metadata: 1',
    ];

    /** @var string|null */
    protected $buffer;

    /** @var int */
    protected $bufferSize;

    /**
     * @param $url
     *
     * @return array
     *
     * @throws StreamReaderException
     */
    public function getHeaders($url): array
    {
        return $this->processRawHeaders($this->getRawHeaders($url));
    }

    /**
     * @param $url
     *
     * @return string|null
     * @throws StreamReaderException
     */
    private function getRawHeaders(string $url): ?string
    {
        $options = [
            CURLOPT_HTTPHEADER     => self::DEFAULT_HEADERS,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => true,
            CURLOPT_NOBODY         => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_TIMEOUT        => self::CURL_TIME_OUT,
            CURLOPT_CUSTOMREQUEST  => 'GET',
        ];

        return $this->executeCurl($url, $options);
    }

    /**
     * @param string $url
     * @param int $metaInt
     *
     * @return string|null
     *
     * @throws StreamReaderException
     */
    public function getStreamMeta(string $url, int $metaInt = self::DEFAULT_META_INT): ?string
    {
        $options = array(
            CURLOPT_HTTPHEADER     => self::DEFAULT_HEADERS,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_RANGE          => '0-' . ((int)$metaInt + self::META_FIELD_SIZE),
            CURLOPT_WRITEFUNCTION  => array($this, 'curlCallback'),
            CURLOPT_TIMEOUT        => self::CURL_TIME_OUT,
        );

        $this->buffer     = null;
        $this->bufferSize = $metaInt + self::META_FIELD_SIZE;

        $this->executeCurl($url, $options);

        return $this->buffer;
    }

    /**
     * @param string $url
     * @param array $options
     *
     * @return string|null
     *
     * @throws StreamReaderException
     */
    private function executeCurl(string $url, array $options): ?string
    {
        $ch       = null;
        $response = null;

        try {
            $ch = curl_init($url);
            curl_setopt_array($ch, $options);

            $response     = @curl_exec($ch);

            if ($response === false) {
                throw new StreamReaderException(curl_error($ch), curl_errno($ch));
            }
        } catch (\Exception $e) {
            if (!is_resource($ch)) {
                throw new \RuntimeException(sprintf('Error (%d): %s', $e->getCode(), $e->getMessage()));
            }

            throw new StreamReaderException(curl_error($ch), curl_errno($ch));
        } finally {
            curl_close($ch);
        }

        return $response;
    }

    /**
     * @param resource $ch
     * @param string $str
     *
     * @return int
     *
     * @throws StreamReaderException
     */
    private function curlCallback( $ch, string $str): int
    {
        if (strlen($this->buffer) < $this->bufferSize) {
            $this->buffer .= $str;
        } else {
            throw new StreamReaderException(
                StreamReaderException::ERR_BUFFER_FULL_MSG,
                StreamReaderException::ERR_BUFFER_FULL_CODE
            );
        }

        return strlen($str);
    }

    private function processRawHeaders(string $headers)
    {
        $processed = [];
        $headers   = explode(PHP_EOL, $headers);

        array_map(function (string $header) use (&$processed) {
            $value = explode(':', $header, 2);
            if (count($value) > 1) {
                $processed[strtolower($value[0])] = trim($value[1]);
            }
        }, $headers);

        return $processed;
    }
}
