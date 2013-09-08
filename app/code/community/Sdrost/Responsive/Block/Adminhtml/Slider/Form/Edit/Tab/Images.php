<?php
class Sdrost_Responsive_Block_Adminhtml_Slider_Form_Edit_Tab_Images 
    extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('slider_form_images', array(
            'legend'=>Mage::helper('responsive')->__('Images')));
          
        // add three images fields
        $imageNumber = count(Mage::getModel('responsive/sliderimages')->getCollection());
        $imageCounter = 1;
        
        while($imageCounter <= $imageNumber){
            $fieldname = 'slider_image' . $imageCounter;
            $value = Mage::getModel('responsive/sliderimages')->load($imageCounter)->getPath();
            
            $fieldset->addField($fieldname, 'image', array(
                'label'     =>  Mage::helper('responsive')->__('Image ' . $imageCounter),
                'required'  =>  false,
                'name'      =>  $fieldname,
                'value'     =>  $value
            ));
            $imageCounter++;
        }
        
//        $fieldset->addField('slider_image1', 'image', array(
//            'label' => Mage::helper('responsive')->__('Image 1'),
//            'required' => false,
//            'name' => 'slider_image1',
//        ));
//        $fieldset->addField('slider_image2', 'image', array(
//            'label' => Mage::helper('responsive')->__('Image 2'),
//            'required' => false,
//            'name' => 'slider_image2',
//        ));
//        $fieldset->addField('slider_image3', 'image', array(
//            'label' => Mage::helper('responsive')->__('Image 3'),
//            'required' => false,
//            'name' => 'slider_image3',
//        ));
          
        return parent::_prepareForm();
    }
}