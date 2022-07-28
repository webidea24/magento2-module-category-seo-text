<?php

namespace Webidea24\CategorySeoText\Setup;

use Magento\Catalog\Model\Category;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;

class InstallData implements InstallDataInterface
{
    /**
     * @var EavSetupFactory
     */
    private $eavSetupFactory;

    public function __construct(EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        /** @var EavSetup $eavSetup */
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        $eavSetup->addAttribute(Category::ENTITY, 'wi24_seo_text', [
            'type' => 'text',
            'label' => 'SEO-Text',
            'input' => 'textarea',
            'visible' => true,
            'default' => '',
            'required' => false,
            'global' => ScopedAttributeInterface::SCOPE_STORE,
            'group' => 'Content',
        ]);
    }
}
