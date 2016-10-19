<?PHP

class CatEvents_Controller_Admin extends Admin_Controller_Admin {

    public function init() {
        parent::init();
        Com_Helper_Title::getInstance()->title = "M&oacute;dulo Categorias eventos";
        Com_Helper_BreadCrumbs::getInstance()->add("Cateogrias eventos", "/Admin/CatEvents");
    }

    public function Add() {
        Com_Helper_BreadCrumbs::getInstance()->add("Item", "/Admin/CatEvents/Add");
        $languages = Language_Model_Language::getInstance()->getList();
        if ($this->isPost()) {
            $id = CatEvents_Model_CatEvent::getInstance()->doInsert($this->getPostObject(), $languages);
            $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/CatEvents/Edit/id/' . $id);
        }
        $this->assign('Name');
        $this->assign('Status');
        $this->assign("languages", $languages);
        $this->assign("Language", (get('lan') != "" ? get('lan') : $languages[0]->LanId));
    }

    public function Edit() {
        Com_Helper_BreadCrumbs::getInstance()->add("Item", "/Admin/CatEvents/Add");
        $languages = Language_Model_Language::getInstance()->getList();
        $language = (get('lan') != "" ? get('lan') : $languages[0]->LanId);
        
        if ($this->isPost()) {
            CatEvents_Model_CatEvent::getInstance()->doUpdate(get('id'), $this->getPostObject());
            $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/CatEvents/Edit/lan/' . $language . '/id/' . get('id'));
        }

        $entity = CatEvents_Model_CatEvent::getInstance()->get(get('id'), $language);

        $this->assign("Id", $entity->CatId);
        $this->assign("Language", $entity->CatLanId);
        $this->assign('Name', $entity->CatName);
        $this->assign('Status', $entity->CatStatus);

        $this->assign("languages", $languages);
    }

    public function Delete() {
        CatEvents_Model_CatEvent::getInstance()->doDelete(get('id'));
        $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/CatEvents');
    }

}

?>