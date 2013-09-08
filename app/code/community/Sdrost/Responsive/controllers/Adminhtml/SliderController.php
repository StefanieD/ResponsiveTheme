<?php

/**
 * Description of Slider
 *
 * @author Stefanie Drost <stefaniedrost@gmx.de>
 * @package
 * @version 0.1.0
 */
class Sdrost_Responsive_Adminhtml_SliderController extends Mage_Adminhtml_Controller_Action
{

    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function saveAction()
    {
        if ($data = $this->getRequest()->getPost()) {

            //check images
            if (isset($_FILES['slider_image1']['name']) &&
                    (file_exists($_FILES['slider_image1']['tmp_name']))) {
                try {
//                    var_dump($_FILES);
                    $uploader = new Varien_File_Uploader('slider_image1');
                    $uploader->setAllowedExtensions(array('jpg', 'jpeg', 'gif', 'png')); // or pdf or anything
                    $uploader->setAllowRenameFiles(false);
//
//                    // setAllowRenameFiles(true) -> move your file in a folder the magento way
//                    // setAllowRenameFiles(true) -> move your file directly in the $path folder
                    $uploader->setFilesDispersion(false);
//
                    $path = Mage::getBaseDir('media') . DS . 'sliderimages';
                    $urlPath = Mage::getBaseUrl('media') . 'sliderimages';
                    
                    $imageModel = Mage::getModel('responsive/sliderimages')->load(1);
                    $imageModel->addData(array(
                        'name'  =>  $_FILES['slider_image1']['name'],
                        'path'  =>  $urlPath . DS . $_FILES['slider_image1']['name']
                    ))->save();
                    
                    
//                    var_dump($path);
//                    var_dump($urlPath);
                    $uploader->save($path, $_FILES['slider_image1']['name']);

                    $data['slider_image1'] = $_FILES['slider_image1']['name'];
                } catch (Exception $e) {
                    
                }
            } else {

                if (isset($data['slider_image1']['delete']) && $data['slider_image1']['delete'] == 1)
                    $data['image_main'] = '';
                else
                    unset($data['slider_image1']);
            }
            
            
            
            if (isset($_FILES['slider_image2']['name']) &&
                    (file_exists($_FILES['slider_image2']['tmp_name']))) {
                try {
                    $uploader = new Varien_File_Uploader('slider_image2');
                    $uploader->setAllowedExtensions(array('jpg', 'jpeg', 'gif', 'png')); // or pdf or anything
                    $uploader->setAllowRenameFiles(false);
                    
                    $uploader->setFilesDispersion(false);

                    $path = Mage::getBaseDir('media') . DS . 'sliderimages';
                    $urlPath = Mage::getBaseUrl('media') . 'sliderimages';
                    
                    $imageModel = Mage::getModel('responsive/sliderimages')->load(1);
                    $imageModel->addData(array(
                        'name'  =>  $_FILES['slider_image2']['name'],
                        'path'  =>  $urlPath . DS . $_FILES['slider_image1']['name']
                    ))->save();
                    
                    $uploader->save($path, $_FILES['slider_image2']['name']);

                    $data['slider_image2'] = $_FILES['slider_image2']['name'];
                } catch (Exception $e) {
                    
                }
            } else {

                if (isset($data['slider_image2']['delete']) && $data['slider_image2']['delete'] == 1)
                    $data['image_main'] = '';
                else
                    unset($data['slider_image2']);
            }
        }
        $this->loadLayout();
        $this->renderLayout();
    }

}
