<?php

namespace App\Http\Exception;

use RuntimeException;

class TooManyRequestsHttpException extends RuntimeException implements UserExceptionInterface {
    /**
     * @return int
     */
    public function getStatusCode(): int {
        return 429;
    }
}
