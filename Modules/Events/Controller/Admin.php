<?PHP

class Events_Controller_Admin extends Admin_Controller_Admin {

    public function init() {
        parent::init();
        Com_Helper_Title::getInstance()->title = "M&oacute;dulo Eventos";
        Com_Helper_BreadCrumbs::getInstance()->add("Eventos", "/Admin/Events");
        
//        $obj = get('userType');
//        if($obj == 1){
//            $this->redirect(Com_Helper_Url::getInstance()->generateUrl("es", "error"));
//            exit;
//        }
        
    }

    public function Add() {
        Com_Helper_BreadCrumbs::getInstance()->add("Item", "/Admin/Events/Add");
        $languages = Language_Model_Language::getInstance()->getList();
        if ($this->isPost()) {

            $imageFile = "";
            if (Com_File_Handler::getInstance()->setFile(get("Image"))->hasErrors()) {
                Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "El Archivo Seleccionado no pudo ser guardado por favor Intente Nuevamente");
            } else if (Com_File_Handler::getInstance()->saveFile("Resources/Uploads/Image/")) {
                $imageFile = Com_File_Handler::getInstance()->getFileName();
            }

            $id = Events_Model_Event::getInstance()->doInsert($this->getPostObject(), $languages, $imageFile);
            $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/Events/Edit/id/' . $id);
        }
        $this->assign('Title');
        $this->assign('Category');
        $this->assign('Content');
        $this->assign('Date');
        $this->assign('Image');
        $this->assign('Important');
        $this->assign('Status');
        $this->assign('Video');
        $this->assign("languages", $languages);
        $this->assign("Language", (get('lan') != "" ? get('lan') : $languages[0]->LanId));
        
        $this->assign('Category', CatEvents_Model_CatEvent::getInstance()->getList($languages[0]->LanId));
        
    }

    public function Edit() {
        Com_Helper_BreadCrumbs::getInstance()->add("Item", "/Admin/Events/Add");
        $languages = Language_Model_Language::getInstance()->getList();
        $language = (get('lan') != "" ? get('lan') : $languages[0]->LanId);

        if ($this->isPost()) {

            $imageFile = "";
            if (Com_File_Handler::getInstance()->setFile(get("Image"))->hasErrors()) {
                Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "El Archivo Seleccionado no pudo ser guardado por favor Intente Nuevamente");
            } else if (Com_File_Handler::getInstance()->saveFile("Resources/Uploads/Image/")) {
                $imageFile = Com_File_Handler::getInstance()->getFileName();
            }

            Events_Model_Event::getInstance()->doUpdate(get('id'), $this->getPostObject(), $imageFile);
            $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/Events/Edit/lan/' . $language . '/id/' . get('id'));
        }

        $entity = Events_Model_Event::getInstance()->get(get('id'), $language);

        $this->assign("Id", $entity->EveId);
        $this->assign("Language", $entity->EveLanId);

       $this->assign('Title',$entity->EveTitle);
        $this->assign('Category',$entity->EveCatId);
        $this->assign('Content',$entity->EveContent);
        $this->assign('Date',$entity->EveDate);
        $this->assign('Image',$entity->EveImage);
        $this->assign('Important',$entity->EveImportant);
        $this->assign('Status',$entity->EveStatus);
        $this->assign('Video',$entity->EveVideo);
        $this->assign("languages", $languages);
        
        $this->assign('Category', CatEvents_Model_CatEvent::getInstance()->getList($languages[0]->LanId));
        
    }

    public function Delete() {
        Events_Model_Event::getInstance()->doDelete(get('id'));
        $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/Events');
    }

}

?>