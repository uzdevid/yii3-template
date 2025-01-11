<?php

namespace App\Exception;

use http\Exception\RuntimeException;

class InvalidConfigException extends RuntimeException implements ApplicationException { }
