<?PHP

class Clients_Controller_Service extends Com_Module_Controller_Json {

    public function Save() {
        if ($this->isPost()) {
            Clients_Model_Client::getInstance()->doSaveEmailFromWs($this->getPostObject());
            echo json_encode(true);
            return;
        }
        echo json_encode(false);
    }

    public function SaveFb() {
        if ($this->isPost()) {
            Clients_Model_Client::getInstance()->doSaveFacebookFromWs($this->getPostObject());
            echo json_encode(true);
            return;
        }
        echo json_encode(false);
    }

    public function CreateAccount() {
        if ($this->isPost()) {
            Clients_Model_Client::getInstance()->doSaveEmailFromWs($this->getPostObject());
            echo json_encode(true);
            return;
        }
        echo json_encode(false);
    }

    public function SaveAccount() {
        if ($this->isPost()) {
            //print_r($this->getPostObject());
            Clients_Model_Client::getInstance()->doUpdateFromPage($this->getPostObject());
            echo json_encode(true);
            return;
        }
        echo json_encode(false);
    }

    public function Login() {
        if ($this->isPost()) {
            $client = Clients_Model_Client::getInstance()->doLogin($this->getPostObject());
            
            if ($client != '') {
                set('sessionCliente', $client, "SESSION");
                echo json_encode($client);
                return;
            }
        }
        echo json_encode(false);
    }

    public function LoginFb() {
        if ($this->isPost()) {
            $client = Clients_Model_Client::getInstance()->doLoginFb($this->getPostObject());
            if ($client->CliId > 0) {
                set('sessionCliente', $client, "SESSION");
                echo json_encode($client);
                return;
            }
        }
        echo json_encode(false);
    }

    public function FogotPassword() {
        if ($this->isPost()) {
            echo json_encode(Clients_Model_Client::getInstance()->forgot($this->getPostObject()->Email));
            return;
        }
        echo json_encode(false);
    }

    public function Logout() {
        set('sessionCliente', '0', "SESSION");
        echo json_encode(true);
    }

    public function Exist() {
        if ($this->isPost()) {
            $client = Clients_Model_Client::getInstance()->getByEmail($this->getPostObject()->Email);
            if ($client->CliId > 0) {
                echo json_encode(true);
                return;
            }
        }
        echo json_encode(false);
    }

        
    public function SaveVenta() {
        if ($this->isPost()) {
            $venId = Clients_Model_Venta::getInstance()->doInsert($this->getPostObject());
            
            echo json_encode($venId);
            return;
        }
        echo json_encode(0);
    } 
    
    public function ExistVenta() {
        if ($this->isPost()) {
            $client = Clients_Model_Venta::getInstance()->getVenta($this->getPostObject()->VenCliId,$this->getPostObject()->VenDate);
            if ($client->VenId > 0 && $client->VenStatus !== 0) {
                echo json_encode($client->VenId);
                return;
            }
        }
        echo json_encode(0);
    }
    
    public function SaveVentaDetalle() {
        if ($this->isPost()) {
            Clients_Model_DetVenta::getInstance()->doInsert($this->getPostObject());
            echo json_encode(true);
            return;
        }
        echo json_encode(false);
    }
    
    public function DeteleVentaDetalle() {
        if ($this->isPost()) {
            $DetId = $this->getPostObject()->DetId;
            
            Clients_Model_DetVenta::getInstance()->doDelete($DetId);
            echo json_encode(true);
            return;
        }
        echo json_encode(false);
    }
    
    public function AdViews() {
        if ($this->isPost()) {
            $adId = $this->getPostObject()->AdId;
            $adview = $this->getPostObject()->AdViews;            
            Advertising_Model_Advertising::getInstance()->doUpdateService($adId, $adview);
            
            echo json_encode(true);
            return;
        }
        echo json_encode(false);
    }
    
    public function AdPrints() {
        if ($this->isPost()) {
            $adId = $this->getPostObject()->AdId;                       
            Advertising_Model_Advertising::getInstance()->doUpdatePrint($adId);
            
            echo json_encode(true);
            return;
        }
        echo json_encode(false);
    }
    
    public function SaveCompra() {
        if ($this->isPost()) { 
            $this->sendPedido($this->getPostObject());
            Clients_Model_Compra::getInstance()->doInsert($this->getPostObject());
            Clients_Model_Venta::getInstance()->doUpdateVenta($this->getPostObject()->VenId,$this->getPostObject()->Total);
            echo json_encode(true);
            return;
        }
        echo json_encode(false);
    }
    
    public function sendPedido(Com_Object$obj) {
        $email = new Com_Wizard_Mail();
        $strTitle = strtoupper("TU PEDIDO | MARKETING NEWS");
        $strLogo = Com_Helper_Url::getInstance()->getImage() . "/Public/logo.png";
        $email->setSubject($strTitle);
        $email->setFrom("info@marketingnews.com.bo", "MARKETING NEWS BOLIVIA");
        $strMessage = file_get_contents(Com_Helper_Url::getInstance()->physicalDirectory . "/Resources/Layouts/Email/pedido.phtml");
        $strMessage = str_replace("{Title}", "pedidos", $strMessage);
       // $strMessage = str_replace("{Footer}", Configurations_Helper_Configuration::getInstance()->getKey("FORGOT_FOOTER"), $strMessage);
        $strMessage = str_replace("{Logo}", $strLogo, $strMessage);
        $strMessage = str_replace("{NumPedido}",$obj->VenId, $strMessage);
        $strMessage = str_replace("{Fecha}", date("d/m/Y H:i:s"), $strMessage);
        $strMessage = str_replace("{Metodo}", $obj->Metodo, $strMessage);
        $strMessage = str_replace("{Total}", $obj->Total, $strMessage);
       // $strMessage = str_replace("{Register.Content}", "Su nueva contrase&ntilde;a es: " . $obj->CliPassword, $strMessage);
        $email->addAddress($obj->Email, $obj->Nombre);
        $email->setMessage($strMessage);
        $email->send();
    }

}
