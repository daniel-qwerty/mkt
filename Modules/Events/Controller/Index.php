<?php

class Events_Controller_Index extends Public_Controller_Index {

    public function Index() {
        if ($this->isPost()) {
              $this->setLayout("vacio");
              $this->setView("ajax");
              $events = Events_Model_Event::getInstance()->getListByDate($this->lan->LanId,$this->getPostObject()->Date,20);
              if($events == NULL){
                  echo '<h4>NO SE ENCONTRARON EVENTOS PARA EL: </br>'.$this->getPostObject()->Date.'</h4>';
              }
              $this->assign("events", $events);
            
        }else{
            $this->setLayout("template2");
            $this->setView("list");
            $url = get('REQUEST_URI');
            $url = explode("/", $url);
            $url = $url[count($url) - 1];

            $this->assign("categoryId", $url);       

            $category = CatEvents_Model_CatEvent::getInstance()->getList2($this->lan->LanId, 5);
            $this->assign("category", $category);

            if(empty($url)){
                 $events = Events_Model_Event::getInstance()->getList($this->lan->LanId,20);
                 $this->assign("events", $events);
            }  else {
                 $events = Events_Model_Event::getInstance()->getByCategory($this->lan->LanId,$url,20);
                 $this->assign("events", $events);
            }   
        }
               
    }
    
    

    public function Item() {
        $this->setLayout("template2");
        $this->setView("event");
        $url = get('REQUEST_URI');
        $url = explode("/", $url);
        $url = $url[count($url) - 1];

        

        $category = CatEvents_Model_CatEvent::getInstance()->getList2($this->lan->LanId, 5);
        $this->assign("category", $category);

        $events = Events_Model_Event::getInstance()->get($url, $this->lan->LanId);
        $this->assign("events", $events);
        
    }
}
