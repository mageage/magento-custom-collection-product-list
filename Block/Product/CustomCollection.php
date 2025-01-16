<?php
/**
 * @author Marceli Podstawski <marceli.podstawski@gmail.com>
 */
namespace Vendor\Customization\Block\Product;

class CustomCollection extends \Magento\Catalog\Block\Product\ListProduct
{
    protected $productCollectionFactory;

    public function __construct(
        \Magento\Catalog\Block\Product\Context $context,
        \Magento\Framework\Data\Helper\PostHelper $postDataHelper,
        \Magento\Catalog\Model\Layer\Resolver $resolver,
        \Magento\Catalog\Api\CategoryRepositoryInterface $categoryRepository,
        \Magento\Framework\Url\Helper\Data $urlHelper,
        \Magento\Catalog\Helper\Output $outputHelper = null,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        array $data = [],
    ) {
        $this->productCollectionFactory = $productCollectionFactory;

        parent::__construct($context, $postDataHelper, $resolver, $categoryRepository, $urlHelper, $data, $outputHelper);
    }

    /**
     * @return \Magento\Catalog\Model\ResourceModel\Product\Collection
     */
    protected function _getProductCollection()
    {
        if (!$this->_productCollection) {
            $collection = $this->productCollectionFactory->create();
            $collection->addAttributeToSelect('*');
            $collection->getSelect()->limit(10); # Added some limit just to get some smaller batch
            $this->_productCollection = $collection;
        }

        return $this->_productCollection;
    }
}
