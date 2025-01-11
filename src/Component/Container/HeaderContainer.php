<?php

namespace App\Component\Container;

class HeaderContainer {
    private array $headers = [];

    /**
     * @param string $name
     * @param mixed $value
     * @return void
     */
    public function add(string $name, mixed $value): void {
        $this->headers[$name] = $value;
    }

    /**
     * @return array
     */
    public function getHeaders(): array {
        return $this->headers;
    }
}
