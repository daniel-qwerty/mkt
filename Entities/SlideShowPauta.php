<?php

class Entities_SlideShowPauta extends Com_Database_Entity_Language {

    public $tableName = "SlideShowPauta";
    public $keyField = "SliId";
    public $lanField = "SliLanId";
    
    public $SliId;
    public $SliLanId;
    public $SliTitle;
    public $SliDescription;
    public $SliImage;
    public $SliLink;
    public $SliStatus;
    public $SliDate;

}
