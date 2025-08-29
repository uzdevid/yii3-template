<?php declare(strict_types=1);

namespace App\Entrypoint\Http\Exception;

use RuntimeException;

class ServerErrorHttpException extends RuntimeException implements HttpExceptionInterface {
    /**
     * @return int
     */
    public function getStatusCode(): int {
        return 500;
    }
}
