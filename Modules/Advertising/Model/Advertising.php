<?php

class Advertising_Model_Advertising extends Com_Module_Model {

    /**
     *
     * @return Advertising_Model_Advertising 
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    public function doInsert(Com_Object $obj, $image) {

        $db = new Entities_Advertising();
        $db->AdCatId = $obj->Category;
        $db->AdName = $obj->Name;
        $db->AdImage = $image;
        $db->AdLink = $obj->Link;
        $db->AdDateStart = $obj->DateStart;
        $db->AdDateEnd = $obj->DateEnd;
        $db->AdViews = $obj->Views;
        $db->AdStatus = $obj->Status;
        $db->AdSize = $obj->Size;
        $db->action = ACTION_INSERT;
        $db->save();
        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Insertado");
    }

    public function doUpdate($intId, Com_Object $obj, $image) {
        $db = new Entities_Advertising();
        $db->AdId = $intId;
        $db->AdCatId = $obj->Category;
        $db->AdName = $obj->Name;
        
         if ($image != "") {
            $db->AdImage = $image;
        }
        $db->AdLink = $obj->Link;
        $db->AdDateStart = $obj->DateStart;
        $db->AdDateEnd = $obj->DateEnd;
        $db->AdViews = $obj->Views;
        $db->AdStatus = $obj->Status;
        $db->AdSize = $obj->Size;
        $db->action = ACTION_UPDATE;
        $db->save();
        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Actualizado");
    }
    
    public function doUpdateService($intId, $view) {
        $db = new Entities_Advertising();
        $db->AdId = $intId;        
        $db->AdViews = $this->get($intId)->AdViews + 1;        
        $db->action = ACTION_UPDATE;
        $db->save();
        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Actualizado");
    }
    
    public function doUpdatePrint($intId) {
        $db = new Entities_Advertising();
        $db->AdId = $intId;        
        $db->AdDatePrint = date("Y-m-d H:i:s");  
        $db->AdPrint = $this->get($intId)->AdPrint + 1;
        $db->action = ACTION_UPDATE;
        $db->save();
        //Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Actualizado");
    }

    public function doDelete($intId) {
        $db = new Entities_Advertising();
        $db->AdId = $intId;
        $db->action = ACTION_DELETE;
        $db->save();
        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Eliminado");
    }

    public function get($intId) {
        $db = new Entities_Advertising();
        $db->AdId = $intId;
        $db->get();
        return $db;
    }
    
    

    public function getByName($strName) {
        $db = new Entities_Advertising();
        $db->AdName = $strName;
        $db->get();
        return $db;
    }

    public function getList() {
        $contact = new Entities_Advertising();
        return $contact->getAll($contact->getList());
    }
    
    public function getAd($type,$limit = 1000) {
        $text = new Entities_Advertising();
        $date = date("Y-m-d");
        return $text->getAll($text->getList()->where("AdStatus = 1")->andWhere("AdDateStart <='{$date}'")->andWhere("AdDateEnd >='{$date}'")->andWhere("AdSize = '{$type}'")->orderBy("AdDatePrint asc")->limit(0, $limit));
    }
    

}
