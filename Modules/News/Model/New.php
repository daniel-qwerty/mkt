<?php

class News_Model_New extends Com_Module_Model {

    /**
     *
     * @return News_Model_New 
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    public function doInsert(Com_Object $obj, $languages, $imageFile) {

        $db = new Entities_New();

        $id = $db->getNextId();

        foreach ($languages as $language) {
            $db->NewId = $id;
            $db->NewLanId = $language->LanId;
            $db->NewCatId = $obj->Category;
            $db->NewTitle = $obj->Title;
            $db->NewContent = $obj->Content;
            $db->NewDate = $obj->Date;
            $db->NewUrl = generateUrl($obj->Title);
            $db->NewDescription = $obj->Description;
            $db->NewAuthor = $obj->Author;
            $db->NewImage = $imageFile;
            $db->NewStatus = $obj->Status;
            $db->NewImportant = $obj->Important;
            $db->action = ACTION_INSERT;
            $db->save();
        }

        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Insertado");

        return $id;
    }

    public function doUpdate($intId, Com_Object $obj, $imageFile) {
        $db = new Entities_New();
        $db->NewId = $intId;
        $db->NewLanId = $obj->Language;
        $db->NewTitle = $obj->Title;
        $db->NewCatId = $obj->Category;
        $db->NewContent = $obj->Content;
        $db->NewDate = $obj->Date;
        $db->NewUrl = generateUrl($obj->Title);
        $db->NewDescription = $obj->Description;
        $db->NewAuthor = $obj->Author;
        if ($imageFile != "") {
            $db->NewImage = $imageFile;
        }
        $db->NewStatus = $obj->Status;
        $db->NewImportant = $obj->Important;
        $db->action = ACTION_UPDATE;
        $db->save();
        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Actualizado");
    }

    public function doDelete($intId) {
        $db = new Entities_New();
        $db->NewId = $intId;
        $db->action = ACTION_DELETE;
        $db->save();
        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Eliminado");
    }

    public function get($intId, $lanId) {
        $db = new Entities_New();
        $db->NewId = $intId;
        $db->NewLanId = $lanId;
        $db->get();
        return $db;
    }

    public function getByUrl($url, $lanId) {
        $db = new Entities_New();
        $db->NewUrl = $url;
        $db->NewLanId = $lanId;
        $db->get();
        return $db;
    }

    public function getList($lanId, $limit = 1000, $category) {
        $text = new Entities_New();
        return $text->getAll($text->getList()->where("NewLanId={$lanId} and NewStatus = 1 and NewCatId='{$category}'")->orderBy("NewDate desc")->limit(0, $limit));
    }
    
    public function getImportant($lanId, $limit = 1000) {
        $text = new Entities_New();
        return $text->getAll($text->getList()->where("NewLanId={$lanId} and NewStatus = 1 ")->orderBy("NewImportant desc")->limit(0, $limit));
    }

    public function getListNext($lanId, $id, $limit = 1000) {
        $text = new Entities_New();
        return $text->getAll($text->getList()->where("NewLanId={$lanId} and NewStatus = 1")->andWhere("NewId <> {$id}")->orderBy("NewDate desc")->limit(0, $limit));
    }

    public function getListByArchive($lanId, $year, $month, $limit = 1000) {
        $text = new Entities_New();
        return $text->getAll($text->getList()->where("NewLanId={$lanId} and NewStatus = 1")->andWhere("DATE_FORMAT(NewDate,'%Y') like '{$year}'")->andWhere("DATE_FORMAT(NewDate,'%m') like '{$month}'")->orderBy("NewDate desc")->limit(0, $limit));
    }

    public function getArchives($lanId) {
        $text = new Entities_New();
        $years = Com_Database_Query::getInstance()->select("distinct DATE_FORMAT(NewDate,'%Y') as year")->from($text)->where("NewLanId={$lanId} and NewStatus = 1")->orderBy("NewDate desc");
        $months = Com_Database_Query::getInstance()->select("distinct DATE_FORMAT(NewDate,'%m') as month")->from($text)->where("NewLanId={$lanId} and NewStatus = 1")->orderBy("NewDate");
        $list['years'] = $text->getAll($years);
        $list['months'] = $text->getAll($months);
        return $list;
    }

}
