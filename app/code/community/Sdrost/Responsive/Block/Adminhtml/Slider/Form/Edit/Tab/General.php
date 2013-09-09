<?php

class Sdrost_Responsive_Block_Adminhtml_Slider_Form_Edit_Tab_General extends Mage_Adminhtml_Block_Widget_Form
{

    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('slider_form_general', array(
            'legend' => Mage::helper('responsive')->__('General')));

        $fieldset->addField('slider_activation', 'checkbox', array(
            'label' => Mage::helper('responsive')->__('Activate Slider'),
            'name' => 'slider_activation',
            'checked' => true,
            'value' => '1',
            'disabled' => false
        ));

        return parent::_prepareForm();
    }

}