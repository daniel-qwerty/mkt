<?php

class Clients_Model_Venta extends Com_Module_Model {

    /**
     *
     * @return Clients_Model_Venta 
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    public function doInsert(Com_Object $obj) {

        $db = new Entities_Venta();
        $db->VenCliId = $obj->VenCliId;
        $db->VenDate = date('Y-m-d');
        $db->VenStatus = $obj->VenStatus;
        $db->action = ACTION_INSERT;
        $db->save();        
        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Insertado");
        return $db->VenId;
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
        $db->VenId = $intId;
        $db->VenCliId = $obj->ClientId;
        $db->VenDate = $obj->Date;
        $db->VenStatus = $obj->Status;
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
        $db = new Entities_Venta();
        $db->VenId = $intId;
        $db->get();
        return $db;
    }

    public function getVenta($cliId, $date) {
        $db = new Entities_Venta();
        $db->VenCliId = $cliId;
        $db->VenDate = $date;
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
