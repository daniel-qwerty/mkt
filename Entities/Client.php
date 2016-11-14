<?php

class Entities_Client extends Com_Database_Entity {

    public $tableName = "Client";
    public $keyField = "CliId";
    
    public $CliId;
    public $CliName;
    public $CliBirthDate;
    public $CliGender;
    public $CliEmail;
    public $CliCountry;
    public $CliCity;
    public $CliPassword;
    public $CliFacebook;
    public $CliPhone;
    public $CliType;
    public $CliDate;
    public $CliStatus;

    public function getList() {

        return Com_Database_Query::getInstance()->select()
                        ->from($this);
    }

}
