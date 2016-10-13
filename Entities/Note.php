<?php

class Entities_Note extends Com_Database_Entity_Language {

    public $tableName = "Notes";
    public $keyField = "NotId";
    public $lanField = "NotLanId";
    public $NotId;
    public $NotLanId;    
    public $NotCatId;
    public $NotTitle;
    public $NotResume;
    public $NotDescription;
    public $NotDate;
    public $NotImage;
    public $NotUrl;
    public $NotTags;
    public $NotViews;
    public $NotUser;
    public $NotStatus;
    public $NotImportant;

}
