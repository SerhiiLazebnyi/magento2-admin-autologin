<?php

/**
 * Author SerhiiLazebnyi
 */

declare(strict_types=1);

namespace Serj\AdminAutoLogin\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Serj\AdminAutoLogin\Api\ConfigInterface;

class Config implements ConfigInterface
{
    private const XPATH_ENABLED = 'admin/auto_login/enable';
    private const XPATH_USER = 'admin/auto_login/user';

    public function __construct(private readonly ScopeConfigInterface $scopeConfig) {}

    public function isEnabled(): bool
    {
        return $this->scopeConfig->isSetFlag(self::XPATH_ENABLED);
    }

    public function getUserId(): int
    {
        return (int) $this->scopeConfig->getValue(self::XPATH_USER);
    }
}
