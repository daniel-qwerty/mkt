<?php

class Entities_MenuDash extends Com_Database_Entity_Language {

    public $tableName = "MenuDash";
    public $keyField = "MenId";
    public $lanField = "MenLanId";
    public $MenId;
    public $MenLanId;
    public $MenParentId;
    public $MenAlias;
    public $MenUrl;
    public $MenOrder;
    public $MenImage;
    public $MenStatus;

    public function getMenuList() {
        return Com_Database_Query::getInstance()->select()
                        ->from($this)
                        ->where("MenStatus=1")
                        ->orderBy("{$this}.MenOrder");
    }

   public function getWithParents() {
        $language = new Entities_Language();
        $parent = new Entities_Menu();
        $lanField = $this->lanField;
        return Com_Database_Query::getInstance()->select(array("{$language}.*", "parent.MenAlias as padre", "{$this}.*"))
                        ->from($this->tableName)
                        ->innerJoin($language, "LanId={$lanField}")
                        ->leftJoin($parent . " as parent", "{$this}.MenParentId=parent.MenId and {$this}.MenLanId=parent.MenLanId");
    }

}
