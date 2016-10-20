<?PHP

class Categories_Controller_Admin extends Admin_Controller_Admin {

    public function init() {
        parent::init();
        Com_Helper_Title::getInstance()->title = "M&oacute;dulo Categorias";
        Com_Helper_BreadCrumbs::getInstance()->add("Categorias", "/Admin/Categories");
    }

    public function Add() {
        Com_Helper_BreadCrumbs::getInstance()->add("Item", "/Admin/Categories/Add");
        $languages = Language_Model_Language::getInstance()->getList();
        if ($this->isPost()) {

            $fileName = "";
            if (Com_File_Handler::getInstance()->setFile(get("Image"))->hasErrors()) {
                Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "El Archivo Seleccionado no pudo ser guardado por favor Intente Nuevamente");
            } else if (Com_File_Handler::getInstance()->saveFile("Resources/Uploads/Image/")) {
                $fileName = Com_File_Handler::getInstance()->getFileName();
            }


            $id = Categories_Model_Category::getInstance()->doInsert($this->getPostObject(), $languages, $fileName);
            $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/Categories/Edit/id/' . $id);
        }

        $this->assign('Alias');
        $this->assign('Parent');
        $this->assign('Color');
        $this->assign('Type');
        $this->assign('Status');
        $this->assign('Image');
        $this->assign('Description');
        $this->assign('Important');
        $this->assign('Class');
        $this->assign('Link');
        

        $this->assign('Parents', Categories_Model_Category::getInstance()->getParents((get('lan') != "" ? get('lan') : $languages[0]->LanId)));
        $this->assign("languages", $languages);
        $this->assign("Language", (get('lan') != "" ? get('lan') : $languages[0]->LanId));
    }

    public function Edit() {
        Com_Helper_BreadCrumbs::getInstance()->add("Item", "/Admin/Categories/Add");
        $languages = Language_Model_Language::getInstance()->getList();
        $language = (get('lan') != "" ? get('lan') : $languages[0]->LanId);

        if ($this->isPost()) {

            $fileName = "";
            if (Com_File_Handler::getInstance()->setFile(get("Image"))->hasErrors()) {
                Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "El Archivo Seleccionado no pudo ser guardado por favor Intente Nuevamente");
            } else if (Com_File_Handler::getInstance()->saveFile("Resources/Uploads/Image/")) {
                $fileName = Com_File_Handler::getInstance()->getFileName();
            }

            Categories_Model_Category::getInstance()->doUpdate(get('id'), $this->getPostObject(), $fileName);
            $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/Categories/Edit/lan/' . $language . '/id/' . get('id'));
        }

        $entity = Categories_Model_Category::getInstance()->get(get('id'), $language);

        $this->assign("Id", $entity->CatId);
        $this->assign("Language", $entity->CatLanId);
        $this->assign('Alias', $entity->CatAlias);
        $this->assign('Parent', $entity->CatParentId);
        $this->assign('Color', $entity->CatColor);
        $this->assign('Type', $entity->CatType);
        $this->assign('Status', $entity->CatStatus);
        $this->assign('Image', $entity->CatImage);
        $this->assign('Description', $entity->CatDescription);
        $this->assign('Important', $entity->CatImportant);
        $this->assign('Class', $entity->CatClass);
        $this->assign('Link', $entity->CatLinkModule);
       

        $this->assign('Parents', Categories_Model_Category::getInstance()->getParents($entity->CatLanId, $entity->CatId));
        $this->assign("languages", $languages);
    }

    public function Delete() {
        Categories_Model_Category::getInstance()->doDelete(get('id'));
        $this->redirect(Com_Helper_Url::getInstance()->urlBase . '/Admin/Categories');
    }

    public function Order() {
        Com_Helper_BreadCrumbs::getInstance()->add("Item", "/Admin/Categories/Add");
        $languages = Language_Model_Language::getInstance()->getList();

        $language = (get('lan') != "" ? get('lan') : $languages[0]->LanId);

        if ($this->isPost()) {
            Categories_Model_Category::getInstance()->refreshOrder($language, get('Order'));        }


        $this->assign('lstModules', Categories_Model_Category::getInstance()->getList($language));
        $this->assign("Language", $language);
        $this->assign("languages", $languages);
    }

}

?>