<?php

namespace App\Http\Exception;

use RuntimeException;

final class NotFoundHttpExceptionInterface extends RuntimeException implements UserExceptionInterface {
    /**
     * @return int
     */
    public function getStatusCode(): int {
        return 404;
    }
}
