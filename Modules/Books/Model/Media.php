<?php

class Books_Model_Media extends Com_Module_Model {

    /**
     *
     * @return Books_Model_Media 
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    public function doInsert(Com_Object $obj, $fileName, $language) {
        $db = new Entities_MediaBookMall();

        $id = $db->getNextId();

        $db->MedId = $id;
        $db->MedLanId = $language;
        $db->MedBookId = $obj->BookId;
        $db->MedImage = $fileName;
        $db->MedFooter = $obj->Footer;
        $db->MedYoutube = $obj->Youtube;
        $db->MedStatus = 1;
        $db->action = ACTION_INSERT;
        $db->save();


        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Insertado");
    }

    public function doUpdate($intId, Com_Object $obj) {
        $idList = $obj->ImageListId;
        $videoList = $obj->ImageListVideo;
        $footerList = $obj->ImageListFooter;


        for ($i = 0; $i < count($idList); $i++) {
            $db = new Entities_MediaBookMall();
            $db->MedId = $idList[$i];
            $db->MedLanId = $obj->Language;
            $db->MedYoutube = $videoList[$i];
            $db->MedFooter = $footerList[$i];
            $db->MedStatus = 1;
            $db->action = ACTION_UPDATE;
            $db->save();
        }

        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registros Actualizados");
    }

    public function doDelete($intId) {
        $db = new Entities_MediaBookMall();
        $db->MedId = $intId;
        $db->action = ACTION_DELETE;
        $db->save();
        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Eliminado");
    }

    public function getList() {
        $db = new Entities_MediaBookMall();
        return $db->getAll($db->getList());
    }

    public function getListByProject($ProId, $lanId) {
        $db = new Entities_MediaBookMall();
        return $db->getAll($db->getListQuery()->where("MedBookId={$ProId}")->andWhere("MedLanId={$lanId}")->orderBy("MedId"));
    }

}
