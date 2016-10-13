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

}
