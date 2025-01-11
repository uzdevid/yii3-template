<?php

namespace App\Http\Exception;

use RuntimeException;

final class BadRequestHttpException extends RuntimeException implements UserExceptionInterface {
    /**
     * @return int
     */
    public function getStatusCode(): int {
        return 400;
    }
}
