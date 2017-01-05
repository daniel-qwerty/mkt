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
    
    public function Venta() {
        Com_Helper_BreadCrumbs::getInstance()->add("Ventas", "/Admin/Clients/Venta");
        
    }
    
    public function EditVenta() {
        Com_Helper_BreadCrumbs::getInstance()->add("Item", "/Admin/Clients/Venta/EditVenta");
        $this->setView("editventa");
        if ($this->isPost()) {
            Clients_Model_Venta::getInstance()->doUpdate(get('id'), $this->getPostObject());
            $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/Clients/Venta/');
        }
         $entity = Clients_Model_Venta::getInstance()->get(get('id'));
         $this->assign('VenId', $entity->VenId);
         $this->assign('VenCliId', $entity->VenCliId);
         $this->assign('VenDate', $entity->VenDate);
         $this->assign('VenStatus', $entity->VenStatus);
         $this->assign('VenTotal', $entity->VenTotal);
    }
    
     public function DetVenta() {
        Com_Helper_BreadCrumbs::getInstance()->add("Venta", "/Admin/Clients/Venta");
        
    }
    
    public function DetCompra() {
        Com_Helper_BreadCrumbs::getInstance()->add("Item", "/Admin/Clients/Venta/EditVenta");
        $this->setView("detcompra");
        
         $entity = Clients_Model_Compra::getInstance()->get2(get('id'));
         $this->assign('Nombre', $entity->ComNombre);
         $this->assign('Cedula', $entity->ComCedula);
         $this->assign('Email', $entity->ComEmail);
         $this->assign('Telefono', $entity->ComTelefono);
         $this->assign('Pais', $entity->ComPais);
         $this->assign('Ciudad', $entity->ComCiudad);
         $this->assign('Direccion', $entity->ComDireccion);
         $this->assign('Metodo', $entity->ComMetodo);
         
         $this->assign('Direccion2', $entity->ComDireccion2);
         $this->assign('Pais2', $entity->ComPais2);
         $this->assign('Ciudad2', $entity->ComCiudad2);
         $this->assign('Postal2', $entity->ComCodPostal2);
         $this->assign('Descripcion', $entity->ComDescripcion);
    }

}

?>