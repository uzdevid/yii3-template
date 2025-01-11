<?php

namespace App\Middleware;

use App\Http\Provider\TracerProviderInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Ramsey\Uuid\Uuid;
use Yiisoft\RequestProvider\RequestHeaderProvider;

readonly final class TracingMiddleware implements MiddlewareInterface {
    /**
     * @param RequestHeaderProvider $requestHeaders
     * @param TracerProviderInterface $tracerProvider
     */
    public function __construct(
        private RequestHeaderProvider   $requestHeaders,
        private TracerProviderInterface $tracerProvider
    ) {
    }

    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface {
        if ($this->requestHeaders->has('X-Request-Id')) {
            $this->tracerProvider->withId($this->requestHeaders->getLine('X-Request-Id'));
        } else {
            $this->tracerProvider->withId(Uuid::uuid4()->toString());
        }

        return $handler->handle($request);
    }
}
