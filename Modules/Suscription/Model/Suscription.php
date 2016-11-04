<?php

class Suscription_Model_Suscription extends Com_Module_Model {

    /**
     *
     * @return Suscription_Model_Suscription 
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    public function doInsert(Com_Object $obj, $languages, $image) {

        $db = new Entities_Suscription();

        $id = $db->getNextId();

        foreach ($languages as $language) {
            $db->SusId = $id;
            $db->SusLanId = $language->LanId;
            $db->SusTitle = $obj->Title;
            $db->SusDescription = $obj->Description;
            $db->SusPrice = $obj->Price;
            $db->SusColor = $obj->Color;           
            $db->SusStatus = $obj->Status;
            $db->SusImage = $image;
            $db->action = ACTION_INSERT;
            $db->save();
        }

        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Insertado");

        return $id;
    }

    public function doUpdate($intId, Com_Object $obj, $image) {
        $db = new Entities_Suscription();
        $db->SusId = $intId;
        $db->SusLanId = $obj->Language;
        $db->SusTitle = $obj->Title;
        $db->SusDescription = $obj->Description;
        $db->SusPrice = $obj->Price;
        $db->SusColor = $obj->Color;           
        $db->SusStatus = $obj->Status;
        if ($image != "") {
            $db->SusImage = $image;
        }
        
        $db->save();
        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Actualizado");
    }

    public function doDelete($intId) {
        $db = new Entities_Suscription();
        $db->SusId = $intId;
        $db->action = ACTION_DELETE;
        $db->save();
        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Eliminado");
    }

    public function get($intId, $lanId) {
        $db = new Entities_Suscription();
        $db->SusId = $intId;
        $db->SusLanId = $lanId;
        $db->get();
        return $db;
    }

    public function getByAlias($lanId, $strAlias) {
        $db = new Entities_Suscription();
        $db->SusLanId = $lanId;
        $db->SusTitle = $strAlias;
        $db->get();
        return $db;
    }

    public function getList() {
        $text = new Entities_Suscription();
        return $text->getAll($text->getList());
    }
    
   
    
    public function getList2($lanId,$limit = 1000 ) {
        $text = new Entities_Suscription();
        return $text->getAll($text->getList()->where("SusLanId={$lanId} and SusStatus = 1 ")->limit(0, $limit));
    }

}
