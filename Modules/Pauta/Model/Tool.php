<?php

class Tools_Model_Tool extends Com_Module_Model {

    /**
     *
     * @return Tools_Model_Tool 
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    public function doInsert(Com_Object $obj, $languages) {

        $db = new Entities_Tool();

        $id = $db->getNextId();

        foreach ($languages as $language) {
            $db->TooId = $id;
            $db->TooLanId = $language->LanId;
            $db->TooName = $obj->Name;
            $db->TooDescription = $obj->Description;
            $db->TooType = $obj->Type;
            $db->TooLink = $obj->Link;
            $db->TooCatId = $obj->Category;
            $db->TooStatus = $obj->Status;
            $db->action = ACTION_INSERT;
            $db->save();
        }

        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Insertado");

        return $id;
    }

    public function doUpdate($intId, Com_Object $obj) {
        $db = new Entities_Tool();
        $db->TooId = $intId;
        $db->TooLanId = $obj->Language;
        $db->TooName = $obj->Name;
        $db->TooDescription = $obj->Description;
        $db->TooType = $obj->Type;
        $db->TooLink = $obj->Link;
        $db->TooStatus = $obj->Status;
        $db->TooCatId = $obj->Category;
        $db->action = ACTION_UPDATE;
        $db->save();
        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Actualizado");
    }

    public function doDelete($intId) {
        $db = new Entities_Tool();
        $db->TooId = $intId;
        $db->action = ACTION_DELETE;
        $db->save();
        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Eliminado");
    }

    public function get($intId, $lanId) {
        $db = new Entities_Tool();
        $db->TooId = $intId;
        $db->TooLanId = $lanId;
        $db->get();
        return $db;
    }

    public function getByAlias($lanId, $strAlias) {
        $db = new Entities_Tool();
        $db->TooLanId = $lanId;
        $db->TooName = $strAlias;
        $db->get();
        return $db;
    }

    public function getList() {
        $text = new Entities_Tool();
        return $text->getAll($text->getList());
    }
    
    public function getListByParent($lanId, $category,$limit = 1000 ) {
        $text = new Entities_Tool();
        //$result = Com_Database_Query::getInstance()->select()->from("Category")->innerJoin("Notes", "Notes.NotCatId=Category.CatId")->where("Category.CatParentId={$category} and NotStatus = 1 and NotLanId='{$lanId}'and CatLanId='{$lanId}'")->orderBy("NotDate desc")->limit(0, $limit);
        return $text->getAll($text->getList()->where("TooLanId={$lanId} and TooCatId={$category} and TooStatus = 1 ")->limit(0, $limit));
        //return $text->getAll($result);
    }
    
    public function getList2($lanId,$limit = 1000 ) {
        $text = new Entities_Tool();
        return $text->getAll($text->getList()->where("TooLanId={$lanId} and TooStatus = 1 ")->limit(0, $limit));
    }

}
