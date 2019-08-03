<?php
/**
 * Created by Fernando Robledo <overdesign@gmail.com>.
 */

namespace Overdesign\StreamTag\Test;

use Overdesign\StreamTag\CurlHttpClient;
use Overdesign\StreamTag\StreamReader;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Overdesign\StreamTag\CurlHttpClient
 */
class StreamReaderTest extends TestCase
{
    public function testGetStreamInfo()
    {
        $reader = new StreamReader(new CurlHttpClient());

        // $song = $reader->getStreamInfo('http://19093.live.streamtheworld.com/LOS40_SC', 16000);
        $song = $reader->getStreamInfo('http://19393.live.streamtheworld.com/MAXIMAFM.mp3');

        var_dump($song);
    }

    public function testGetStreamSongName()
    {
        $reader = new StreamReader(new CurlHttpClient());

        //        $song = $reader->getStreamSongName('http://19093.live.streamtheworld.com/LOS40_SC', 16000);
        //        $song = $reader->getStreamSongName('http://playerservices.streamtheworld.com/api/livestream-redirect/MAXIMAFM_SC', 116000);
        //        $song = $reader->getStreamSongName('http://20403.live.streamtheworld.com/CADENADIAL_SC', 116000);
        $song = $reader->getStreamSongName('http://19393.live.streamtheworld.com/MAXIMAFM.mp3', 16000);

        var_dump($song);
    }
}
