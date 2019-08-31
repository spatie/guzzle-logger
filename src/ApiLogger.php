<?php

namespace Spatie\ApiLogger;

use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use Illuminate\Log\LogManager;

trait ApiLogger
{
    private function addLogging(HandlerStack $handlerStack)
    {
        $handlerStack->push(
            Middleware::log(
                app(LogManager::class)->channel(),
                new MessageFormatter()
            )
        );
    }
}
