<?php declare(strict_types=1);

namespace App\Entrypoint\Http;

use JsonException;
use Psr\Http\Message\ResponseInterface;
use Yiisoft\DataResponse\DataResponse;
use Yiisoft\DataResponse\DataResponseFormatterInterface;
use Yiisoft\DataResponse\Formatter\JsonDataResponseFormatter;

final readonly class ResponseFormatter implements DataResponseFormatterInterface {
    /**
     * @param JsonDataResponseFormatter $jsonDataResponseFormatter
     */
    public function __construct(
        private JsonDataResponseFormatter $jsonDataResponseFormatter
    ) {
    }

    /**
     * @param DataResponse $dataResponse
     * @return ResponseInterface
     * @throws JsonException
     */
    public function format(DataResponse $dataResponse): ResponseInterface {
        return $this->jsonDataResponseFormatter->format($dataResponse);
    }
}
