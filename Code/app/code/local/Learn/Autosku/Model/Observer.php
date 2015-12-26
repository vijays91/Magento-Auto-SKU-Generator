<?php
class Learn_Autosku_Model_Observer
{
    
    public function autoSkuGenerate($observer) {
        $helper = Mage::helper('autosku');
        if($helper->autosku_enable()) {
            $padding = $helper->autosku_padding();
            $type = $helper->autosku_type();
            
            $data = Mage::app()->getRequest()->getPost();
            $product = $observer->getEvent()->getProduct();
            $product_id = $product->getId();
            $product_name = $product->getName();
            $cats = $product->getCategoryIds();
            
            $categoryName = array();
            $new_sku = ""; 
            if(count($cats) >= 1 ) {
                foreach ($cats as $category_id) {
                    $categoryName[] = self::getCategorName($category_id);
                }
                $categoryName = isset($categoryName[0]) ? $categoryName[0] : "";
                $new_sku .= substr($categoryName, 0, 2);
            }            
            if(!$product_id && isset($data['isauto']) == 1 && $type == 2) {
                $new_sku .= substr($product_name, 0, 2);
                $prev_id = Mage::app()->getLayout()->createBlock('autosku/adminhtml_catalog_product_edit')->getprevEntityId();
                $new_sku .=  str_pad($prev_id + 1, $padding, 0, STR_PAD_LEFT);               
                $product->setSku(strtolower($new_sku));
            }
        }
    }
    
    protected function getCategorName($category_id) {
        $_cat = Mage::getModel('catalog/category')->setStoreId(Mage::app()->getStore()->getId())->load($category_id);
        return $_cat->getName();
    }
}
