<?php

class Configurations_Helper_Configuration extends Com_Object {

    /**
     *
     * @return Configurations_Helper_Configuration 
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    
    public function getKey($strKey) {
        return Configurations_Model_Configuration::getInstance()->getByKey($strKey)->ConValue;
    }
    
    

}
