<?php

class Books_Model_BookMall extends Com_Module_Model {

    /**
     *
     * @return Books_Model_BookMall 
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    public function doInsert(Com_Object $obj, $languages, $image) {

        $db = new Entities_BookMall();

        $id = $db->getNextId();

        foreach ($languages as $language) {
            $db->BooId = $id;
            $db->BooLanId = $language->LanId;
            $db->BooTitle = $obj->Title;
            $db->BooAuthor = $obj->Author;
            $db->BooContent = $obj->Content;
            $db->BooImage = $image;
            $db->BooPrice = $obj->Price;
            $db->BooStatus = $obj->Status;
            $db->action = ACTION_INSERT;
            $db->save();
        }

        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Insertado");

        return $id;
    }

    public function doUpdate($intId, Com_Object $obj, $image) {
        $db = new Entities_BookMall();
        $db->BooId = $intId;
        $db->BooLanId = $obj->Language;
        $db->BooTitle = $obj->Title;
        $db->BooAuthor = $obj->Author;
        $db->BooContent = $obj->Content;
        if ($imageFile != "") {
            $db->BooImage = $image;
        }
        
        $db->BooPrice = $obj->Price;
        $db->BooStatus = $obj->Status;
        $db->action = ACTION_UPDATE;
        $db->save();
        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Actualizado");
    }

    public function doDelete($intId) {
        $db = new Entities_BookMall();
        $db->BooId = $intId;
        $db->action = ACTION_DELETE;
        $db->save();
        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Eliminado");
    }

    public function get($intId, $lanId) {
        $db = new Entities_BookMall();
        $db->BooId = $intId;
        $db->BooLanId = $lanId;
        $db->get();
        return $db;
    }

    public function getByAlias($lanId, $strAlias) {
        $db = new Entities_BookMall();
        $db->BooLanId = $lanId;
        $db->BooTitle = $strAlias;
        $db->get();
        return $db;
    }

    public function getList() {
        $text = new Entities_BookMall();
        return $text->getAll($text->getList());
    }
    
    public function getListByParent($lanId,$limit = 1000 ) {
        $text = new Entities_BookMall();
        //$result = Com_Database_Query::getInstance()->select()->from("Category")->innerJoin("Notes", "Notes.NotCatId=Category.CatId")->where("Category.CatParentId={$category} and NotStatus = 1 and NotLanId='{$lanId}'and CatLanId='{$lanId}'")->orderBy("NotDate desc")->limit(0, $limit);
        return $text->getAll($text->getList()->where("TooLanId={$lanId} and TooStatus = 1 ")->limit(0, $limit));
        //return $text->getAll($result);
    }
    
    public function getList2($lanId,$limit = 1000 ) {
        $text = new Entities_BookMall();
        return $text->getAll($text->getList()->where("BooLanId={$lanId} and BooStatus = 1 ")->limit(0, $limit));
    }

}
