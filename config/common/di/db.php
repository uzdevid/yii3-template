<?php

use Yiisoft\Db\Connection\ConnectionInterface;
use Yiisoft\Db\Pgsql\Connection;
use Yiisoft\Db\Pgsql\Driver;

/** @var array $params */
return [
    ConnectionInterface::class => [
        'class' => Connection::class,
        '__construct()' => [
            'driver' => new Driver(
                dsn: $params['yiisoft/db-pgsql']['dsn'],
                username: $params['yiisoft/db-pgsql']['username'],
                password: $params['yiisoft/db-pgsql']['password']
            ),
        ],
    ],
];
