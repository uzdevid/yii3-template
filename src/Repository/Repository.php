<?php

namespace App\Repository;

use Closure;
use Yiisoft\ActiveRecord\ActiveQuery;
use Yiisoft\ActiveRecord\ActiveQueryInterface;
use Yiisoft\ActiveRecord\ActiveRecordInterface;

class Repository {
    /**
     * @param string|ActiveRecordInterface|Closure $arClass
     * @return ActiveQueryInterface
     */
    protected static function queryInstance(string|ActiveRecordInterface|Closure $arClass): ActiveQueryInterface {
        return new ActiveQuery($arClass);
    }
}
