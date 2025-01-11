<?php

declare(strict_types=1);

namespace App\Http;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Yiisoft\DataResponse\DataResponseFactoryInterface;
use Yiisoft\DataResponse\DataResponseFormatterInterface;
use Yiisoft\Http\Status;

final readonly class NotFoundHandler implements RequestHandlerInterface {
    /**
     * @param DataResponseFormatterInterface $formatter
     * @param DataResponseFactoryInterface $dataResponseFactory
     */
    public function __construct(
        private DataResponseFormatterInterface $formatter,
        private DataResponseFactoryInterface   $dataResponseFactory,
    ) {
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request): ResponseInterface {
        return $this->formatter->format(
            $this->dataResponseFactory->createResponse(
                'Not found.',
                Status::NOT_FOUND,
            )
        );
    }
}
