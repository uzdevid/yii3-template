<?php

namespace App\Http\Exception;

use RuntimeException;

class ServerErrorHttpException extends RuntimeException implements UserExceptionInterface {
    /**
     * @return int
     */
    public function getStatusCode(): int {
        return 500;
    }
}
