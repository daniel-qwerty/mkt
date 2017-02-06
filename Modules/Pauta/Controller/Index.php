<?php

class Pauta_Controller_Index extends Public_Controller_Index {

    public function Index() {
//        $this->setLayout("templatePauta");
//        $this->setView("list");
//        $url = get('REQUEST_URI');
//        $url = explode("/", $url);
//        $url = $url[count($url) - 1];        
       
    }
    
    public function Revista() {
        $this->setLayout("template4_nosidebar");
        $this->setView("list");
        $url = get('REQUEST_URI');
        $url = explode("/", $url);
        $url = $url[count($url) - 1];        
       
    }
    
    public function Digital() {
        $this->setLayout("template4_nosidebar");
        $this->setView("list2");
        $url = get('REQUEST_URI');
        $url = explode("/", $url);
        $url = $url[count($url) - 1];        
       
    }

}
