<?php

class Events_Controller_Index extends Public_Controller_Index {

    public function Index() {
        $this->setLayout("template2");
        $this->setView("list");
        $url = get('REQUEST_URI');
        $url = explode("/", $url);
        $url = $url[count($url) - 1];

//        $this->assign("categoryId", $url);
//
//        $category = Categories_Model_Category::getInstance()->getMenuList($this->lan->LanId, $url);
//        $this->assign("category", $category);
//
//        $notes = Notes_Model_Note::getInstance()->getListByParent($this->lan->LanId, $url, 20);
//        if ($notes == NULL) {
//            $notes = Notes_Model_Note::getInstance()->getList($this->lan->LanId, $url, 20);
//            $this->assign("notes", $notes);
//        } else {
//            $this->assign("notes", $notes);
//        }
    }

    public function Item() {
        $this->setLayout("template2");
        $this->setView("event");
        $url = get('REQUEST_URI');
        $url = explode("/", $url);
        $url = $url[count($url) - 1];

        

        $category = Categories_Model_Category::getInstance()->getMenuList($this->lan->LanId, $url);
        $this->assign("category", $category);

        $note = Notes_Model_Note::getInstance()->get($url, $this->lan->LanId);
        $this->assign("note", $note);
        $this->assign("categoryId", $note->NotCatId);
    }

    

}
