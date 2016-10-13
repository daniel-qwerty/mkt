<?php

class CatAdvertising_Model_Category extends Com_Module_Model {

    /**
     *
     * @return CatAdvertising_Model_Category 
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    public function doInsert(Com_Object $obj) {

        $db = new Entities_CatAdvertising();
        $db->CatName = $obj->Name;
        $db->CatType = $obj->Type;
        $db->CatStatus = $obj->Status;
        $db->action = ACTION_INSERT;
        $db->save();
        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Insertado");
    }

    public function doUpdate($intId, Com_Object $obj) {
        $db = new Entities_CatAdvertising();
        $db->CatId = $intId;
        $db->CatName = $obj->Name;
        $db->CatType = $obj->Type;
        $db->CatStatus = $obj->Status;
        $db->action = ACTION_UPDATE;
        $db->save();
        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Actualizado");
    }

    public function doDelete($intId) {
        $db = new Entities_CatAdvertising();
        $db->CatId = $intId;
        $db->action = ACTION_DELETE;
        $db->save();
        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Eliminado");
    }

    public function get($intId) {
        $db = new Entities_CatAdvertising();
        $db->CatId = $intId;
        $db->get();
        return $db;
    }

    public function getByName($strName) {
        $db = new Entities_CatAdvertising();
        $db->CatName = $strName;
        $db->get();
        return $db;
    }

    public function getList() {
        $contact = new Entities_CatAdvertising();
        return $contact->getAll($contact->getList());
    }
     public function getByAlias($strName) {
        $db = new Entities_CatAdversiting();
        $db->CatName = $strName;
        $db->get();
        return $db;
    }

}
