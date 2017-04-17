<?php

namespace Devchannel\CustomAttribute\Setup;

use Magento\Customer\Api\AddressMetadataInterface;
use Magento\Eav\Setup\EavSetup;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    /**
     * Attribute Code of the Custom Attribute
     */
    const CUSTOM_ATTRIBUTE_CODE = 'custom';

    /**
     * @var EavSetup
     */
    private $eavSetup;

    /**
     * InstallData constructor.
     * @param EavSetup $eavSetup
     */
    public function __construct(
        EavSetup $eavSetup
    ) {
        $this->eavSetup = $eavSetup;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $this->eavSetup->addAttribute(
           AddressMetadataInterface::ENTITY_TYPE_ADDRESS,
            self::CUSTOM_ATTRIBUTE_CODE,
            [
                'label' => 'Custom',
                'input' => 'text',
                'visible' => true,
                'required' => false,
                'position' => 150,
                'sort_order' => 150,
                'system' => false,
                'user_defined' => true
            ]
        );

        $setup->endSetup();
    }
}
