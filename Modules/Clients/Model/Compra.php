<?php

class Clients_Model_Compra extends Com_Module_Model {

    /**
     *
     * @return Clients_Model_Compra 
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    public function doInsert(Com_Object $obj) {

        $db = new Entities_Compra();
        
        $db->ComVenId =$obj->VenId;
        $db->ComCedula = $obj->Cedula;
        $db->ComEmail = $obj->Email;
        $db->ComNombre = $obj->Nombre;
        $db->ComTelefono = $obj->Telefono;
        $db->ComPais = $obj->Pais;
        $db->ComCiudad = $obj->Ciudad;
        $db->ComCodPostal = $obj->CodPostal;
        $db->ComDireccion = $obj->Direccion;
        $db->ComPais2 = $obj->Pais2;
        $db->ComCiudad2 = $obj->Ciudad2;
        $db->ComCodPostal2 = $obj->CodPostal2;
        $db->ComDireccion2 = $obj->Direccion2;
        $db->ComDescripcion = $obj->Descripcion;
        $db->ComTotal = $obj->Total;
        $db->ComFecha = date('Y-m-d');
        $db->ComEstado = "1";
        $db->ComMetodo = $obj->Metodo;
        
        $db->action = ACTION_INSERT;
        $db->save();        
        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Insertado");
        
    }

    public function doInsertFromWs($cliId, Com_Object $obj) {
        $db = new Entities_Venta();
        $db->VenCliId = $cliId;
        $db->VenDate = date('Y-m-d');
        $db->VenStatus = $obj->Status;
        $db->get();
        if (!($db->VenId > 0)) {
            $db->action = ACTION_INSERT;
            $db->save();
        }
    }

    public function doUpdate($intId, Com_Object $obj) {
        $db = new Entities_Venta();       
        $db->ComId = $intId;
        $db->ComVenId =$obj->VenId;
        $db->ComCedula = $obj->Cedula;
        $db->ComEmail = $obj->Email;
        $db->ComNombre = $obj->Nombre;
        $db->ComTelefono = $obj->Telefono;
        $db->ComPais = $obj->Pais;
        $db->ComCiudad = $obj->Ciudad;
        $db->ComCodPostal = $obj->CodPostal;
        $db->ComDireccion = $obj->Direccion;
        $db->ComPais2 = $obj->Pais2;
        $db->ComCiudad2 = $obj->Ciudad2;
        $db->ComCodPostal2 = $obj->CodPostal2;
        $db->ComDireccion2 = $obj->Direccion2;
        $db->ComDescripcion = $obj->Descripcion;
        $db->ComTotal = $obj->Total;
        $db->ComFecha = date('Y-m-d');
        $db->ComEstado = "1";
        $db->ComMetodo = $obj->Metodo;
        $db->action = ACTION_UPDATE;
        $db->save();
        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Actualizado");
    }
    
    

    public function doDelete($intId) {
        $db = new Entities_Venta();
        $db->VenId = $intId;
        $db->action = ACTION_DELETE;
        $db->save();
        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Eliminado");
    }

    public function get($intId) {
        $db = new Entities_Compra();
        $db->ComId = $intId;
        $db->get();
        return $db;
    }
    public function get2($intId) {
        $db = new Entities_Compra();
        $db->ComVenId = $intId;
        $db->get();
        return $db;
    }

    public function getCompraByVenta($venId, $date) {
        $db = new Entities_Compra();
        $db->ComVenId = $venId;
        $db->ComFecha = $date;
        $db->get();
        return $db;
    }
    
    public function getListCarrito($date, $cliId ) {
        $text = new Entities_Venta();
        $result = Com_Database_Query::getInstance()->select()->from("Venta")->innerJoin("DetalleVenta", "DetalleVenta.DetVenId=Venta.VenId")->where("Venta.VenCliId={$cliId} and Venta.VenDate = '{$date}'");
        
        return $text->getAll($result);
    }
    
    public function getSumCarrito($date, $cliId ) {
        $text = new Entities_Venta();
        $result = Com_Database_Query::getInstance()->select("SUM(DetalleVenta.DetPrecio) as total")->from("Venta")->innerJoin("DetalleVenta", "DetalleVenta.DetVenId=Venta.VenId")->where("Venta.VenCliId={$cliId} and Venta.VenDate = '{$date}'");
        
        return $text->getAll($result);
    }

}
