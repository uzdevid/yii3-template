<?php

declare(strict_types=1);

use App\Controller\HealthController;
use Yiisoft\Router\Route;

return [
    Route::get('/health/check')->action([HealthController::class, 'check'])
];
