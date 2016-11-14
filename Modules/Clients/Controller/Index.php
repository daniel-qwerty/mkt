<?php

class Clients_Controller_Index extends Public_Controller_Index {

    public function Activate() {
        if (strlen(get('key')) > 3) {
            $client = Clients_Model_Client::getInstance()->getByMd5Email(get('key'));
            if ($client->CliId > 0) {
                $client = cast('Entities_Client', $client);
                $client->CliStatus = 1;
                Clients_Model_Client::getInstance()->doUpdateWs($client);
                $this->redirect(Com_Helper_Url::getInstance()->urlBase . 'es/login');
            }
        }
    }

    public function Profile() {
        $this->setLayout("profile");
        $client = get('sessionCliente');
        $this->assign('client', $client);
    }

    public function Favorites() {
        $this->setLayout("news");

        $client = get('sessionCliente');

        $this->assign("page", 1);
        if ($this->isPost()) {
            $this->assign("page", $this->getPostObject()->page);
            $this->assign("newsList", Clients_Model_Favorite::getInstance()->getItems($client->CliId, $this->getPostObject()->page, 12));
        } else {
            $this->assign("newsList", Clients_Model_Favorite::getInstance()->getItems($client->CliId, 1, 12));
        }
    }

}
