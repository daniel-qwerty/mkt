<?php

class Suscription_Controller_Index extends Public_Controller_Index {

    public function Index() {
        $this->setLayout("template4_nosidebar");
        $this->setView("list");
        $url = get('REQUEST_URI');
        $url = explode("/", $url);
        $url = $url[count($url) - 1];

        // $this->assign("categoryId", $url);

       
    }

}
