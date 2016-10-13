<?php

class Categories_Model_Category extends Com_Module_Model {

    /**
     *
     * @return Categories_Model_Category 
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    public function doInsert(Com_Object $obj, $languages, $file) {

        $db = new Entities_Category();

        $id = $db->getNextId();

        foreach ($languages as $language) {
            $db->CatId = $id;
            $db->CatLanId = $language->LanId;
            $db->CatAlias = $obj->Alias;
            $db->CatColor = $obj->Color;
            $db->CatDescription = $obj->Description;
            $db->CatImage = $file;
            $db->CatOrder = $obj->Order;
            $db->CatParentId = $obj->Parent;
            $db->CatStatus = $obj->Status;
            $db->CatType = $obj->Type; 
            $db->CatImportant = $obj->Important;
            $db->action = ACTION_INSERT;
            $db->save();
        }

        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Insertado");

        return $id;
    }

    public function doUpdate($intId, Com_Object $obj, $file) {
        $db = new Entities_Category();
        $db->CatId = $intId;
        $db->CatLanId = $obj->Language;
        $db->CatAlias = $obj->Alias;
        $db->CatColor = $obj->Color;
        $db->CatDescription = $obj->Description;
        
        if ($file != "") {
            $db->CatImage = $file;
        }
        $db->CatOrder = $obj->Order;
        $db->CatParentId = $obj->Parent;
        $db->CatStatus = $obj->Status;
        $db->CatType = $obj->Type;
        $db->CatImportant = $obj->Important;
        $db->action = ACTION_UPDATE;
        $db->save();
        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Actualizado");
    }

    public function doDelete($intId) {
        $db = new Entities_Category();
        $db->CatId = $intId;
        $db->action = ACTION_DELETE;
        $db->save();
        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Eliminado");
    }

    public function refreshOrder($lanId, $lstModuleCodes) {
        foreach ($lstModuleCodes as $intIndex => $intValue) {
            $db = new Entities_Category();
            $db->CatId = $intValue;
            $db->CatLanId = $lanId;
            $db->CatOrder = $intIndex;
            $db->action = ACTION_UPDATE;
            $db->save();
        }
        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Items Ordenados!");
    }

    public function getParents($lanId, $intId = 0) {
        $db = new Entities_Category();
        return $db->getAll($db->getList()->where("{$db}.CatLanId={$lanId}")->andWhere("{$db}.CatId!={$intId}")->orderBy("CatOrder"));
    }

    public function get($intId, $lanId) {
        $db = new Entities_Category();
        $db->CatId = $intId;
        $db->CatLanId = $lanId;
        $db->get();
        return $db;
    }

    public function getByUrl($url, $lanId) {
        $db = new Entities_Category();
        $db->CatUrl = $url;
        $db->CatLanId = $lanId;
        $db->get();
        return $db;
    }

    public function getList($lanId) {
        $db = new Entities_Category();
        return $db->getAll($db->getList()->where("CatLanId={$lanId}")->orderBy("CatOrder"));
    }
    
    public function getImportant($lanId, $type, $limit = 1000) {
        $db = new Entities_Category();
        return $db->getAll($db->getList()->where("CatLanId={$lanId}")->andWhere("CatType={$type}"));
    }
    
    public function getCategories($lanId, $type, $limit = 1000) {
        $db = new Entities_Category();
        return $db->getAll($db->getList()->where("CatLanId={$lanId}")->andWhere("CatType={$type}")->limit(0, $limit));
    }

    public function getMenuList($lanId, $parentId = 0) {
        $db = new Entities_Category();
        return $db->getAll($db->getMenuList()->andWhere("{$db}.CatLanId={$lanId}")->andWhere("CatParentId={$parentId}")->orderBy("CatOrder"));
    }
    
    

    public function getParentList($lanId, $parentId = 0) {
        $blocked = array(1, 2, 14);
        $list = array();
        while ($parentId > 0) {
            $parent = $this->get($parentId, $lanId);
            if (!(in_array($parent->CatId, $blocked))) {
                $list[] = $parent;
            }
            $parentId = $parent->CatParentId;
        }
        $list = array_reverse($list);
        return $list;
    }
    
    public function getByAlias($lanId, $strAlias) {
        $db = new Entities_Category();
        $db->CatLanId = $lanId;
        $db->CatAlias = $strAlias;
        $db->get();
        return $db;
    }
    
    public function getById($lanId, $strAlias) {
        $db = new Entities_Category();
        $db->CatLanId = $lanId;
        $db->CatId = $strAlias;
        $db->get();
        return $db;
    }

}
