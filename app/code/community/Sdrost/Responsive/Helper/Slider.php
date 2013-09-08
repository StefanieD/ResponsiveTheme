<?php

/**
 * Description of Treemap
 *
 * @author Stefanie Drost <stefaniedrost@gmx.de>
 * @package
 * @version 0.1.0
 */
class Sdrost_Responsive_Helper_Slider extends Mage_Core_Helper_Abstract
{
    private $images = array();
    private $folderPath;
    
    public function __construct()
    {
        $this->folderPath = Mage::getBaseDir("media") . "/sliderimages/default";
    }
    
    public function getSliderImages()
    {
//        $directory = $this->getImagesFolderPath();
//
//        if (is_dir($directory)) {
//            if ($dh = opendir($directory)) {
//                while (($file = readdir($dh)) !== false) {
//                    if (is_file($directory.'/'.$file) && $file != "." && $file != ".."){ 
//                        array_push($this->images, Mage::getBaseUrl("media") . 
//                                'sliderimages/default/' . $file);
//                    }
//                }
//                closedir($dh);
//            }
//        }
        
//        return $this->images;Mage::getModel('responsive/sliderimages')->getCollection();
        return Mage::getModel('responsive/sliderimages')->getCollection();
    }
    
    public function getImagesFolderPath()
    {
        return $this->folderPath;
    }
}
