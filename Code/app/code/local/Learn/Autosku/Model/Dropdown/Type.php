<?php
class Learn_Autosku_Model_Dropdown_Type
{
    public function toOptionArray()
    {
        return array(
            array('value' => 2, 'label'=>Mage::helper('adminhtml')->__('Category and Product(Both 2 Characters) Name')),
            array('value' => 1, 'label'=>Mage::helper('adminhtml')->__('Custom SKU')),
        );
    }
}
