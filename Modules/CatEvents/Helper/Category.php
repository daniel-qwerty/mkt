<?php

class CatEvents_Helper_Category extends Com_Object {

    /**
     *
     * @return CatEvents_Helper_Category 
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    public function get($lan, $alias) {
        return CatEvents_Model_CatEvent::getInstance()->getByAlias($lan->LanId, $alias);
    }
    
    public function getId($lan, $id) {
        return CatEvents_Model_CatEvent::getInstance()->getById($lan->LanId, $id);
    }
    public function getHexa($lan, $id) {
        $color = CatEvents_Model_CatEvent::getInstance()->getById($lan->LanId, $id)->CatClass;
        switch ($color) {
            case 'red':
                return '245,8,7';               
            case 'pink':
                return '245,8,7';
            case 'orange':
                return '247,98,9';
            case 'yellow':
                return '244,244,0'; 
            case 'green':
                return '9,248,8';
            case 'blue':
                return '6,5,244'; 
            case 'aqua':
                return '9,249,249';     
            case 'purple':
                return '204,54,247';
            default:
                return '0,0,0';
        }
        
    }

}
