<?php
declare(strict_types=1);

namespace App\Middleware;

use App\Component\Container\HeaderContainer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

readonly final class ResponseHeadersMiddleware implements MiddlewareInterface {
    /**
     * @param HeaderContainer $headerContainer
     */
    public function __construct(
        private HeaderContainer $headerContainer,
    ) {
    }

    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface {
        $response = $handler->handle($request);

        foreach ($this->headerContainer->getHeaders() as $name => $value) {
            $response = $response->withAddedHeader($name, $value);
        }

        return $response;
    }
}
