<?php

class Notes_Controller_Index extends Public_Controller_Index {

    public function Index() {
        $this->setLayout("template1");
        $this->setView("list");
        $url = get('REQUEST_URI');
        $url = explode("/", $url);
        $url = $url[count($url) - 1];

        $this->assign("categoryId", $url);

        $category = Categories_Model_Category::getInstance()->getMenuList($this->lan->LanId, $url);
        $this->assign("category", $category);

        $notes = Notes_Model_Note::getInstance()->getListByParent($this->lan->LanId, $url, 20);
        if ($notes == NULL) {
            $notes = Notes_Model_Note::getInstance()->getList($this->lan->LanId, $url, 20);
            $this->assign("notes", $notes);
        } else {
            $this->assign("notes", $notes);
        }
    }

    public function Article() {
        $this->setLayout("template2");
        $this->setView("note");
        $url = get('REQUEST_URI');
        $url = explode("/", $url);
        $url = $url[count($url) - 1];

        $category = Categories_Model_Category::getInstance()->getMenuList($this->lan->LanId, $url);
        $this->assign("category", $category);

        $note = Notes_Model_Note::getInstance()->get($url, $this->lan->LanId);
        $this->assign("note", $note);
        $this->assign("categoryId", $note->NotCatId);
    }

    public function Post() {
        $this->setLayout("template2");
        $this->setView("note");
        $url = get('REQUEST_URI');
        $url = explode("/", $url);
        $url = $url[count($url) - 1];


        $category = Categories_Model_Category::getInstance()->getMenuList($this->lan->LanId, $url);
        $this->assign("category", $category);

        if ($this->isPost()) {

            $note = Notes_Model_Note::getInstance()->get($this->getPostObject()->page, $this->lan->LanId);
            $this->assign("note", $note);
            $this->assign("categoryId", $note->NotCatId);
            $this->assign("noteId", $note->NotId);
        }
    }

    public function Search() {
        $this->setLayout("template1");
        $this->setView("search");
        $url = get('REQUEST_URI');
        $url = explode("/", $url);
        $url = $url[count($url) - 1];

        echo 'tipo ' . $url;
        echo 'busqueda ' . $this->getPostObject()->search;

        if ($url == "notas") {
            if ($this->isPost()) {
                $notes = Notes_Model_Note::getInstance()->getListBySearch($this->lan->LanId, $this->getPostObject()->search, 20);

                $this->assign("notes", $notes);
            } else {
                $notes = Notes_Model_Note::getInstance()->getList($this->lan->LanId, $url, 20);
                $this->assign("notes", $notes);
            }
        }
        
       
    }

}
