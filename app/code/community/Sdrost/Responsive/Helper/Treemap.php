<?php

/**
 * Description of Treemap
 *
 * @author Stefanie Drost <stefaniedrost@gmx.de>
 * @package
 * @version 0.1.0
 */
class Sdrost_Responsive_Helper_Treemap extends Mage_Core_Helper_Abstract
{

    protected $_categories = array();
    protected $_parentCategories = array();
    protected $_treemapData;

    public function getCategories()
    {
       /* $categories = Mage::getModel('catalog/category');
        $this->_categories = $categories->getCollection()
                ->addAttributeToSelect(array('name')) //or whatever fields you want
                ->addAttributeToFilter('is_active', 1);
                //->addIdFilter($categories->getChildren())
                //->setOrder('position', 'ASC')
                //->joinUrlRewrite()
                //->toArray();
        
        return $this->_categories;*/
        
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
                if($cat->level == 1) {
                    array_push($this->_parentCategories, $id);
                }
               // $this->_categories[$cat->level][] = $id;
                //array_push($arr, $cat->name);
            }
        }
        
        return $this->_parentCategories;
    }

    public function getCategoryJson()
    {
        // get all active categories
        $category = Mage::getModel('catalog/category');
        $tree = $category->getTreeModel();
        $tree->load();

        $ids = $tree->getCollection()->getAllIds();
        $arr = array();

        // TODO: deaktivierte Kategorien nicht auslesen
        if ($ids) {
            foreach ($ids as $id) {
                $cat = Mage::getModel('catalog/category');
                $cat->load($id);
                $arr[$cat->level][] = $cat->name;
                //array_push($arr, $cat->name);
            }
        }

        return $arr;
    }
    
    public function generateCategoryJson()
    {
        $this->initRoot();
        $this->getCategories();
        $this->initJson();
        //var_dump($this->_parentCategories);
        
        /*$this->_treemapData["children"] = array(
                array("name" => "TestThree", 
                    "children" => array(
                        array("name" => "Child1", "value" => 1),
                        array("name" => "Child2", "value" => 2)
                        )
                    ),
                array("name" => "Test", "value" => 12),
                array("name" => "TestZwo", "value" => 22)
                );*/
        /*$data = array("name" => "categories", 
            "children" => array(
                array("name" => "Test", "value" => 12),
                array("name" => "TestZwo", "value" => 22)
                ));*/
        
        $this->writeJsonFile($this->_treemapData);
        
    }
    
    private function initJson() 
    {
        $this->_treemapData["children"] = array();
        $catData = array();
            
        foreach($this->_parentCategories as $categoryID) {
            $cat = Mage::getModel('catalog/category');
            $cat->load($categoryID);
            
            //$catChildren = $cat->getChildren();
            //var_dump($cat->name);
            $catData = $this->initChildren($cat);
            /*if ($cat->hasChildren()) {
                $catChildren = $this->initChildren($cat->getChildren());
                //var_dump($cat->getChildren());

                $catData = array(
                    "name" => $cat->name,
                    "children" => $catChildren
                );
            } else {
                $catData = array(
                    "name" => $cat->name,
                    "value" => 1
                );
            }*/
            $this->_treemapData["children"] = $catData;
            //array_push($this->_treemapData["children"], $catData);
        }
    }
    
    private function initChildren($category)
    {
        if ($category->hasChildren()) {
            
            $childrenArray = explode(",", $category->getChildren());
            $childrenData = array();
            
            foreach ($childrenArray as $childId) {
                $cat = Mage::getModel('catalog/category');
                $cat->load($childId);
                //var_dump($cat->name);
                if ($cat->hasChildren()) {
                    array_push($childrenData, array(
                        "name" => $cat->name,
                        "id" => $childId,
                        "children" => $this->initChildren($cat)
                    ));
                } else {
                    array_push($childrenData, array(
                        "name" => $cat->name,
                        "id" => $childId,
                        "value" => $cat->getProductCount()
                    ));
                }
            }
            
            return $childrenData;
        } else {
            return array(
                "name" => $category->name,
                "id" => $category->getId(),
                "value" => $cat->getProductCount()
            );
        }
        //var_dump($result);
        //return $result;
    }
    
    private function initRoot()
    {
        $this->_treemapData = array("name" => "categories");
    }
    
    private function writeJsonFile($data)
    {
        $base_path = Mage::getBaseDir('base');
        $path = $base_path . '/skin/frontend/responsive/default/js/test.json';
           
        $fp = fopen($path, 'w+');
        fwrite($fp, json_encode($data));
        fclose($fp);
    }

}

