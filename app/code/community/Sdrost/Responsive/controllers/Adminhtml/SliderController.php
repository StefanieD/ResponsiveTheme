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

    protected $postData;
    protected $urlPath;
    protected $path;
    
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function saveAction()
    {
        if ($this->data = $this->getRequest()->getPost()) {

            $this->urlPath = Mage::getBaseUrl('media') . 'sliderimages';
            $this->path = Mage::getBaseDir('media') . DS . 'sliderimages';
            
            //check images
            $this->checkForSliderImage($_FILES, 1);
            $this->checkForSliderImage($_FILES, 2);
            $this->checkForSliderImage($_FILES, 3);
            
        }
        $this->_forward('index');
    }
    
    private function checkForSliderImage($filesData, $imageId)
    {
        $fieldname = 'slider_image' . $imageId;
        
        if (isset($filesData[$fieldname]['name']) &&
                    (file_exists($filesData[$fieldname]['tmp_name']))) {
                try {
                    // define directory and url of image
                    $imagePath = $this->path . DS . $filesData[$fieldname]['name'];
                    $url = $this->urlPath . DS . $filesData[$fieldname]['name'];
                    
                    // save image in directory
                    $this->saveSliderImage($fieldname, $filesData);
        
                    // new db entry
                    $imageModel = Mage::getModel('responsive/sliderimages')
                            ->load($imageId);
                    
                    // unlink existing image
                    if(!is_null($imageModel->getPath())){
                        unlink($imageModel->getPath());
                    }
                    
                    $imageModel->addData(array(
                        'name'  =>  $filesData[$fieldname]['name'],
                        'path'  =>  $imagePath,
                        'url'   =>  $url
                    ))->save();
                } catch (Exception $e) {
                    
                }
            } else {
                if (isset($this->data[$fieldname]['delete']) && 
                        $this->data[$fieldname]['delete'] == 1){
                    
                    $this->data['image_main'] = '';
                    $this->deleteImage($fieldname);
                    
                    // update image entry
                    $imageModel = Mage::getModel('responsive/sliderimages')
                            ->load($imageId);
                    $imageModel->addData(array(
                        'name'  =>  '',
                        'path'  =>  '',
                        'url'   =>  ''
                    ))->save();
                } 
                else{
                    unset($this->data[$fieldname]);
                } 
            }
    }
    
    /**
     * Saves image into slider directory.
     * 
     * @param string $fieldname
     * @param array $filesData
     */
    private function saveSliderImage($fieldname, $filesData)
    {
        $uploader = new Varien_File_Uploader($fieldname);
        $uploader->setAllowedExtensions(array('jpg', 'jpeg', 'gif', 'png'));
        $uploader->setAllowRenameFiles(false);
        $uploader->setFilesDispersion(false);
        $uploader->save($this->path, $filesData[$fieldname]['name']);

        $this->data[$fieldname] = $filesData[$fieldname]['name'];
    }
    
    /**
     * Deletes image from slider directory.
     * 
     * @param string $fieldname
     * @param integer $imageId
     */
    private function deleteImage($fieldname)
    {             
        // unlink image file
        $url = Mage::getBaseUrl('media');
        $imagePath = Mage::getBaseDir('media') . DS . str_replace($url, "", $this->data[$fieldname]['value']);
        unlink($imagePath);         
    }
}
