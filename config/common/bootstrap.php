<?php

use Psr\Container\ContainerInterface;
use Yiisoft\ActiveRecord\ConnectionProvider;
use Yiisoft\Db\Connection\ConnectionInterface;

function clientId(): string {
    return '6f72334c-5b8a-4c47-887d-4c73a1ea444f';
}

function clientSecret(): string {
    return $_ENV['CLIENT_SECRET'];
}

return [
    static function (ContainerInterface $container): void {
        /** @var ConnectionInterface $connection */
        $connection = $container->get(ConnectionInterface::class);

        ConnectionProvider::set($connection);
    },

];

