<?php

declare(strict_types=1);

use App\Component\Container\CookieContainer;
use App\Component\Container\HeaderContainer;
use App\Component\Container\ResponseBodyContainer;
use App\Http\NotFoundHandler;
use App\Http\Provider\TracerProvider;
use App\Http\Provider\TracerProviderInterface;
use Yiisoft\Definitions\DynamicReference;
use Yiisoft\Definitions\Reference;
use Yiisoft\Di\StateResetter;
use Yiisoft\Injector\Injector;
use Yiisoft\Middleware\Dispatcher\MiddlewareDispatcher;

/** @var array $params */

return [
    Yiisoft\Yii\Http\Application::class => [
        '__construct()' => [
            'dispatcher' => DynamicReference::to(static function (Injector $injector) use ($params) {
                return $injector->make(MiddlewareDispatcher::class)->withMiddlewares($params['middlewares']);
            }),
            'fallbackHandler' => Reference::to(NotFoundHandler::class),
        ],
    ],
    StateResetter::class => [
        'class' => StateResetter::class,
        '__construct()' => [
            [
                CookieContainer::class => function () { $this->cookies = []; },
                HeaderContainer::class => function () { $this->headers = []; },
                ResponseBodyContainer::class => function () { unset($this->body); },
            ]
        ]
    ],
    TracerProviderInterface::class => TracerProvider::class
];
