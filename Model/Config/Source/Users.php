<?php

/**
 * Author SerhiiLazebnyi
 */

declare(strict_types=1);

namespace Serj\AdminAutoLogin\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;
use Magento\User\Model\ResourceModel\User\CollectionFactory;

class Users implements OptionSourceInterface
{
    public function __construct(
        private readonly CollectionFactory $userCollectionFactory
    ) {}

    public function toOptionArray(): array
    {
        $userCollection = $this->userCollectionFactory->create();
        $userCollection->addFieldToSelect(['user_id', 'username']);
        $userCollection->load();

        $options = [];
        foreach ($userCollection as $user) {
            $options[] = [
                'label' => $user['username'],
                'value' => $user['user_id'],
            ];
        }

        return $options;
    }
}
