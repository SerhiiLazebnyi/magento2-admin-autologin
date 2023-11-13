<?php

/**
 * Author SerhiiLazebnyi
 */

declare(strict_types=1);

namespace Serj\AdminAutoLogin\Api;

interface AutoLoginInterface
{
    public function processLogin(): void;
}
