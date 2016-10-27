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

       
    }
    
    public function Item() {
        $this->setLayout("template4_nosidebar");
        $this->setView("book");
        $url = get('REQUEST_URI');
        $url = explode("/", $url);
        $url = $url[count($url) - 1];
    }

}
