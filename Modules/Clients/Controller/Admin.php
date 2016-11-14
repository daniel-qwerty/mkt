<?PHP

class Clients_Controller_Admin extends Admin_Controller_Admin {

    public function init() {
        parent::init();
        Com_Helper_Title::getInstance()->title = "M&oacute;dulo Clientes";
        Com_Helper_BreadCrumbs::getInstance()->add("Clientes", "/Admin/Clients");
    }

    public function Add() {
        Com_Helper_BreadCrumbs::getInstance()->add("Item", "/Admin/Clients/Add");
        if ($this->isPost()) {
            Clients_Model_Client::getInstance()->doInsert($this->getPostObject());
            $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/Clients');
        }

        $this->assign('Name');
        $this->assign('Nacimiento');
        $this->assign('Gender');
        $this->assign('Email');
        $this->assign('Country');
        $this->assign('City');
        $this->assign('Password');
        $this->assign('Facebook');
        $this->assign('Phone');
        $this->assign('Type');
        $this->assign('Date');        
        $this->assign('Status');
    }

    public function Edit() {
        Com_Helper_BreadCrumbs::getInstance()->add("Item", "/Admin/Clients/Add");
        $this->setView("add");
        if ($this->isPost()) {
            Clients_Model_Client::getInstance()->doUpdate(get('id'), $this->getPostObject());
            $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/Clients');
        }
        $entity = Clients_Model_Client::getInstance()->get(get('id'));
        $this->assign('Name', $entity->CliName);
        $this->assign('Nacimiento', $entity->CliBirthDate);
        $this->assign('Gender', $entity->CliGender);
        $this->assign('Email', $entity->CliEmail);
        $this->assign('Country', $entity->CliCountry);
        $this->assign('City', $entity->CliCity);
        $this->assign('Password', $entity->CliPassword);
        $this->assign('Facebook', $entity->CliFacebook);
        $this->assign('Phone', $entity->CliPhone);
        $this->assign('Type', $entity->CliType);        
        $this->assign('Date', $entity->CliDate);
        $this->assign('Status', $entity->CliStatus);
    }

    public function Delete() {
        Clients_Model_Client::getInstance()->doDelete(get('id'));
        $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/Clients');
    }

    public function Export() {
        Com_Helper_BreadCrumbs::getInstance()->add("Exportar", "/Admin/Clients/Export");
        Com_Helper_Style::getInstance()->addFile("report.css");
        $list = Clients_Model_Client::getInstance()->getList();
        $this->assign("list", $list);
    }

}

?>