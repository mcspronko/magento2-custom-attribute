<?php

namespace Devchannel\CustomAttribute\Setup;

use Magento\Customer\Api\AddressMetadataInterface;
use Magento\Eav\Setup\EavSetup;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Model\Config;

/**
 * Class InstallData
 * @package     Devchannel\CustomAttribute\Setup
 */
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
     * @var Config
     */
    private $eavConfig;

    /**
     * InstallData constructor.
     * @param EavSetup $eavSetup
     * @param Config $config
     */
    public function __construct(
        EavSetup $eavSetup,
        Config $config
    ) {
        $this->eavSetup = $eavSetup;
        $this->eavConfig = $config;
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
                'system' => false
            ]
        );

        $customAttribute = $this->eavConfig->getAttribute(
            AddressMetadataInterface::ENTITY_TYPE_ADDRESS,
            self::CUSTOM_ATTRIBUTE_CODE
        );

        $customAttribute->setData(
            'used_in_forms',
            ['adminhtml_customer_address', 'customer_address_edit', 'customer_register_address']
        );

        $customAttribute->save();

        $setup->endSetup();
    }
}
