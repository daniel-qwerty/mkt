<?php

class Gallery_Model_Gallery extends Com_Module_Model {

    /**
     *
     * @return Gallery_Model_Gallery 
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    public function doInsert(Com_Object $obj, $languages, $imageFile) {

        $db = new Entities_Gallery();

        $id = $db->getNextId();

        foreach ($languages as $language) {
            $db->GalId = $id;
            $db->GalLanId = $language->LanId;
            $db->GalName = $obj->Name;
            $db->GalFile = $imageFile;
            $db->GalStatus = $obj->Status;
            $db->action = ACTION_INSERT;
            $db->save();
        }

        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Insertado");

        return $id;
    }

    public function doUpdate($intId, Com_Object $obj, $imageFile) {
        $db = new Entities_Gallery();
        $db->GalId = $intId;
        $db->GalLanId = $obj->Language;
        $db->GalName = $obj->Name;
        if ($imageFile != "") {
            $db->GalFile = $imageFile;
        }
        $db->GalStatus = $obj->Status;
        $db->action = ACTION_UPDATE;
        $db->save();
        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Actualizado");
    }

    public function doDelete($intId) {
        $db = new Entities_Gallery();
        $db->GalId = $intId;
        $db->action = ACTION_DELETE;
        $db->save();
        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Eliminado");
    }

    public function get($intId, $lanId) {
        $db = new Entities_Gallery();
        $db->GalId = $intId;
        $db->GalLanId = $lanId;
        $db->get();
        return $db;
    }

    public function getList($lanId, $limit = 1000) {
        $text = new Entities_Gallery();
        return $text->getAll($text->getList()->where("GalLanId={$lanId} and GalStatus = 1")->limit(0, $limit));
    }

    

}
