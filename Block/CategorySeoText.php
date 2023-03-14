<?php declare(strict_types=1);

namespace Webidea24\CategorySeoText\Block;

use Magento\Catalog\Helper\Output;
use Magento\Catalog\Model\Category;
use Magento\Catalog\Model\Layer\Resolver;
use Magento\Framework\View\Element\Template;

class CategorySeoText extends Template
{

    private Resolver $catalogResolver;

    private Output $outputHelper;

    public function __construct(
        Template\Context $context,
        Resolver $resolver,
        Output $outputHelper,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->catalogResolver = $resolver;
        $this->outputHelper = $outputHelper;
    }

    public function toHtml()
    {
        if (!empty($this->getSeoText())) {
            return parent::toHtml();
        }

        return '';
    }

    public function getSeoText(): ?string
    {
        $category = $this->getCurrentCategory();
        $html = $category->getData('wi24_seo_text');

        return !empty($html) ? $this->outputHelper->categoryAttribute($category, $html, 'wi24_seo_text') : null;
    }

    public function getCurrentCategory(): Category
    {
        return $this->catalogResolver->get()->getCurrentCategory();
    }
}
