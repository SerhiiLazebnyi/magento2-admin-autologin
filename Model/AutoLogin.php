<?php

/**
 * Author SerhiiLazebnyi
 */

declare(strict_types=1);

namespace Serj\AdminAutoLogin\Model;

use Magento\Backend\Model\Auth\StorageInterface;
use Magento\User\Model\ResourceModel\User as UserResource;
use Magento\User\Model\UserFactory;
use Psr\Log\LoggerInterface;
use Serj\AdminAutoLogin\Api\AutoLoginInterface;
use Serj\AdminAutoLogin\Api\ConfigInterface;
use Serj\AdminAutoLogin\Model\Config\Source\Users;

class AutoLogin implements AutoLoginInterface
{
    public function __construct(
        private readonly ConfigInterface $config,
        private readonly LoggerInterface $logger,
        private readonly StorageInterface $backendSession,
        private readonly UserFactory $userFactory,
        private readonly UserResource $userResource,
        private readonly Users $usersSource
    ) {}

    public function processLogin(): void
    {
        $userId = $this->config->getUserId();

        if (!$userId) {
            $userId = $this->getFirstUserIdFromSource();
        }

        if (!$userId) {
            $this->logger->info('Auto login user is not set');

            return;
        }

        $user = $this->userFactory->create();
        $this->userResource->load($user, $userId);

        $this->backendSession->setUser($user);
        $this->backendSession->processLogin();
    }

    private function getFirstUserIdFromSource(): int
    {
        $sourceData = $this->usersSource->toOptionArray();
        $firstUser = \current($sourceData);

        return (int) $firstUser['value'] ?? 0;
    }
}
