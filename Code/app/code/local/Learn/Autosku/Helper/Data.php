<?php
class Learn_Autosku_Helper_Data extends Mage_Core_Helper_Abstract
{
    const XML_PATH_AUTO_SKU_ENABLE      = 'autosku_tab/autosku_setting/autosku_active';
    const XML_PATH_AUTO_SKU_PREFIX      = 'autosku_tab/autosku_setting/autosku_prefix';
    const XML_PATH_AUTO_SKU_SUFFIX      = 'autosku_tab/autosku_setting/autosku_suffix';
    const XML_PATH_AUTO_SKU_PADDING     = 'autosku_tab/autosku_setting/autosku_padding';
    const XML_PATH_AUTO_SKU_TYPE        = 'autosku_tab/autosku_setting/autosku_type';
    
    public function conf($code, $store = null) {
        return Mage::getStoreConfig($code, $store);
    }

	public function autosku_enable($store) {
        return $this->conf(self::XML_PATH_AUTO_SKU_ENABLE, $store);
    }
    
	public function autosku_prefix($store) {
        return $this->conf(self::XML_PATH_AUTO_SKU_PREFIX, $store);
    }
    
	public function autosku_suffix($store) {
        return $this->conf(self::XML_PATH_AUTO_SKU_SUFFIX, $store);
    }
    
	public function autosku_padding($store) {
        return $this->conf(self::XML_PATH_AUTO_SKU_PADDING, $store);
    } 
    
	public function autosku_type($store) {
        return $this->conf(self::XML_PATH_AUTO_SKU_TYPE, $store);
    }     
    
}
