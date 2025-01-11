<?php
declare(strict_types=1);

namespace App\Middleware;

use App\Component\Container\ResponseBodyContainer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Yiisoft\DataResponse\DataResponse;

readonly final class ResponseBodyMiddleware implements MiddlewareInterface {
    /**
     * @param ResponseBodyContainer $responseBodyContainer
     */
    public function __construct(
        private ResponseBodyContainer $responseBodyContainer
    ) {
    }

    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface {
        $response = $handler->handle($request);

        if (!$this->responseBodyContainer->hasBody()){
            return $response;
        }

        if ($response instanceof DataResponse) {
            $data = $response->getData();
            $newData = array_merge($data ?? [], $this->responseBodyContainer->getBody());
            $response = $response->withData($newData);
        }

        return $response;
    }
}
