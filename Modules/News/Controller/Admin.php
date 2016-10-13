<?PHP

class News_Controller_Admin extends Admin_Controller_Admin {

    public function init() {
        parent::init();
        Com_Helper_Title::getInstance()->title = "M&oacute;dulo Noticias";
        Com_Helper_BreadCrumbs::getInstance()->add("Noticias", "/Admin/News");
        
//        $obj = get('userType');
//        if($obj == 1){
//            $this->redirect(Com_Helper_Url::getInstance()->generateUrl("es", "error"));
//            exit;
//        }
        
    }

    public function Add() {
        Com_Helper_BreadCrumbs::getInstance()->add("Item", "/Admin/News/Add");
        $languages = Language_Model_Language::getInstance()->getList();
        if ($this->isPost()) {

            $imageFile = "";
            if (Com_File_Handler::getInstance()->setFile(get("Image"))->hasErrors()) {
                Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "El Archivo Seleccionado no pudo ser guardado por favor Intente Nuevamente");
            } else if (Com_File_Handler::getInstance()->saveFile("Resources/Uploads/Image/")) {
                $imageFile = Com_File_Handler::getInstance()->getFileName();
            }

            $id = News_Model_New::getInstance()->doInsert($this->getPostObject(), $languages, $imageFile);
            $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/News/Edit/id/' . $id);
        }
        $this->assign('Title');
        $this->assign('Category');
        $this->assign('Content');
        $this->assign('Date');
        $this->assign('MetaTags');
        $this->assign('Description');
        $this->assign('Author');
        $this->assign('Image');
        $this->assign('Status');
        $this->assign('Important');
        $this->assign("languages", $languages);
        $this->assign("Language", (get('lan') != "" ? get('lan') : $languages[0]->LanId));
        
        $this->assign('Category', Category_Model_Category::getInstance()->getList());
        
    }

    public function Edit() {
        Com_Helper_BreadCrumbs::getInstance()->add("Item", "/Admin/News/Add");
        $languages = Language_Model_Language::getInstance()->getList();
        $language = (get('lan') != "" ? get('lan') : $languages[0]->LanId);

        if ($this->isPost()) {

            $imageFile = "";
            if (Com_File_Handler::getInstance()->setFile(get("Image"))->hasErrors()) {
                Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "El Archivo Seleccionado no pudo ser guardado por favor Intente Nuevamente");
            } else if (Com_File_Handler::getInstance()->saveFile("Resources/Uploads/Image/")) {
                $imageFile = Com_File_Handler::getInstance()->getFileName();
            }

            News_Model_New::getInstance()->doUpdate(get('id'), $this->getPostObject(), $imageFile);
            $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/News/Edit/lan/' . $language . '/id/' . get('id'));
        }

        $entity = News_Model_New::getInstance()->get(get('id'), $language);

        $this->assign("Id", $entity->NewId);
        $this->assign("Language", $entity->NewLanId);

        $this->assign('Title', $entity->NewTitle);
        $this->assign('Category', $entity->NewCatId);
        $this->assign('Content', $entity->NewContent);
        $this->assign('Date', $entity->NewDate);
        $this->assign('MetaTags', $entity->NewMetaTags);
        $this->assign('Description', $entity->NewDescription);
        $this->assign('Author', $entity->NewAuthor);

        $this->assign('Image', $entity->NewImage);
        $this->assign('Status', $entity->NewStatus);
        $this->assign('Important', $entity->NewImportant);
        $this->assign("languages", $languages);
        
        $this->assign('Category', Category_Model_Category::getInstance()->getList());
        
        
    }

    public function Delete() {
        News_Model_New::getInstance()->doDelete(get('id'));
        $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/News');
    }

}

?>