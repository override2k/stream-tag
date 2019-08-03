<?php
/**
 * Created by Fernando Robledo <overdesign@gmail.com>.
 */

namespace Overdesign\StreamTag;

final class StreamReader
{
    public const META_START = "StreamTitle='";
    public const META_END   = "';";

    /** @var CurlHttpClient */
    protected $client;

    /**
     * StreamReader constructor.
     *
     * @param CurlHttpClient $client
     */
    public function __construct(CurlHttpClient $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $url
     *
     * @return StreamInfo
     * @throws StreamReaderException
     */
    public function getStreamInfo(string $url): StreamInfo
    {
        $headers = array_change_key_case($this->client->getHeaders($url), CASE_LOWER);

        $serverType = $this->detectServerType($headers);

        return $this->buildStreamInfo($serverType, $headers);
    }

    /**
     * @param array $headers
     *
     * @return string|null
     */
    public function detectServerType(array $headers): ?string
    {
        $headersKeys = array_keys($headers);

        foreach (StreamServers::SERVERS as $serverType) {
            if (array_intersect($headersKeys, array_values(StreamServers::HEADERS[$serverType]))) {
                return $serverType;
            }
        }

        return null;
    }

    /**
     * @param string $serverType
     * @param array $headers
     *
     * @return StreamInfo
     */
    private function buildStreamInfo(string $serverType, array $headers): StreamInfo
    {
        $info = new StreamInfo();

        $info->setBitRate($headers[StreamServers::HEADERS[$serverType][StreamServers::STREAM_BITRATE]] ?? null)
            ->setContentType($headers['content-type'] ?? null)
            ->setGenere($headers[StreamServers::HEADERS[$serverType][StreamServers::STREAM_GENERE]] ?? null)
            ->setName($headers[StreamServers::HEADERS[$serverType][StreamServers::STREAM_NAME]] ?? null)
            ->setUrl($headers[StreamServers::HEADERS[$serverType][StreamServers::STREAM_URL]] ?? null)
            ->setPublic($headers[StreamServers::HEADERS[$serverType][StreamServers::STREAM_PUBLIC]] ?? null);

        if ($serverType === StreamServers::SERVER_TYPE_ICY) {
            $info->setMetaInt($headers[StreamServers::HEADERS[$serverType][StreamServers::STREAM_META_INT]] ?? null);
        }

        return $info;
    }

    /**
     * @param string $url
     * @param int $metaInt
     *
     * @return string
     * @throws StreamReaderException
     */
    public function getStreamSongName(string $url, ?int $metaInt = null): string
    {
        $buffer = $this->client->getStreamMeta($url, $metaInt ?? $this->client::DEFAULT_META_INT);

        return $buffer ? $this->searchSongName($buffer) : '';
    }

    /**
     * @param string $buffer
     *
     * @return string
     */
    private function searchSongName(string $buffer): string
    {
        $start = stripos($buffer, self::META_START);
        $end   = strpos(substr($buffer, $start), self::META_END) + $start;

        return $start === false ? '' : substr($buffer, $start + 13, $end - $start - 13);
    }
}
