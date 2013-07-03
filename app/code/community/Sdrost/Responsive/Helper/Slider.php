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
    private $_rootCategories = array();
    private $_childProducts = array();
    private $_childCategories = array();
    
    public function getRootCategories()
    {
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
                if($cat->level == 2) {
                    array_push($this->_rootCategories, array(
                        "name"  =>  $cat->name,
                        "id"    =>  $id)
                    );
                    array_push($this->_childProducts, $this->getRandomImagesByCategory($id));
                    //var_dump($this->getRandomImagesByCategory($id));
                }
               // $this->_categories[$cat->level][] = $id;
                //array_push($arr, $cat->name);
            }
        }
       
        return $this->_rootCategories;
    }
    
    private function getRandomImagesByCategory($categoryId) 
    {
        $ids = array();
        $randomProducts = array();
        
        $cat = Mage::getModel('catalog/category')->load($categoryId);
        
        foreach($cat->getProductCollection() as $product) {
            array_push($ids, $product->getId());
            //var_dump($product->getId());
        }
       // var_dump($ids);
        $randomIds = $this->getRandomIds(4, $ids);
       // var_dump($randomIds);
        
        foreach($randomIds as $productId) {
            $product = Mage::getModel('catalog/product')->load($ids[$productId]);
//            $productInfo = array(
//                "id"  =>  $ids[$productId],
//                "name"  =>  $product->name,
//                "img"   =>  $product->getImageUrl()
//            );
            array_push($randomProducts, $product);
        }
        return $randomProducts;
    }
    
    private function getRandomIds($counter, $ids)
    {
        return array_rand($ids, $counter);
    }
    
    public function getRandomCategoryProducts()
    {
        return $this->_childProducts;
    }
    
    public function getChildCategories()
    {
        $this->collectChildCategories($this->_rootCategories);
        return $this->_childCategories;
    }
    
    public function collectChildCategories($parentCategories)
    {
        $childrenData = array();
        
        foreach($parentCategories as $category) {
            $cat = Mage::getModel('catalog/category')->load($category["id"]);
            $childData = array();
            
            foreach($cat->getChildrenCategories() as $child) {
                 
                 array_push($childData, array(
                        "id"    =>  $child->getId(),
                        "name"  =>  $child->name,
                        "img"   =>  $child->getImageUrl()
                 ));
            }
            array_push($childrenData, $childData);
            
        }
        var_dump($childrenData);
    }
}
