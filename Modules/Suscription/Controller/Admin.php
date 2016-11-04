<?PHP

class Suscription_Controller_Admin extends Admin_Controller_Admin {

    public function init() {
        parent::init();
        Com_Helper_Title::getInstance()->title = "M&oacute;dulo Suscripcion";
        Com_Helper_BreadCrumbs::getInstance()->add("Suscripcion", "/Admin/Suscription");
    }

    public function Add() {
        Com_Helper_BreadCrumbs::getInstance()->add("Item", "/Admin/Suscription/Add");
        $languages = Language_Model_Language::getInstance()->getList();
        if ($this->isPost()) {
            
            $imageFile = "";
            if (Com_File_Handler::getInstance()->setFile(get("Image"))->hasErrors()) {
                Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "El Archivo Seleccionado no pudo ser guardado por favor Intente Nuevamente");
            } else if (Com_File_Handler::getInstance()->saveFile("Resources/Uploads/Image/")) {
                $imageFile = Com_File_Handler::getInstance()->getFileName();
            }
            
            $id = Suscription_Model_Suscription::getInstance()->doInsert($this->getPostObject(), $languages, $imageFile);
            $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/Suscription/Edit/id/' . $id);
        }
        $this->assign('Title');
        $this->assign('Description');
        $this->assign('Price');
        $this->assign('Color');
        $this->assign('Status');
        $this->assign('Image');
       
        $this->assign("languages", $languages);
        $this->assign("Language", (get('lan') != "" ? get('lan') : $languages[0]->LanId));
        
        
    }

    public function Edit() {
        Com_Helper_BreadCrumbs::getInstance()->add("Item", "/Admin/Suscription/Add");
        $languages = Language_Model_Language::getInstance()->getList();
        $language = (get('lan') != "" ? get('lan') : $languages[0]->LanId);
        
        if ($this->isPost()) {
            
            $imageFile = "";
            if (Com_File_Handler::getInstance()->setFile(get("Image"))->hasErrors()) {
                Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "El Archivo Seleccionado no pudo ser guardado por favor Intente Nuevamente");
            } else if (Com_File_Handler::getInstance()->saveFile("Resources/Uploads/Image/")) {
                $imageFile = Com_File_Handler::getInstance()->getFileName();
            }
            
            Suscription_Model_Suscription::getInstance()->doUpdate(get('id'), $this->getPostObject(), $imageFile);
            $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/Suscription/Edit/lan/' . $language . '/id/' . get('id'));
        }

        $entity = Suscription_Model_Suscription::getInstance()->get(get('id'), $language);

        $this->assign("Id", $entity->SusId);
        $this->assign("Language", $entity->SusLanId);        
        $this->assign('Title',$entity->SusTitle);
        $this->assign('Description', $entity->SusDescription);
        $this->assign('Price', $entity->SusPrice);
        $this->assign('Color', $entity->SusColor);
        $this->assign('Status', $entity->SusStatus);
        $this->assign('Image', $entity->SusImage);

        $this->assign("languages", $languages);
        
       
    }

    public function Delete() {
        Suscription_Model_Suscription::getInstance()->doDelete(get('id'));
        $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/Suscription');
    }

}

?>