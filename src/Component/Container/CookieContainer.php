<?php

namespace App\Component\Container;

use Yiisoft\Cookies\Cookie;

class CookieContainer {
    private array $cookies = [];

    /**
     * @param Cookie $cookie
     * @return void
     */
    public function add(Cookie $cookie): void {
        $this->cookies[] = $cookie;
    }

    /**
     * @return Cookie[]
     */
    public function getCookies(): array {
        return $this->cookies;
    }
}
