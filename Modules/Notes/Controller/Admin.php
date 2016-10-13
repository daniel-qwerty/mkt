<?PHP

class Notes_Controller_Admin extends Admin_Controller_Admin {

    public function init() {
        parent::init();
        Com_Helper_Title::getInstance()->title = "M&oacute;dulo Notas";
        Com_Helper_BreadCrumbs::getInstance()->add("Notas", "/Admin/Notes");
        
//        $obj = get('userType');
//        if($obj == 1){
//            $this->redirect(Com_Helper_Url::getInstance()->generateUrl("es", "error"));
//            exit;
//        }
        
    }

    public function Add() {
        Com_Helper_BreadCrumbs::getInstance()->add("Item", "/Admin/Notes/Add");
        $languages = Language_Model_Language::getInstance()->getList();
        if ($this->isPost()) {

            $imageFile = "";
            if (Com_File_Handler::getInstance()->setFile(get("Image"))->hasErrors()) {
                Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "El Archivo Seleccionado no pudo ser guardado por favor Intente Nuevamente");
            } else if (Com_File_Handler::getInstance()->saveFile("Resources/Uploads/Image/")) {
                $imageFile = Com_File_Handler::getInstance()->getFileName();
            }

            $id = Notes_Model_Note::getInstance()->doInsert($this->getPostObject(), $languages, $imageFile);
            $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/Notes/Edit/id/' . $id);
        }
        $this->assign('Title');
        $this->assign('Category');
        $this->assign('Resume');
        $this->assign('Description');
        $this->assign('Date');
        $this->assign('Image');
        $this->assign('Author');
        $this->assign('Tags');
        $this->assign('Status');
        $this->assign('Important');
        $this->assign("languages", $languages);
        $this->assign("Language", (get('lan') != "" ? get('lan') : $languages[0]->LanId));
        
        $this->assign('Category', Categories_Model_Category::getInstance()->getList($languages[0]->LanId));
        
    }

    public function Edit() {
        Com_Helper_BreadCrumbs::getInstance()->add("Item", "/Admin/Notes/Add");
        $languages = Language_Model_Language::getInstance()->getList();
        $language = (get('lan') != "" ? get('lan') : $languages[0]->LanId);

        if ($this->isPost()) {

            $imageFile = "";
            if (Com_File_Handler::getInstance()->setFile(get("Image"))->hasErrors()) {
                Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "El Archivo Seleccionado no pudo ser guardado por favor Intente Nuevamente");
            } else if (Com_File_Handler::getInstance()->saveFile("Resources/Uploads/Image/")) {
                $imageFile = Com_File_Handler::getInstance()->getFileName();
            }

            Notes_Model_Note::getInstance()->doUpdate(get('id'), $this->getPostObject(), $imageFile);
            $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/Notes/Edit/lan/' . $language . '/id/' . get('id'));
        }

        $entity = Notes_Model_Note::getInstance()->get(get('id'), $language);

        $this->assign("Id", $entity->NotId);
        $this->assign("Language", $entity->NotLanId);

        $this->assign('Title', $entity->NotTitle);
        
        $this->assign('Resume', $entity->NotResume);
        $this->assign('Description', $entity->NotDescription);
        $this->assign('Date', $entity->NotDate);
        $this->assign('Image', $entity->NotImage);
        $this->assign('Author', $entity->NotUser);
        $this->assign('Tags', $entity->NotTags);
        $this->assign('Status', $entity->NotStatus);
        $this->assign('Important', $entity->NotImportant);
        $this->assign("languages", $languages);
        
        $this->assign('Category', Categories_Model_Category::getInstance()->getList($languages[0]->LanId));
        
    }

    public function Delete() {
        Notes_Model_Note::getInstance()->doDelete(get('id'));
        $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/Notes');
    }

}

?>