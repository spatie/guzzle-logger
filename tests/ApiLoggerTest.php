<?php

namespace Spatie\ApiLogger\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Log;
use PHPUnit\Framework\TestCase;
use Spatie\ApiLogger\ApiLogger;

class ApiLoggerTest extends TestCase
{
    use ApiLogger;

    public function testUsingTrait(): void
    {
        $handler = new MockHandler();
        $stack = HandlerStack::create();
        $stack->setHandler($handler);

        $this->addLogging($stack);

        $response = new Response(200, [], json_encode(['key' => 'value']));
        $handler->append($response);

        Log::shouldReceive('info')->once()->withArgs([
            'request' => 'REQUEST: {method} {uri} HTTP/{version} {req_body}',
            'response' => 'RESPONSE: {code} - {res_body}',
        ]);

        $client = new Client(['handler' => $stack]);
        $client->get('/');
    }
}
