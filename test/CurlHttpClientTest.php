<?php
/**
 * Created by Fernando Robledo <overdesign@gmail.com>.
 */

namespace Overdesign\StreamTag\Test;

use Overdesign\StreamTag\CurlHttpClient;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Overdesign\StreamTag\CurlHttpClient
 */
class CurlHttpClientTest extends TestCase
{
    public function testGetHeaders()
    {
        $client = new CurlHttpClient();

        $headers = $client->getHeaders('http://19093.live.streamtheworld.com/LOS40_SC');

        var_dump($headers);
    }

    public function testGetStreamInfo()
    {
    }

    public function testGetStreamMeta()
    {
        $client = new CurlHttpClient();

        $meta = $client->getStreamMeta('http://19093.live.streamtheworld.com/LOS40_SC', 16000);

        var_dump($meta);
    }
}
