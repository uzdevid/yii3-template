<?php

namespace App\Http\Exception;

interface UserExceptionInterface {
    /**
     * Http status code
     * @return int
     */
    public function getStatusCode(): int;
}
