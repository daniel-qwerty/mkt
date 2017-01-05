<?php

class Notes_Model_Note extends Com_Module_Model {

    /**
     *
     * @return Notes_Model_Note 
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    public function doInsert(Com_Object $obj, $languages, $imageFile) {

        $db = new Entities_Note();

        $id = $db->getNextId();

        foreach ($languages as $language) {
            $db->NotId = $id;
            $db->NotLanId = $language->LanId;
            $db->NotCatId = $obj->Category;
            $db->NotDate = $obj->Date;
            $db->NotDescription = $obj->Description;
            $db->NotImage = $imageFile;
            $db->NotImportant = $obj->Important;
            $db->NotResume = $obj->Resume;
            $db->NotStatus = $obj->Status;
            $db->NotTags = $obj->Tags;
            $db->NotTitle = $obj->Title;
            $db->NotUrl = generateUrl($obj->Title);
            $db->NotUser = $obj->Author;
            $db->NotClass = $obj->Class;
            //$db->NotViews = $obj->Views;
            $db->action = ACTION_INSERT;
            $db->save();
        }

        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Insertado");

        return $id;
    }

    public function doUpdate($intId, Com_Object $obj, $imageFile) {
        $db = new Entities_Note();
        $db->NotId = $intId;
        $db->NotLanId = $obj->Language;
        $db->NotCatId = $obj->Category;
        $db->NotDate = $obj->Date;
        $db->NotDescription = $obj->Description;        
        $db->NotImportant = $obj->Important;
        $db->NotResume = $obj->Resume;
        $db->NotStatus = $obj->Status;
        $db->NotTags = $obj->Tags;
        $db->NotTitle = $obj->Title;
        $db->NotUrl = generateUrl($obj->Title);
        $db->NotUser = $obj->Author;
            //$db->NotViews = $obj->Views;
        if ($imageFile != "") {
            $db->NotImage = $imageFile;
        }
        $db->NotClass = $obj->Class;
        $db->action = ACTION_UPDATE;
        $db->save();
        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Actualizado");
    }

    public function doDelete($intId) {
        $db = new Entities_Note();
        $db->NotId = $intId;
        $db->action = ACTION_DELETE;
        $db->save();
        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Eliminado");
    }

    public function get($intId, $lanId) {
        $db = new Entities_Note();
        $db->NotId = $intId;
        $db->NotLanId = $lanId;
        $db->get();
        return $db;
    }

    public function getByUrl($url, $lanId) {
        $db = new Entities_Note();
        $db->NotUrl = $url;
        $db->NotLanId = $lanId;
        $db->get();
        return $db;
    }

    public function getList($lanId, $category,$limit = 1000 ) {
        $text = new Entities_Note();
        return $text->getAll($text->getList()->where("NotLanId={$lanId} and NotStatus = 1 and NotCatId='{$category}'")->orderBy("NotDate desc")->limit(0, $limit));
    }
    
    public function getListRecientes($lanId, $limit = 1000) {
        $text = new Entities_Note();
        return $text->getAll($text->getList()->where("NotLanId={$lanId} and NotStatus = 1")->orderBy("NotDate desc")->limit(0, $limit));
    }
    
    public function getListRecientesByCategory($lanId, $cat, $limit = 1000) {
        $text = new Entities_Note();
        return $text->getAll($text->getList()->where("NotLanId={$lanId} and NotCatId={$cat} and NotStatus = 1")->orderBy("NotDate desc")->limit(0, $limit));
    }
    
    public function getImportant($lanId, $limit = 1000) {
        $text = new Entities_Note();
        return $text->getAll($text->getList()->where("NotLanId={$lanId} and NotStatus = 1 and NotImportant = 1 ")->orderBy("NotDate desc")->limit(0, $limit));
    }
    
    public function getMostViewd($lanId, $limit = 1000) {
        $text = new Entities_Note();
        return $text->getAll($text->getList()->where("NotLanId={$lanId} and NotStatus = 1")->orderBy("NotViews desc")->limit(0, $limit));
    }

    public function getListNext($lanId, $id, $limit = 1000) {
        $text = new Entities_Note();
        return $text->getAll($text->getList()->where("NotLanId={$lanId} and NotStatus = 1")->andWhere("NotId <> {$id}")->orderBy("NotDate desc")->limit(0, $limit));
    }

    public function getListByArchive($lanId, $year, $month, $limit = 1000) {
        $text = new Entities_Note();
        return $text->getAll($text->getList()->where("NotLanId={$lanId} and NotStatus = 1")->andWhere("DATE_FORMAT(NotDate,'%Y') like '{$year}'")->andWhere("DATE_FORMAT(NotDate,'%m') like '{$month}'")->orderBy("NotDate desc")->limit(0, $limit));
    }

    public function getArchives($lanId) {
        $text = new Entities_Note();
        $years = Com_Database_Query::getInstance()->select("distinct DATE_FORMAT(NotDate,'%Y') as year")->from($text)->where("NotLanId={$lanId} and NotStatus = 1")->orderBy("NotDate desc");
        $months = Com_Database_Query::getInstance()->select("distinct DATE_FORMAT(NotDate,'%m') as month")->from($text)->where("NotLanId={$lanId} and NotStatus = 1")->orderBy("NotDate");
        $list['years'] = $text->getAll($years);
        $list['months'] = $text->getAll($months);
        return $list;
    }
    
    public function getListByParent($lanId, $category,$limit = 1000 ) {
        $text = new Entities_Note();
        $result = Com_Database_Query::getInstance()->select()->from("Category")->innerJoin("Notes", "Notes.NotCatId=Category.CatId")->where("Category.CatParentId={$category} and NotStatus = 1 and NotLanId='{$lanId}'and CatLanId='{$lanId}'")->orderBy("NotDate desc")->limit(0, $limit);
        
        return $text->getAll($result);
    }
    
    public function getListBySearch($lanId, $search,$limit = 1000 ) {
        $text = new Entities_Note();
        return $text->getAll($text->getList()->where("NotLanId = {$lanId} and NotTitle like '%{$search}%' OR NotDescription LIKE '%{$search}%'"));
        
        
    }
    
    public function getCategories($lanId, $category,$limit = 1000 ) {
        $text = new Entities_Note();
        $result = Com_Database_Query::getInstance()->select()->from("Category")->where("Category.CatParentId={$category} and CatStatus = 1 and CatLanId='{$lanId}'")->limit(0, $limit);
        
        return $text->getAll($result);
    }

}
