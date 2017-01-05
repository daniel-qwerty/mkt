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
        $db->VenTotal = "0";
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
        $db->VenCliId = $obj->VenCliId;
        $db->VenDate = $obj->VenDate;
        $db->VenStatus = $obj->VenStatus;
        $db->VenTotal = $obj->VenTotal;
        $db->action = ACTION_UPDATE;
        $db->save();
        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Actualizado");
    }
    
    public function doUpdateVenta($intId, $total) {
        $db = new Entities_Venta();       
        $db->VenId = $intId;      
        $db->VenStatus = "0";    
        $db->VenTotal = $total; 
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
        $db->VenStatus = '1';
        $db->get();
        return $db;
    }
    
    public function getListCarrito($date, $cliId ) {
        $text = new Entities_Venta();
        $result = Com_Database_Query::getInstance()->select()->from("Venta")->innerJoin("DetalleVenta", "DetalleVenta.DetVenId=Venta.VenId")->where("Venta.VenCliId={$cliId} and Venta.VenDate = '{$date}' and Venta.VenStatus='1'");        
        return $text->getAll($result);
    }
    
    public function getListCarritoAll() {
        $text = new Entities_Venta();
        $result = Com_Database_Query::getInstance()->select()->from("Venta")->orderBy("Venta.VenDate");        
        return $text->getAll($result);
    }
    
    public function getListCarritoFinalizados() {
        $text = new Entities_Venta();
//        $result = Com_Database_Query::getInstance()->select("Count(*) as number")->from("Venta")->andWhere("VenStatus=0")->orderBy("Venta.VenDate");        
//        return $text->getAll($result);
        return $text->getAll("select count(*) as number from {$text} where VenStatus=0");
    }
    
    public function getSumCarrito($date, $cliId ) {
        $text = new Entities_Venta();
        $result = Com_Database_Query::getInstance()->select("SUM(DetalleVenta.DetPrecio) as total")->from("Venta")->innerJoin("DetalleVenta", "DetalleVenta.DetVenId=Venta.VenId")->where("Venta.VenCliId={$cliId} and Venta.VenDate = '{$date}'and Venta.VenStatus='1'");
        
        return $text->getAll($result);
    }
    
    public function getSumCarritoByVenta($venId) {
        $text = new Entities_Venta();
        $result = Com_Database_Query::getInstance()->select("SUM(DetalleVenta.DetPrecio) as total")->from("Venta")->innerJoin("DetalleVenta", "DetalleVenta.DetVenId=Venta.VenId")->where("Venta.VenId={$venId} and Venta.VenStatus='1'");
        
        return $text->getAll($result);
    }

}
