<?php declare(strict_types=1);

namespace App\Entrypoint\Http\Exception;

use Exception;

class ForbiddenHttpException extends Exception implements HttpExceptionInterface {
    /**
     * @return int
     */
    public function getStatusCode(): int {
        return 403;
    }
}
