<?php

namespace App\Service\Tracing;

interface TraceInterface {
    /**
     * @return string|int
     */
    public function getId(): string|int;
}
