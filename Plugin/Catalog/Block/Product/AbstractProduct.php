<?php

namespace Hyva\GtmPro\Plugin\Catalog\Block\Product;

use Hatimeria\GtmPro\Plugin\Catalog\Block\Product\AbstractProduct as PluginClass;
use Magento\Catalog\Model\Product;
use Magento\Catalog\Block\Product\AbstractProduct as CatalogAbstractProduct;
use Magento\Catalog\Block\Product\ListProduct as ListProductBlock;
use Hatimeria\GtmPro\Block\Catalog\Product\ProductList\ItemDataLayerData;

/**
 * Class AbstractProduct
 */
class AbstractProduct
{
    /**
     * Plugin created to overwrite phtml template when using Hyva compatible module for Hatimeria_GtmPro
     *
     * @param PluginClass $subject
     * @param CatalogAbstractProduct|ListProductBlock $subjectFromPlugin
     * @param $result
     * @param Product $product
     * @return string
     */
    public function aroundAfterGetProductDetailsHtml($subject, $next, $subjectFromPlugin, $result, $product)
    {
        /** @var ItemDataLayerData $itemDataLayer */
        $itemDataLayer = $subjectFromPlugin->getLayout()->getBlockSingleton(ItemDataLayerData::class);
        $dataLayer = $itemDataLayer->setProduct($product)
            ->setTemplate('Hyva_GtmPro::catalog/product/productlist/itemdatalayerdata.phtml')
            ->toHtml();

        return empty($result) || empty($dataLayer) || strstr($result, $dataLayer) ? $result : $result . $dataLayer;
    }
}
