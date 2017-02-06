<?PHP

class Colaboradores_Controller_Admin extends Admin_Controller_Admin {

    public function init() {
        parent::init();
        Com_Helper_Title::getInstance()->title = "M&oacute;dulo Links";
        Com_Helper_BreadCrumbs::getInstance()->add("Links", "/Admin/Colaboradores");
    }

    public function Add() {
        Com_Helper_BreadCrumbs::getInstance()->add("Item", "/Admin/Colaboradores/Add");
        if ($this->isPost()) {
            Colaboradores_Model_Colaboradores::getInstance()->doInsert($this->getPostObject());
            $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/Colaboradores');
        }

        $this->assign('Nombre');
        $this->assign('Perfil');
        $this->assign('Ocupacion');
        $this->assign('Rubro');
        $this->assign('Pais');
        $this->assign('Web');
        $this->assign('Tema');
        $this->assign('Articulo');
        $this->assign('Email');
        $this->assign('Telefono');
    }

    public function Edit() {
        Com_Helper_BreadCrumbs::getInstance()->add("Item", "/Admin/Colaboradores/Add");
        $this->setView("add");
        if ($this->isPost()) {
            Colaboradores_Model_Colaboradores::getInstance()->doUpdate(get('id'), $this->getPostObject());
            $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/Colaboradores');
        }
        $entity = Colaboradores_Model_Colaboradores::getInstance()->get(get('id'));
        
        $this->assign('Nombre', $entity->ColNombre);
        $this->assign('Perfil', $entity->ColPerfil);
        $this->assign('Ocupacion', $entity->ColOcupacion);
        $this->assign('Rubro', $entity->ColRubro);
        $this->assign('Pais', $entity->ColPais);
        $this->assign('Web', $entity->ColWeb);
        $this->assign('Tema', $entity->ColTema);
        $this->assign('Articulo', $entity->ColArticulo);
        $this->assign('Email', $entity->ColEmail);
        $this->assign('Telefono', $entity->ColTelefono);
    }

    public function Delete() {
        Colaboradores_Model_Colaboradores::getInstance()->doDelete(get('id'));
        $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/Colaboradores');
    }

    

}

?>