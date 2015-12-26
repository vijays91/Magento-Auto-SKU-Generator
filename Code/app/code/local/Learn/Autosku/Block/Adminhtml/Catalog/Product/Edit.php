<?php
class Learn_Autosku_Block_Adminhtml_Catalog_Product_Edit extends Mage_Adminhtml_Block_Catalog_Product_Edit
{
    protected function _prepareLayout()
    {
        $helper = Mage::helper('autosku');
        if($helper->autosku_enable()) {
            if (!$this->getRequest()->getParam('popup')) {
            
                $this->setTemplate('autosku/catalog/product/edit.phtml');
                $this->setChild('back_button',
                    $this->getLayout()->createBlock('adminhtml/widget_button')
                    ->setData(array(
                        'label'     => Mage::helper('catalog')->__('Back'),
                        'onclick'   => 'setLocation(\''.$this->getUrl('*/*/', array('store'=>$this->getRequest()->getParam('store', 0))).'\')',
                        'class' => 'back'
                        ))
                    );
            } else {
                $this->setChild('back_button',
                    $this->getLayout()->createBlock('adminhtml/widget_button')
                    ->setData(array(
                        'label'     => Mage::helper('catalog')->__('Close Window'),
                        'onclick'   => 'window.close()',
                        'class' => 'cancel'
                        ))
                    );
            }

            if (!$this->getProduct()->isReadonly()) {
                $this->setChild('reset_button',
                    $this->getLayout()->createBlock('adminhtml/widget_button')
                    ->setData(array(
                        'label'     => Mage::helper('catalog')->__('Reset'),
                        'onclick'   => 'setLocation(\''.$this->getUrl('*/*/*', array('_current'=>true)).'\')'
                        ))
                    );
            
                $this->setChild('save_button',
                    $this->getLayout()->createBlock('adminhtml/widget_button')
                    ->setData(array(
                        'label'     => Mage::helper('catalog')->__('Save'),
                        'onclick'   => 'productForm.submit()', /* removeCheck(); */
                        'class' => 'save'
                        ))
                    );
            }

            if (!$this->getRequest()->getParam('popup')) {
                if (!$this->getProduct()->isReadonly()) {
                    $this->setChild('save_and_edit_button',
                        $this->getLayout()->createBlock('adminhtml/widget_button')
                        ->setData(array(
                            'label'     => Mage::helper('catalog')->__('Save and Continue Edit'),
                            'onclick'   => 'saveAndContinueEdit(\''.$this->getSaveAndContinueUrl().'\')', /* removeCheck(); */
                            'class' => 'save'
                            )
                        )
                        );
                }
                if ($this->getProduct()->isDeleteable()) {
                    $this->setChild('delete_button',
                        $this->getLayout()->createBlock('adminhtml/widget_button')
                        ->setData(array(
                            'label'     => Mage::helper('catalog')->__('Delete'),
                            'onclick'   => 'confirmSetLocation(\''.Mage::helper('catalog')->__('Are you sure?').'\', \''.$this->getDeleteUrl().'\')',
                            'class'  => 'delete'
                            ))
                        );
                }

                if ($this->getProduct()->isDuplicable()) {
                    $this->setChild('duplicate_button',
                        $this->getLayout()->createBlock('adminhtml/widget_button')
                        ->setData(array(
                            'label'     => Mage::helper('catalog')->__('Duplicate'),
                            'onclick'   => 'setLocation(\'' . $this->getDuplicateUrl() . '\')',
                            'class'  => 'add'
                            ))
                        );
                }
            }
        } else {
            parent::_prepareLayout();
        }
    }

    public function skuAuto()
    {
        $helper = Mage::helper('autosku');
        $prev_id = $this->getprevEntityId();
        $prev_id = 1 + $prev_id;
        $new_sku = "";
        if($helper->autosku_enable()) {
            $prefix  = $helper->autosku_prefix();
            $suffix  = $helper->autosku_suffix();
            $padding = $helper->autosku_padding();
            /* $type = $helper->autosku_type(); */
            $new_sku =  $prefix. str_pad($prev_id, $padding, 0, STR_PAD_LEFT).$suffix;
        }
       return $new_sku;
    }

    public function getprevEntityId()
    { 
        $connection = Mage::getSingleton('core/resource')->getConnection('read');
        $table =  Mage::getSingleton('core/resource')->getTableName('catalog_product_entity'); 
        $sql = "SELECT entity_id FROM {$table} ORDER BY entity_id DESC LIMIT 1";
        $getprevEntityId=$connection->fetchOne($sql); 
        return $getprevEntityId;       
   }
   
}
