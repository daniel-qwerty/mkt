<?php

class Categories_Helper_Category extends Com_Object {

    /**
     *
     * @return Categories_Helper_Category 
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    public function get($lan, $alias) {
        return Categories_Model_Category::getInstance()->getByAlias($lan->LanId, $alias);
    }
    
    public function getId($lan, $id) {
        return Categories_Model_Category::getInstance()->getById($lan->LanId, $id);
    }
    public function getHexa($lan, $id) {
        $color = Categories_Model_Category::getInstance()->getById($lan->LanId, $id)->CatClass;
        switch ($color) {
            case 'red':
                return '255,0,0';               
            case 'pink':
                return '255,0,255';
            case 'orange':
                return '255,128,9';
            case 'yellow':
                return '255,255,51'; 
            case 'green':
                return '128,255,0';
            case 'blue':
                return '0,128,255'; 
            case 'aqua':
                return '102,255,255';     
            case 'purple':
                return '127,0,255';
            default:
                return '0,0,0';
        }
        
    }

}
