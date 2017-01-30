<?php

class Clients_Model_DetVenta extends Com_Module_Model {

    /**
     *
     * @return Clients_Model_DetVenta 
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    public function doInsert(Com_Object $obj) {

        $db = new Entities_VentaDetalle();
        $db->DetVenId = $obj->DetVenId;
        $db->DetItem = $obj->DetItem;
        $db->DetCant = $obj->DetCant;
        $db->DetPrecio = $obj->DetPrecio;
        $db->DetImagen = $obj->DetImagen;
        $db->DetIdProd = $obj->DetIdProd;
        $db->action = ACTION_INSERT;
        $db->save();
        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Insertado");
    }

    public function doInsertFromWs($venId, Com_Object $obj) {
        $db = new Entities_VentaDetalle();        
        $db->DetVenId = $venId;
        $db->DetItem = $obj->Item;
        $db->DetCant = $obj->Cant;
        $db->DetPrecio = $obj->Precio;
        $db->get();
        if (!($db->DetId > 0)) {
            $db->action = ACTION_INSERT;
            $db->save();
        }
    }

    public function doUpdate($intId, Com_Object $obj) {
        $db = new Entities_VentaDetalle();
        $db->DetId = $intId;
        $db->DetVenId = $obj->ClientId;
        $db->DetItem = $obj->Item;
        $db->DetCant = $obj->Cant;
        $db->DetPrecio = $obj->Precio;
        $db->DetImagen = $obj->DetImagen;
        $db->DetIdProd = $obj->DetIdProd;
        $db->action = ACTION_UPDATE;
        $db->save();
        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Actualizado");
    }

    public function doDelete($intId) {
        $db = new Entities_VentaDetalle();
        $db->DetId = $intId;
        $db->action = ACTION_DELETE;
        $db->save();
        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Eliminado");
    }

    public function get($intId) {
        $db = new Entities_VentaDetalle();
        $db->DetId = $intId;
        $db->get();
        return $db;
    }

    public function getList($venId) {
        $text = new Entities_VentaDetalle();
        return $text->getAll($text->getList()->where("DetVenId={$venId}"));
    }

}
