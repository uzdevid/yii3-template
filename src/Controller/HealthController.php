<?php
declare(strict_types=1);

namespace App\Controller;

use App\Http\Dto\NoReformatResponse;
use Yiisoft\DataResponse\DataResponse;
use Yiisoft\DataResponse\DataResponseFactoryInterface;

readonly final class HealthController {
    /**
     * @param DataResponseFactoryInterface $responseFactory
     */
    public function __construct(
        private DataResponseFactoryInterface $responseFactory,
    ) {
    }

    /**
     * @return DataResponse
     */
    public function check(): DataResponse {
        return $this->responseFactory->createResponse(new NoReformatResponse([]));
    }
}
