<?php

namespace App\Service\Tracing;

use Ramsey\Uuid\Uuid;
use Yiisoft\RequestProvider\RequestHeaderProvider;

readonly final class HeaderTracer implements TraceInterface {
    private string|int $traceId;

    /**
     * @param RequestHeaderProvider $requestHeaders
     */
    public function __construct(
        private RequestHeaderProvider $requestHeaders
    ) {
    }

    /**
     * @return string|int
     */
    public function getId(): string|int {
        if (!$this->requestHeaders->has('X-Request-Id')) {
            return $this->traceId ?? ($this->traceId = $this->generate());
        }

        return $this->requestHeaders->getLine('X-Request-Id');
    }

    /**
     * @return string|int
     */
    public function generate(): string|int {
        return Uuid::uuid4()->toString();
    }
}
