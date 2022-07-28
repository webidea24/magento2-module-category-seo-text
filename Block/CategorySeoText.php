<?php

namespace Webidea24\CategorySeoText\Block;

use Magento\Catalog\Model\Category;
use Magento\Catalog\Model\Layer\Resolver;
use Magento\Framework\View\Element\Template;

class CategorySeoText extends Template
{

    /**
     * @var Resolver
     */
    private $catalogResolver;

    public function __construct(
        Template\Context $context,
        Resolver $resolver,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->catalogResolver = $resolver;
    }

    public function toHtml()
    {
        if (!empty($this->getSeoText())) {
            return parent::toHtml();
        }

        return '';
    }

    public function getSeoText()
    {
        return $this->getCurrentCategory()->getData('wi24_seo_text');
    }

    public function getCurrentCategory(): Category
    {
        return $this->catalogResolver->get()->getCurrentCategory();
    }
}
