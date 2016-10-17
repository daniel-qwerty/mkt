<?php

class CatTools_Helper_CatTool extends Com_Object {

    /**
     *
     * @return CatTools_Helper_CatTool 
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    public function get($lan, $alias) {
        return CatTools_Model_CatTool::getInstance()->getByAlias($lan->LanId, $alias);
    }

}
