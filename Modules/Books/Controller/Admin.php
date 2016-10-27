<?PHP

class Books_Controller_Admin extends Admin_Controller_Admin {

    public function init() {
        parent::init();
        Com_Helper_Title::getInstance()->title = "M&oacute;dulo Book Mall";
        Com_Helper_BreadCrumbs::getInstance()->add("Book Mall", "/Admin/Books");
    }

    public function Add() {
        Com_Helper_BreadCrumbs::getInstance()->add("Item", "/Admin/Books/Add");
        $languages = Language_Model_Language::getInstance()->getList();
        if ($this->isPost()) {
            
            $imageFile = "";
            if (Com_File_Handler::getInstance()->setFile(get("Image"))->hasErrors()) {
                Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "El Archivo Seleccionado no pudo ser guardado por favor Intente Nuevamente");
            } else if (Com_File_Handler::getInstance()->saveFile("Resources/Uploads/Image/")) {
                $imageFile = Com_File_Handler::getInstance()->getFileName();
            }
            
            $id = Books_Model_BookMall::getInstance()->doInsert($this->getPostObject(), $languages, $imageFile);
            $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/Books/Edit/id/' . $id);
        }
        $this->assign('Title');
        $this->assign('Content');
        $this->assign('Author');
        $this->assign('Price');
        $this->assign('Image');
        $this->assign('Status');
        $this->assign("languages", $languages);
        $this->assign("Language", (get('lan') != "" ? get('lan') : $languages[0]->LanId));
        
        
    }

    public function Edit() {
        Com_Helper_BreadCrumbs::getInstance()->add("Item", "/Admin/Books/Add");
        $languages = Language_Model_Language::getInstance()->getList();
        $language = (get('lan') != "" ? get('lan') : $languages[0]->LanId);
        
        if ($this->isPost()) {
            
            $imageFile = "";
            if (Com_File_Handler::getInstance()->setFile(get("Image"))->hasErrors()) {
                Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "El Archivo Seleccionado no pudo ser guardado por favor Intente Nuevamente");
            } else if (Com_File_Handler::getInstance()->saveFile("Resources/Uploads/Image/")) {
                $imageFile = Com_File_Handler::getInstance()->getFileName();
            }
            
            Books_Model_BookMall::getInstance()->doUpdate(get('id'), $this->getPostObject(), $imageFile);
            $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/Books/Edit/lan/' . $language . '/id/' . get('id'));
        }

        $entity = Books_Model_BookMall::getInstance()->get(get('id'), $language);

        $this->assign("Id", $entity->BooId);
        $this->assign("Language", $entity->BooLanId);        
        $this->assign('Title',$entity->BooTitle);
        $this->assign('Content', $entity->BooContent);
        $this->assign('Author', $entity->BooAuthor);
        $this->assign('Price', $entity->BooPrice);
        $this->assign('Image', $entity->BooImage);
        $this->assign('Status', $entity->BooStatus);

        $this->assign("languages", $languages);        
        
    }

    public function Delete() {
        Books_Model_BookMall::getInstance()->doDelete(get('id'));
        $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/Books');
    }
    
    public function Images() {
        Com_Helper_BreadCrumbs::getInstance()->add("Media", "/Admin/Books/Images");
        $languages = Language_Model_Language::getInstance()->getList();
        $language = (get('lan') != "" ? get('lan') : $languages[0]->LanId);

        if ($this->isPost()) {

            $fileName = "";
            if (!(Com_File_Handler::getInstance()->setFile(get("Image"))->hasErrors())) {
                $fileName = (Com_File_Handler::getInstance()->saveFile("Resources/Uploads/Image") ? Com_File_Handler::getInstance()->getFileName() : "");
            }

            if (($fileName != "") || (get("Youtube") != "")) {
                Books_Model_Media::getInstance()->doInsert($this->getPostObject(), $fileName, get('lan'));
                $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/Books/Images/lan/' . $language . '/id/' . get('id'));
            }

            Books_Model_Media::getInstance()->doUpdate(get('id'), $this->getPostObject());
        }

        $this->assign('Id', get('id'));
        $this->assign('Image');
        $this->assign('Footer');
        $this->assign('Youtube');
        $this->assign('Images', Books_Model_Media::getInstance()->getListByProject(get('id'), get('lan')));
        $this->assign("languages", $languages);
        $this->assign("Language", $language);
    }

    public function DeleteMedia() {
        Books_Model_Media::getInstance()->doDelete(get('media'));
        $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/Books/Images/lan/' . get('lan') . '/id/' . get('id'));
    }

}

?>