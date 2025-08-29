<?php declare(strict_types=1);

namespace App\Entrypoint\Http\Middleware;

use App\Entrypoint\Http\Exception\HttpExceptionInterface;
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
        } catch (InputValidationException $exception) {
            $errors = $exception->getResult()->getFirstErrorMessagesIndexedByPath();

            $errors = array_map(
                static fn($attribute, $message) => ['attribute' => $attribute, 'message' => $message],
                array_keys($errors), $errors
            );
            $response = $this->dataResponseFactory->createResponse(['message' => $exception->getMessage(), 'code' => $exception->getCode(), 'errors' => $errors], Status::UNPROCESSABLE_ENTITY);
        } catch (HttpExceptionInterface $exception) {
            $response = $this->dataResponseFactory->createResponse(['message' => $exception->getMessage(), 'code' => $exception->getCode()], $exception->getStatusCode());
        } catch (Throwable $exception) {
            $response = $this->dataResponseFactory->createResponse(['message' => $exception->getMessage(), 'code' => $exception->getCode()], Status::INTERNAL_SERVER_ERROR);
        }

        return $response;
    }
}
