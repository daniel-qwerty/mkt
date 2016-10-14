<?php

class Entities_Category extends Com_Database_Entity_Language {

    public $tableName = "Category";
    public $keyField = "CatId";
    public $lanField = "CatLanId";
    public $CatId;
    public $CatLanId;
    public $CatParentId;
    public $CatAlias;
    public $CatDescription;
    public $CatColor;
    public $CatOrder;
    public $CatImage;
    public $CatStatus;
    public $CatType;
    public $CatImportant;
    public $CatClass;
    
    
    public function getMenuList() {
        return Com_Database_Query::getInstance()->select()
                        ->from($this)
                        ->where("CatStatus=1")
                        ->orderBy("{$this}.CatOrder");
    }

   public function getWithParents() {
        $language = new Entities_Language();
        $parent = new Entities_Category();
        $lanField = $this->lanField;
        return Com_Database_Query::getInstance()->select(array("{$language}.*", "parent.CatAlias as padre", "{$this}.*"))
                        ->from($this->tableName)
                        ->innerJoin($language, "LanId={$lanField}")
                        ->leftJoin($parent . " as parent", "{$this}.CatParentId=parent.CatId and {$this}.CatLanId=parent.CatLanId");
    }
    
  
    

}
