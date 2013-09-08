<?php

/**
 * Container contains header and buttons in content area.
 */
class Sdrost_Responsive_Block_Adminhtml_Slider_Form_Container 
    extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                  
        $this->_objectId = 'id';
        $this->_blockGroup = 'responsive';
        $this->_controller = 'adminhtml_slider_form';
         
        $this->_updateButton('save', 'label', Mage::helper('responsive')->__('Save'));
//        $this->_updateButton('delete', 'label', Mage::helper('responsive')->__('Delete'));
         
        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);
    }
 
    public function getHeaderText()
    {
        return Mage::helper('responsive')->__('Slider Configuration');
    }
}