<?php

class Books_Controller_Index extends Public_Controller_Index {

    public function Index() {
        
    } 
    
    public function Lista() {
        $this->setLayout("template4_nosidebar");
        $this->setView("list");
        $url = get('REQUEST_URI');
        $url = explode("/", $url);
        $url = $url[count($url) - 1];
        
        $list = Books_Model_BookMall::getInstance()->getList2($this->lan->LanId, 5);
        $this->assign("list", $list);
       
    }
    
    public function Item() {
        $this->setLayout("template4_nosidebar");
        $this->setView("book");
        $url = get('REQUEST_URI');
        $url = explode("/", $url);
        $url = $url[count($url) - 1];
        
        $list = Books_Model_BookMall::getInstance()->get($url,$this->lan->LanId);
        $this->assign("list", $list);
        
        $images = Books_Model_Media::getInstance()->getListByProject($url, $this->lan->LanId);
        $this->assign("images", $images);
    }

}
