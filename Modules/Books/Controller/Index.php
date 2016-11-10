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

        $list = Books_Model_BookMall::getInstance()->get($url, $this->lan->LanId);
        $this->assign("list", $list);

        $images = Books_Model_Media::getInstance()->getListByProject($url, $this->lan->LanId);
        $this->assign("images", $images);

        $client = get('sessionCliente');
        $this->assign("client", $client);     
        

        if (get('cliente')!= 0) {
            $carrito = Clients_Model_Venta::getInstance()->getListCarrito(date('Y-m-d'), $this->client->CliId);
            $this->assign("carrito", $carrito);

            $Sumcarrito = Clients_Model_Venta::getInstance()->getSumCarrito(date('Y-m-d'), $this->client->CliId);
            $this->assign("Sumcarrito", $Sumcarrito[0]->total);
        }  else {
            $this->assign("carrito", []);
            $this->assign("Sumcarrito", '0');
        }
    }

}
