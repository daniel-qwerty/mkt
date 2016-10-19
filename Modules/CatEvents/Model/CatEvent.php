<?php

class CatEvents_Model_CatEvent extends Com_Module_Model {

    /**
     *
     * @return CatEvents_Model_CatEvent 
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    public function doInsert(Com_Object $obj, $languages) {

        $db = new Entities_CatEvents();

        $id = $db->getNextId();

        foreach ($languages as $language) {
            $db->CatId = $id;
            $db->CatLanId = $language->LanId;
            $db->CatName = $obj->Name;
            $db->CatStatus = $obj->Status;
            $db->action = ACTION_INSERT;
            $db->save();
        }

        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Insertado");

        return $id;
    }

    public function doUpdate($intId, Com_Object $obj) {
        $db = new Entities_CatEvents();
        $db->CatId = $intId;
        $db->CatLanId = $obj->Language;
        $db->CatName = $obj->Name;
        $db->CatStatus = $obj->Status;
        $db->action = ACTION_UPDATE;
        $db->save();
        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Actualizado");
    }

    public function doDelete($intId) {
        $db = new Entities_CatEvents();
        $db->CatId = $intId;
        $db->action = ACTION_DELETE;
        $db->save();
        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Eliminado");
    }

    public function get($intId, $lanId) {
        $db = new Entities_CatEvents();
        $db->CatId = $intId;
        $db->CatLanId = $lanId;
        $db->get();
        return $db;
    }

    public function getByAlias($lanId, $strAlias) {
        $db = new Entities_CatEvents();
        $db->CatLanId = $lanId;
        $db->CatAlias = $strAlias;
        $db->get();
        return $db;
    }

    public function getList() {
        $text = new Entities_CatEvents();
        return $text->getAll($text->getList());
    }
    
    public function getList2($lanId, $limit = 10) {
        $text = new Entities_CatEvents();
        return $text->getAll($text->getList()->where("CatLanId={$lanId} and CatStatus = 1 ")->limit(0, $limit));
    }

}
