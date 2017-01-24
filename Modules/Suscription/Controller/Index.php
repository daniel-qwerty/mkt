<?php

class Suscription_Controller_Index extends Public_Controller_Index {

    public function Index() {
        $this->setLayout("template4_nosidebar");
        $this->setView("list");
        $url = get('REQUEST_URI');
        $url = explode("/", $url);
        $url = $url[count($url) - 1];

        $list = Suscription_Model_Suscription::getInstance()->getList2($this->lan->LanId);
        $this->assign("list", $list);

        $client = get('sessionCliente');
        if (!empty($client)) {
            $this->assign("client", $client);

            if (get('cliente') != 0) {
                $carrito = Clients_Model_Venta::getInstance()->getListCarrito(date('Y-m-d'), $this->client->CliId);
                $this->assign("carrito", $carrito);

                $Sumcarrito = Clients_Model_Venta::getInstance()->getSumCarrito(date('Y-m-d'), $this->client->CliId);
                $this->assign("Sumcarrito", $Sumcarrito[0]->total);

                $venta = Clients_Model_Venta::getInstance()->getVenta($this->client->CliId, date('Y-m-d'));
                $this->assign("VentId", $venta->VenId);
            } else {
                $this->assign("carrito", []);
                $this->assign("Sumcarrito", '0');
                $this->assign("VentId", '0');
            }
        }else {
                $this->assign("carrito", []);
                $this->assign("Sumcarrito", '0');
                $this->assign("VentId", '0');
            }
    }

}
