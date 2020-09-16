<?php
namespace Alvor\CmsList\Block;

use Magento\Cms\Model\PageRepository;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\View\Element\Template\Context;

class CmsList extends \Magento\Framework\View\Element\Template
{
    private $pageRepository;
    private $criteriaBuilder;
    private $pageCollection;

    public function __construct(
        PageRepository $pageRepository,
        SearchCriteriaBuilder $criteriaBuilder,
        Context $context
    ) {
        parent::__construct($context);
        $this->criteriaBuilder = $criteriaBuilder;
        $this->pageRepository = $pageRepository;
    }

    public function getCmsPageList()
    {
        if (!$this->pageCollection) {
            $this->initFilters();
            $this->pageCollection = $this->pageRepository->getList($this->criteriaBuilder->create());
        }
        return $this->pageCollection->getItems();
    }

    public function initFilters()
    {
        $this->criteriaBuilder->addFilter(\Magento\Cms\Model\Page::IS_ACTIVE, true);
    }

}
