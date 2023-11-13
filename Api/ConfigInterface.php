<?php

/**
 * Author SerhiiLazebnyi
 */

namespace Serj\AdminAutoLogin\Api;

interface ConfigInterface
{
    public function isEnabled(): bool;

    public function getUserId(): int;
}
