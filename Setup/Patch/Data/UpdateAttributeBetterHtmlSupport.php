<?php
declare(strict_types=1);

namespace Webidea24\CategorySeoText\Setup\Patch\Data;

use Magento\Catalog\Model\Category;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class UpdateAttributeBetterHtmlSupport implements DataPatchInterface
{
    private ModuleDataSetupInterface $moduleDataSetup;

    private EavSetupFactory $eavSetupFactory;

    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        EavSetupFactory $eavSetupFactory
    )
    {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function apply(): self
    {
        $this->moduleDataSetup->getConnection()->startSetup();
        /** @var \Magento\Catalog\Setup\CategorySetup $eavSetup */
        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);
        $eavSetup->updateAttribute(Category::ENTITY, 'wi24_seo_text', 'is_html_allowed_on_front', 1);
        $eavSetup->updateAttribute(Category::ENTITY, 'wi24_seo_text', 'is_wysiwyg_enabled', 1);

        $this->moduleDataSetup->getConnection()->endSetup();

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases(): array
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies(): array
    {
        return [];
    }
}
