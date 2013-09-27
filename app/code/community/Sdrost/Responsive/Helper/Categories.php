<?php
/**
 * Description of Categories
 *
 * @author Stefanie Drost <stefaniedrost@gmx.de>
 * @package
 * @version 0.1.0
 */
class Sdrost_Responsive_Helper_Categories extends Mage_Core_Helper_Abstract
{
    public $defaultImage = 'category_default.jpg';
    
    public function getCategories()
    {
        $categories = array();
        
        // get all active categories
        $category = Mage::getModel('catalog/category');
        $tree = $category->getTreeModel();
        $tree->load();

        $ids = $tree->getCollection()->getAllIds();
        //$arr = array();

        // TODO: deaktivierte Kategorien nicht auslesen
        if ($ids) {
            foreach ($ids as $id) {
                $cat = Mage::getModel('catalog/category');
                $cat->load($id);
                if($cat->level == 2 && $cat->getIsActive()) {
                    array_push($categories, $cat);
                }
            }
        }
        
        return $categories;
    }
    
    public function getDefaultImage()
    {
        return Mage::getBaseUrl('skin') . 'frontend/responsive/default/images' . DS . $this->defaultImage;
    }
    
    public function getCategoryImage(Mage_Catalog_Model_Category $category, $width = 250, $height = 180)
    {
        // return when no image exists
        if (!$category->getImage()) {
            return false;
        }

        // return when the original image doesn't exist
        $imagePath = Mage::getBaseDir('media') . DS . 'catalog' . DS . 'category'
                . DS . $category->getImage();
        if (!file_exists($imagePath)) {
            return false;
        }

        // resize the image if needed
        $rszImagePath = Mage::getBaseDir('media') . DS . 'catalog' . DS . 'category'
                . DS . 'cache' . DS . $width . 'x' . $height . DS
                . $category->getImage();
        if (!file_exists($rszImagePath)) {
            $image = new Varien_Image($imagePath);
            $image->resize($width, $height);
            $image->save($rszImagePath);
        }

        // return the image URL
        return Mage::getBaseUrl('media') . '/catalog/category/cache/' . $width . 'x'
                . $height . '/' . $category->getImage();
    }

}
