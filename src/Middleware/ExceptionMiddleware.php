<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Exception\ApplicationException;
use App\Http\Dto\FailResponseData;
use App\Http\Dto\InputValidationFailResponseData;
use App\Http\Exception\UserExceptionInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Throwable;
use Yiisoft\DataResponse\DataResponseFactoryInterface;
use Yiisoft\Http\Status;
use Yiisoft\Input\Http\InputValidationException;

final readonly class ExceptionMiddleware implements MiddlewareInterface {
    /**
     * @param DataResponseFactoryInterface $dataResponseFactory
     */
    public function __construct(
        private DataResponseFactoryInterface $dataResponseFactory
    ) {
    }

    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface {
        try {
            $response = $handler->handle($request);
        } catch (ApplicationException $exception) {
            $response = $this->dataResponseFactory->createResponse(new FailResponseData($exception->getMessage(), $exception->getCode()), Status::INTERNAL_SERVER_ERROR);
        } catch (InputValidationException $exception) {
            $response = $this->dataResponseFactory->createResponse(new InputValidationFailResponseData($exception), Status::UNPROCESSABLE_ENTITY);
        } catch (UserExceptionInterface $exception) {
            $response = $this->dataResponseFactory->createResponse(new FailResponseData($exception->getMessage(), $exception->getCode()), $exception->getStatusCode());
        } catch (Throwable $exception) {
            $response = $this->dataResponseFactory->createResponse(new FailResponseData($exception->getMessage(), $exception->getCode()), Status::INTERNAL_SERVER_ERROR);
        }

        return $response;
    }
}
