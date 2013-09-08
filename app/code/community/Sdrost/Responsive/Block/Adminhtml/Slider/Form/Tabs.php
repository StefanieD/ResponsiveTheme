<?php
class Sdrost_Responsive_Block_Adminhtml_Slider_Form_Tabs 
    extends Mage_Adminhtml_Block_Widget_Tabs
{
 
  public function __construct()
  {
      parent::__construct();
      $this->setId('form_tabs');
      $this->setDestElementId('edit_form'); // form tag in edit folder
      $this->setTitle(Mage::helper('responsive')->__('Slider Configuration'));
  }
 
  protected function _beforeToHtml()
  {
      $this->addTab('slider_general_section', array(
          'label'     => Mage::helper('responsive')->__('General'),
          'title'     => Mage::helper('responsive')->__('General'),
          'content'   => $this->getLayout()
              ->createBlock('responsive/adminhtml_slider_form_edit_tab_general')->toHtml(),
      ));
      
      $this->addTab('slider_images_section', array(
          'label'     => Mage::helper('responsive')->__('Images'),
          'title'     => Mage::helper('responsive')->__('Images'),
          'content'   => $this->getLayout()
              ->createBlock('responsive/adminhtml_slider_form_edit_tab_images')->toHtml(),
      ));
      
      return parent::_beforeToHtml();
  }
}