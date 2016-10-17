<?php

class Tools_Controller_Index extends Public_Controller_Index {

    public function Index() {
        $this->setLayout("template3");
        $this->setView("list");
        $url = get('REQUEST_URI');
        $url = explode("/", $url);
        $url = $url[count($url) - 1];

       // $this->assign("categoryId", $url);

        $category = CatTools_Model_CatTool::getInstance()->getList2($this->lan->LanId, 4);
        //print_r($category);
        $this->assign("category", $category);

        
        if ($this->getPostObject()->page == NULL) {
            $tools = Tools_Model_Tool::getInstance()->getList2($this->lan->LanId, 20);
            $this->assign("tools", $tools);
        } else {
            $tools = Tools_Model_Tool::getInstance()->getListByParent($this->lan->LanId, $this->getPostObject()->page, 20);
            $this->assign("tools", $tools);
        }
    }

    

}
