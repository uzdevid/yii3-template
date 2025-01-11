<?php

namespace App\Http\Dto;

use Yiisoft\Arrays\ArrayableInterface;
use Yiisoft\Arrays\ArrayableTrait;

class SuccessResponseData implements ArrayableInterface {
    use ArrayableTrait;

    public bool $success = true;

    /**
     * @param array|null $payload
     */
    public function __construct(
        public readonly array|null $payload = null
    ) {
    }
}
