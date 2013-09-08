<?php
class Sdrost_Responsive_Block_Adminhtml_Slider_Form_Edit_Tab_General 
    extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('slider_form_general', array(
            'legend'=>Mage::helper('responsive')->__('General')));
          
        $fieldset->addField('title', 'text', array(
          'label'     => Mage::helper('responsive')->__('Title'),
          'required'  => false,
          'name'      => 'title',
        ));
        
            $fieldset->addField('fileinputname', 'image', array(
              'label'     => Mage::helper('responsive')->__('File label'),
//              'required'  => false,
              'name'      => 'fileinputname',
    ));
          
        return parent::_prepareForm();
    }
}