<?php

namespace App\Entrypoint\Http\Exception;

interface HttpExceptionInterface {
    /**
     * Http status code
     * @return int
     */
    public function getStatusCode(): int;
}
