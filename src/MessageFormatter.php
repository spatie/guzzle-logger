<?php

namespace Spatie\ApiLogger;

use GuzzleHttp\MessageFormatter as GuzzleMessageFormatter;

class MessageFormatter extends GuzzleMessageFormatter
{
    public function __construct($template = GuzzleMessageFormatter::CLF)
    {
        if ($template !== GuzzleMessageFormatter::CLF) {
            $template = [
                config('apilogger.format.request'),
                config('apilogger.format.response'),
            ];
        }

        GuzzleMessageFormatter::__construct($template);
    }
}
