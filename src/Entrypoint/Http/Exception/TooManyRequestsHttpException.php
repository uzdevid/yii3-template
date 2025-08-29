<?php declare(strict_types=1);

namespace App\Entrypoint\Http\Exception;

use RuntimeException;

class TooManyRequestsHttpException extends RuntimeException implements HttpExceptionInterface {
    /**
     * @return int
     */
    public function getStatusCode(): int {
        return 429;
    }
}
