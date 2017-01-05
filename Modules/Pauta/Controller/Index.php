<?php

class Pauta_Controller_Index extends Public_Controller_Index {

    public function Index() {
        $this->setLayout("templatePauta");
        $this->setView("list");
        $url = get('REQUEST_URI');
        $url = explode("/", $url);
        $url = $url[count($url) - 1];        
       
    }

}
