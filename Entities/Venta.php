<?php

class Entities_Venta extends Com_Database_Entity{

    public $tableName = "Venta";
    public $keyField = "VenId";
    
    public $VenId;
    public $VenCliId;
    public $VenDate;
    public $VenStatus;
    public $VenTotal;
   
}
