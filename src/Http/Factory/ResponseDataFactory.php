<?php

declare(strict_types=1);

namespace App\Http\Factory;

use App\Http\Dto\FailResponseData;
use App\Http\Dto\SuccessResponseData;
use RuntimeException;
use Yiisoft\DataResponse\DataResponse;

final class ResponseDataFactory {
    /**
     * @param DataResponse $response
     * @return SuccessResponseData|FailResponseData
     */
    public function createFromResponse(DataResponse $response): SuccessResponseData|FailResponseData {
        if (!$this->isSuccessResponse($response)) {
            return $response->getData();
        }

        $data = $response->getData();

        if ($data !== null && !is_array($data)) {
            throw new RuntimeException('The response data must be either null or an array');
        }

        return $this->createSuccessResponse($data);
    }

    /**
     * @param array|null $payload
     * @return SuccessResponseData
     */
    public function createSuccessResponse(array|null $payload): SuccessResponseData {
        return new SuccessResponseData($payload);
    }

    /**
     * @param DataResponse $dataResponse
     * @return bool
     */
    private function isSuccessResponse(DataResponse $dataResponse): bool {
        $code = $dataResponse->getStatusCode();
        return $code >= 200 && $code < 400;
    }
}
