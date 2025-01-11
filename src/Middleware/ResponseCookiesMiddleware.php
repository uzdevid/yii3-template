<?php
declare(strict_types=1);

namespace App\Middleware;

use App\Component\Container\CookieContainer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

readonly final class ResponseCookiesMiddleware implements MiddlewareInterface {
    /**
     * @param CookieContainer $cookieContainer
     */
    public function __construct(
        private CookieContainer $cookieContainer,
    ) {
    }

    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface {
        $response = $handler->handle($request);

        foreach ($this->cookieContainer->getCookies() as $cookie) {
            $response = $cookie->addToResponse($response);
        }

        return $response;
    }
}
