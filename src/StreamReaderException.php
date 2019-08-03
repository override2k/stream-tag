<?php
/**
 * Created by Fernando Robledo <overdesign@gmail.com>.
 */

namespace Overdesign\StreamTag;

use Exception;

class StreamReaderException extends Exception
{
    public const ERR_BUFFER_FULL_MSG = 'Error. Buffer is full';
    public const ERR_BUFFER_FULL_CODE = 1;
}
