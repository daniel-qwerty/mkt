<?PHP

class Tools_Controller_Admin extends Admin_Controller_Admin {

    public function init() {
        parent::init();
        Com_Helper_Title::getInstance()->title = "M&oacute;dulo Tools";
        Com_Helper_BreadCrumbs::getInstance()->add("Tools", "/Admin/Tools");
    }

    public function Add() {
        Com_Helper_BreadCrumbs::getInstance()->add("Item", "/Admin/Tools/Add");
        $languages = Language_Model_Language::getInstance()->getList();
        if ($this->isPost()) {
            $id = Tools_Model_Tool::getInstance()->doInsert($this->getPostObject(), $languages);
            $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/Tools/Edit/id/' . $id);
        }
        $this->assign('Name');
        $this->assign('Description');
        $this->assign('Type');
        $this->assign('Link');
        $this->assign('Status');
        $this->assign('Category');
        $this->assign("languages", $languages);
        $this->assign("Language", (get('lan') != "" ? get('lan') : $languages[0]->LanId));
        
        $this->assign('Category', CatTools_Model_CatTool::getInstance()->getList($languages[0]->LanId));
    }

    public function Edit() {
        Com_Helper_BreadCrumbs::getInstance()->add("Item", "/Admin/Tools/Add");
        $languages = Language_Model_Language::getInstance()->getList();
        $language = (get('lan') != "" ? get('lan') : $languages[0]->LanId);
        
        if ($this->isPost()) {
            Tools_Model_Tool::getInstance()->doUpdate(get('id'), $this->getPostObject());
            $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/Tools/Edit/lan/' . $language . '/id/' . get('id'));
        }

        $entity = Tools_Model_Tool::getInstance()->get(get('id'), $language);

        $this->assign("Id", $entity->TooId);
        $this->assign("Language", $entity->TooLanId);        
        $this->assign('Name',$entity->TooName);
        $this->assign('Description', $entity->TooDescription);
        $this->assign('Type', $entity->TooType);
        $this->assign('Link', $entity->TooLink);
        $this->assign('Status', $entity->TooStatus);
        $this->assign('Category', $entity->TooCatId);

        $this->assign("languages", $languages);
        
        $this->assign('Category', CatTools_Model_CatTool::getInstance()->getList($languages[0]->LanId));
    }

    public function Delete() {
        Tools_Model_Tool::getInstance()->doDelete(get('id'));
        $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/Tools');
    }

}

?>