<?php
/**
 * Created by Fernando Robledo <overdesign@gmail.com>.
 */

namespace Overdesign\StreamTag;

class StreamServers
{
    public const SERVER_TYPE_ICE = 'ice';
    public const SERVER_TYPE_ICY = 'icy';

    public const ICE_HEADER_BITRATE     = 'ice-bitrate';
    public const ICE_HEADER_GENERE      = 'ice-genere';
    public const ICE_HEADER_NAME        = 'ice-name';
    public const ICE_HEADER_URL         = 'ice-url';
    public const ICE_HEADER_PUBLIC      = 'ice-public';
    public const ICE_HEADER_DESCRIPTION = 'ice-description';

    public const ICY_HEADER_BITRATE  = 'icy-br';
    public const ICY_HEADER_GENERE   = 'icy-genere';
    public const ICY_HEADER_NAME     = 'icy-name';
    public const ICY_HEADER_URL      = 'icy-url';
    public const ICY_HEADER_PUBLIC   = 'icy-pub';
    public const ICY_HEADER_METADATA = 'icy-metadata';
    public const ICY_HEADER_METADINT = 'icy-metaint';

    public const STREAM_BITRATE     = 'bit-rate';
    public const STREAM_GENERE      = 'genere';
    public const STREAM_NAME        = 'name';
    public const STREAM_URL         = 'url';
    public const STREAM_PUBLIC      = 'public';
    public const STREAM_DESCRIPTION = 'description';
    public const STREAM_META_INT    = 'meta-int';

    public const SERVERS = [
        self::SERVER_TYPE_ICE,
        self::SERVER_TYPE_ICY,
    ];

    public const HEADERS = [
        self::SERVER_TYPE_ICE => [
            self::STREAM_BITRATE     => self::ICE_HEADER_BITRATE,
            self::STREAM_GENERE      => self::ICE_HEADER_GENERE,
            self::STREAM_NAME        => self::ICE_HEADER_NAME,
            self::STREAM_URL         => self::ICE_HEADER_URL,
            self::STREAM_PUBLIC      => self::ICE_HEADER_PUBLIC,
            self::STREAM_DESCRIPTION => self::ICE_HEADER_DESCRIPTION,
        ],
        self::SERVER_TYPE_ICY => [
            self::STREAM_BITRATE     => self::ICY_HEADER_BITRATE,
            self::STREAM_GENERE      => self::ICY_HEADER_GENERE,
            self::STREAM_NAME        => self::ICY_HEADER_NAME,
            self::STREAM_URL         => self::ICY_HEADER_URL,
            self::STREAM_PUBLIC      => self::ICY_HEADER_PUBLIC,
            self::STREAM_DESCRIPTION => self::ICY_HEADER_METADATA,
            self::STREAM_META_INT    => self::ICY_HEADER_METADINT,
        ],
    ];
}
