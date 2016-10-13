<?php

class Categories_Widget_Categories extends Com_Object {

    private $lan;
    private $type;
    private $limit;

    /**
     *
     * @static
     * @access public
     * @return Categories_Widget_Categories
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    public function setType($id) {
        $this->type = $id;
        return $this;
    }
    
    public function setLimit($id) {
        $this->limit = $id;
        return $this;
    }

    public function setLan($lan) {
        $this->lan = $lan;
        return $this;
    }

    /**
     * @access public
     */
    public function render() {

        $list = Categories_Model_Category::getInstance()->getCategories($this->lan->LanId, $this->type, $this->limit);
       $count = 0;
        foreach ($list as $item){
            $count++; ?>


            <?php             
            if($count == 2){
                
            }
             ?>
               
               
              
                
            <?php
             

            
        }
       
    }
}
?>
