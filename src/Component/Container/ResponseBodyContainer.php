<?php
declare(strict_types=1);

namespace App\Component\Container;

class ResponseBodyContainer {
    private array $body;

    /**
     * @param array $body
     * @return void
     */
    public function withBody(array $body): void {
        $this->body = $body;
    }

    /**
     * @return bool
     */
    public function hasBody(): bool {
        return isset($this->body);
    }

    /**
     * @return array
     */
    public function getBody(): array {
        return $this->body;
    }
}
