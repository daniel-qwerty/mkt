<?PHP

class CatTools_Controller_Admin extends Admin_Controller_Admin {

    public function init() {
        parent::init();
        Com_Helper_Title::getInstance()->title = "M&oacute;dulo Categorias";
        Com_Helper_BreadCrumbs::getInstance()->add("Cateogrias", "/Admin/CatTools");
    }

    public function Add() {
        Com_Helper_BreadCrumbs::getInstance()->add("Item", "/Admin/CatTools/Add");
        $languages = Language_Model_Language::getInstance()->getList();
        if ($this->isPost()) {
            $id = CatTools_Model_CatTool::getInstance()->doInsert($this->getPostObject(), $languages);
            $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/CatTools/Edit/id/' . $id);
        }
        $this->assign('Name');
        $this->assign('Status');
        $this->assign("languages", $languages);
        $this->assign("Language", (get('lan') != "" ? get('lan') : $languages[0]->LanId));
    }

    public function Edit() {
        Com_Helper_BreadCrumbs::getInstance()->add("Item", "/Admin/CatTools/Add");
        $languages = Language_Model_Language::getInstance()->getList();
        $language = (get('lan') != "" ? get('lan') : $languages[0]->LanId);
        
        if ($this->isPost()) {
            CatTools_Model_CatTool::getInstance()->doUpdate(get('id'), $this->getPostObject());
            $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/CatTools/Edit/lan/' . $language . '/id/' . get('id'));
        }

        $entity = CatTools_Model_CatTool::getInstance()->get(get('id'), $language);

        $this->assign("Id", $entity->CatId);
        $this->assign("Language", $entity->CatLanId);
        $this->assign('Name', $entity->CatName);
        $this->assign('Status', $entity->CatStatus);

        $this->assign("languages", $languages);
    }

    public function Delete() {
        CatTools_Model_CatTool::getInstance()->doDelete(get('id'));
        $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/CatTools');
    }

}

?>