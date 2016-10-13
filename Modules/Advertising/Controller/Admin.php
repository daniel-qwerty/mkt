<?PHP

class Advertising_Controller_Admin extends Admin_Controller_Admin {

    public function init() {
        parent::init();
        Com_Helper_Title::getInstance()->title = "M&oacute;dulo Publicidad";
        Com_Helper_BreadCrumbs::getInstance()->add("Categorias", "/Admin/Advertising");
    }

    public function Add() {
        Com_Helper_BreadCrumbs::getInstance()->add("Item", "/Admin/Advertising/Add");
        if ($this->isPost()) {
            $imageFile = "";
            if (Com_File_Handler::getInstance()->setFile(get("Image"))->hasErrors()) {
                Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "El Archivo Seleccionado no pudo ser guardado por favor Intente Nuevamente");
            } else if (Com_File_Handler::getInstance()->saveFile("Resources/Uploads/Image/")) {
                $imageFile = Com_File_Handler::getInstance()->getFileName();
            }
            Advertising_Model_Advertising::getInstance()->doInsert($this->getPostObject(), $imageFile);
            $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/Advertising');
        }

        $this->assign('Category');
        $this->assign('Name');
        $this->assign('Image');
        $this->assign('Link');
        $this->assign('DateStart');
        $this->assign('DateEnd');
        $this->assign('Views');
        $this->assign('Status');
        $this->assign('Size');
        
        $this->assign('Category', CatAdvertising_Model_Category::getInstance()->getList());
    }

    public function Edit() {
        Com_Helper_BreadCrumbs::getInstance()->add("Item", "/Admin/Advertising/Add");
        $this->setView("add");
        if ($this->isPost()) {
             $imageFile = "";
            if (Com_File_Handler::getInstance()->setFile(get("Image"))->hasErrors()) {
                Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "El Archivo Seleccionado no pudo ser guardado por favor Intente Nuevamente");
            } else if (Com_File_Handler::getInstance()->saveFile("Resources/Uploads/Image/")) {
                $imageFile = Com_File_Handler::getInstance()->getFileName();
            }
            Advertising_Model_Advertising::getInstance()->doUpdate(get('id'), $this->getPostObject(), $imageFile);
            $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/Advertising');
        }
        $entity = Advertising_Model_Advertising::getInstance()->get(get('id'));
               
        $this->assign('Category', $entity->AdCatId);
        $this->assign('Name', $entity->AdName);
        $this->assign('Image', $entity->AdImage);
        $this->assign('Link', $entity->AdLink);
        $this->assign('DateStart', $entity->AdDateStart);
        $this->assign('DateEnd', $entity->AdDateEnd);
        $this->assign('Views', $entity->AdViews);
        $this->assign('Status', $entity->AdStatus);
        $this->assign('Size', $entity->AdSize);
        
        $this->assign('Category', CatAdvertising_Model_Category::getInstance()->getList());
    }

    public function Delete() {
        Advertising_Model_Advertising::getInstance()->doDelete(get('id'));
        $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/Advertising');
    }

    

}

?>