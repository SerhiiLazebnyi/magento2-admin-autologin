<?php

/**
 * Author SerhiiLazebnyi
 */

declare(strict_types=1);

namespace Serj\AdminAutoLogin\Plugin\Magento\Backend\Controller\Adminhtml\Index;

use Magento\Backend\Controller\Adminhtml\Auth\Login;
use Serj\AdminAutoLogin\Api\AutoLoginInterface;
use Serj\AdminAutoLogin\Api\ConfigInterface;

class ProcessAutoLogin
{
    public function __construct(
        private readonly AutoLoginInterface $autoLogin,
        private readonly ConfigInterface $config
    ) {}

    public function beforeExecute(Login $subject): void
    {
        if (!$this->config->isEnabled()) {
            return;
        }

        $this->autoLogin->processLogin();
    }
}
