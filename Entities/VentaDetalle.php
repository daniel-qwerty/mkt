<?php

class Entities_VentaDetalle extends Com_Database_Entity{

    public $tableName = "DetalleVenta";
    public $keyField = "DetId";
    
    public $DetId;
    public $DetVenId;
    public $DetItem;
    public $DetPrecio;
    public $DetCant;
    public $DetImagen;
    public $DetIdProd;
   
}
