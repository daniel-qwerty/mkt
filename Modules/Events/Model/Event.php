<?php

class Events_Model_Event extends Com_Module_Model {

    /**
     *
     * @return Events_Model_Event 
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    public function doInsert(Com_Object $obj, $languages, $imageFile) {

        $db = new Entities_Event();

        $id = $db->getNextId();

        foreach ($languages as $language) {
            $db->EveId = $id;
            $db->EveLanId = $language->LanId;
            $db->EveCatId = $obj->Category;
            $db->EveContent = $obj->Content;
            $db->EveDate = $obj->Date;
            $db->EveImage = $imageFile;
            $db->EveImportant = $obj->Important;
            $db->EveStatus = $obj->Status;
            $db->EveTitle = $obj->Title;
            $db->EveVideo = $obj->Video;
            $db->action = ACTION_INSERT;
            $db->save();
        }

        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Insertado");

        return $id;
    }

    public function doUpdate($intId, Com_Object $obj, $imageFile) {
        $db = new Entities_Event();
        $db->EveId = $intId;
        $db->EveLanId = $obj->Language;
        $db->EveCatId = $obj->Category;
        $db->EveContent = $obj->Content;
        $db->EveDate = $obj->Date;
        $db->EveImportant = $obj->Important;
        $db->EveStatus = $obj->Status;
        $db->EveTitle = $obj->Title;
        $db->EveVideo = $obj->Video;
        if ($imageFile != "") {
            $db->EveImage = $imageFile;
        }
        $db->action = ACTION_UPDATE;
        $db->save();
        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Actualizado");
    }

    public function doDelete($intId) {
        $db = new Entities_Event();
        $db->EveId = $intId;
        $db->action = ACTION_DELETE;
        $db->save();
        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Eliminado");
    }

    public function get($intId, $lanId) {
        $db = new Entities_Event();
        $db->EveId = $intId;
        $db->EveLanId = $lanId;
        $db->get();
        return $db;
    }

    public function getList($lanId, $limit = 1000) {
        $text = new Entities_Event();
        return $text->getAll($text->getList()->where("EveLanId={$lanId} and EveStatus = 1")->orderBy("EveDate desc")->limit(0, $limit));
    }
    public function getListByDate($lanId,$date, $limit = 1000) {
        $text = new Entities_Event();
        return $text->getAll($text->getList()->where("EveLanId={$lanId} and EveDate='{$date}' and EveStatus = 1")->orderBy("EveDate desc")->limit(0, $limit));
    }

    public function getListRecientes($lanId, $limit = 1000) {
        $text = new Entities_Event();
        return $text->getAll($text->getList()->where("EveLanId={$lanId} and EveStatus = 1 and EveImportant = 0")->orderBy("EveDate desc")->limit(0, $limit));
    }

    public function getImportant($lanId, $limit = 1000) {
        $text = new Entities_Event();
        return $text->getAll($text->getList()->where("EveLanId={$lanId} and EveStatus = 1 and EveImportant = 1 ")->orderBy("EveDate desc")->limit(0, $limit));
    }
    
    public function getByCategory($lanId,$category, $limit = 1000) {
        $text = new Entities_Event();
        return $text->getAll($text->getList()->where("EveLanId={$lanId} and EveStatus = 1 and EveCatId = '{$category}' ")->orderBy("EveDate desc")->limit(0, $limit));
    }

    public function getMostViewd($lanId, $limit = 1000) {
        $text = new Entities_Event();
        return $text->getAll($text->getList()->where("EveLanId={$lanId} and EveStatus = 1")->orderBy("EveViews desc")->limit(0, $limit));
    }

    public function getListNext($lanId, $id, $limit = 1000) {
        $text = new Entities_Event();
        return $text->getAll($text->getList()->where("EveLanId={$lanId} and EveStatus = 1")->andWhere("EveId <> {$id}")->orderBy("EveDate desc")->limit(0, $limit));
    }

    public function getListByArchive($lanId, $year, $month, $limit = 1000) {
        $text = new Entities_Event();
        return $text->getAll($text->getList()->where("EveLanId={$lanId} and EveStatus = 1")->andWhere("DATE_FORMAT(EveDate,'%Y') like '{$year}'")->andWhere("DATE_FORMAT(EveDate,'%m') like '{$month}'")->orderBy("EveDate desc")->limit(0, $limit));
    }

    public function getArchives($lanId) {
        $text = new Entities_Event();
        $years = Com_Database_Query::getInstance()->select("distinct DATE_FORMAT(EveDate,'%Y') as year")->from($text)->where("EveLanId={$lanId} and EveStatus = 1")->orderBy("EveDate desc");
        $months = Com_Database_Query::getInstance()->select("distinct DATE_FORMAT(EveDate,'%m') as month")->from($text)->where("EveLanId={$lanId} and EveStatus = 1")->orderBy("EveDate");
        $list['years'] = $text->getAll($years);
        $list['months'] = $text->getAll($months);
        return $list;
    }

    public function getListByParent($lanId, $category, $limit = 1000) {
        $text = new Entities_Event();
        $result = Com_Database_Query::getInstance()->select()->from("Category")->innerJoin("Evees", "Evees.EveCatId=Category.CatId")->where("Category.CatParentId={$category} and EveStatus = 1 and EveLanId='{$lanId}'and CatLanId='{$lanId}'")->orderBy("EveDate desc")->limit(0, $limit);

        return $text->getAll($result);
    }

    

}
