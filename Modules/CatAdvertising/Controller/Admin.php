<?PHP

class CatAdvertising_Controller_Admin extends Admin_Controller_Admin {

    public function init() {
        parent::init();
        Com_Helper_Title::getInstance()->title = "M&oacute;dulo CAtegorias";
        Com_Helper_BreadCrumbs::getInstance()->add("Categorias", "/Admin/CatAdvertising");
    }

    public function Add() {
        Com_Helper_BreadCrumbs::getInstance()->add("Item", "/Admin/CatAdvertising/Add");
        if ($this->isPost()) {
            CatAdvertising_Model_Category::getInstance()->doInsert($this->getPostObject());
            $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/CatAdvertising');
        }

        $this->assign('Name');
        $this->assign('Type');
        $this->assign('Status');
    }

    public function Edit() {
        Com_Helper_BreadCrumbs::getInstance()->add("Item", "/Admin/CatAdvertising/Add");
        $this->setView("add");
        if ($this->isPost()) {
            CatAdvertising_Model_Category::getInstance()->doUpdate(get('id'), $this->getPostObject());
            $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/CatAdvertising');
        }
        $entity = CatAdvertising_Model_Category::getInstance()->get(get('id'));
        $this->assign('Name', $entity->CatName);
        $this->assign('Type', $entity->CatType);
        $this->assign('Status', $entity->CatStatus);
    }

    public function Delete() {
        CatAdvertising_Model_Category::getInstance()->doDelete(get('id'));
        $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/CatAdvertising');
    }

    

}

?>