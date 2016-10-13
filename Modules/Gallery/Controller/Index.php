<?php

class News_Controller_Index extends Public_Controller_Index {

    public function Articles() {
        $this->setLayout("news");
        $this->assign("list", News_Model_New::getInstance()->getList($this->lan->LanId));

        $this->assign("archives", News_Model_New::getInstance()->getArchives($this->lan->LanId));
    }

    public function Article() {

        $this->setLayout("new");

        $url = get('REQUEST_URI');
        $url = explode("/", $url);
        $url = $url[count($url) - 1];

        $note = News_Model_New::getInstance()->getByUrl($url, $this->lan->LanId);

        $this->assign("mainArticle", $note);
        $this->assign("next", News_Model_New::getInstance()->getListNext($this->lan->LanId, $note->NewId, 2));
        $this->assign("author", Clients_Model_Client::getInstance()->get($note->NewAuthor));
    }

    public function Archive() {
        $this->setLayout("news");
        $this->setView("articles");

        $year = get('year') != "" ? get('year') : "%";
        $month = get('month') != "" ? get('month') : "%";

        $this->assign("list", News_Model_New::getInstance()->getListByArchive($this->lan->LanId, $year, $month));

        $this->assign("archives", News_Model_New::getInstance()->getArchives($this->lan->LanId));
    }

}
