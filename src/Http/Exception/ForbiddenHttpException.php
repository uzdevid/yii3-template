<?php
declare(strict_types=1);

namespace App\Http\Exception;

use Exception;

class ForbiddenHttpException extends Exception implements UserExceptionInterface {
    /**
     * @return int
     */
    public function getStatusCode(): int {
        return 403;
    }
}
