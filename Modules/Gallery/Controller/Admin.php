<?PHP

class Gallery_Controller_Admin extends Admin_Controller_Admin {

    public function init() {
        parent::init();
        Com_Helper_Title::getInstance()->title = "M&oacute;dulo Galeria";
        Com_Helper_BreadCrumbs::getInstance()->add("Galeria", "/Admin/Gallery");
    }

    public function Add() {
        Com_Helper_BreadCrumbs::getInstance()->add("Item", "/Admin/Gallery/Add");
        $languages = Language_Model_Language::getInstance()->getList();
        if ($this->isPost()) {

            $imageFile = "";
            if (Com_File_Handler::getInstance()->setFile(get("File"))->hasErrors()) {
                Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "El Archivo Seleccionado no pudo ser guardado por favor Intente Nuevamente");
            } else if (Com_File_Handler::getInstance()->saveFile("Resources/Uploads/Image/")) {
                $imageFile = Com_File_Handler::getInstance()->getFileName();
            }
            

            $id = Gallery_Model_Gallery::getInstance()->doInsert($this->getPostObject(), $languages, $imageFile);
            $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/Gallery/Edit/id/' . $id);
        }
        $this->assign('Name');
        $this->assign('File');
        $this->assign('Status');
        $this->assign("languages", $languages);
        $this->assign("Language", (get('lan') != "" ? get('lan') : $languages[0]->LanId));
        
    }

    public function Edit() {
        Com_Helper_BreadCrumbs::getInstance()->add("Item", "/Admin/Gallery/Add");
        $languages = Language_Model_Language::getInstance()->getList();
        $language = (get('lan') != "" ? get('lan') : $languages[0]->LanId);

        if ($this->isPost()) {

            $imageFile = "";
            if (Com_File_Handler::getInstance()->setFile(get("File"))->hasErrors()) {
                Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "El Archivo Seleccionado no pudo ser guardado por favor Intente Nuevamente");
            } else if (Com_File_Handler::getInstance()->saveFile("Resources/Uploads/Image/")) {
                $imageFile = Com_File_Handler::getInstance()->getFileName();
            }
            

            Gallery_Model_Gallery::getInstance()->doUpdate(get('id'), $this->getPostObject(), $imageFile);
            $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/Gallery/Edit/lan/' . $language . '/id/' . get('id'));
        }

        $entity = Gallery_Model_Gallery::getInstance()->get(get('id'), $language);

        $this->assign("Id", $entity->GalId);
        $this->assign("Language", $entity->GalLanId);

        $this->assign('Name', $entity->GalName);
        $this->assign('File', $entity->GalFile);
        $this->assign('Status', $entity->GalStatus);
        $this->assign("languages", $languages);
        
        
    }

    public function Delete() {
        Gallery_Model_Gallery::getInstance()->doDelete(get('id'));
        $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/Gallery');
    }

}

?>