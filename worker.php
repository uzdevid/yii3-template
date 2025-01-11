<?php

use Yiisoft\Yii\Runner\RoadRunner\RoadRunnerHttpApplicationRunner;

ini_set('display_errors', 'stderr');

require_once __DIR__ . '/autoload.php';

(new RoadRunnerHttpApplicationRunner(
    rootPath: __DIR__,
    debug: $_ENV['YII_DEBUG'],
    checkEvents: $_ENV['YII_DEBUG'],
    environment: $_ENV['YII_ENV']
))->run();
