<?php

class Colaboradores_Model_Colaboradores extends Com_Module_Model {

    /**
     *
     * @return Colaboradores_Model_Colaboradores 
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    public function doInsert(Com_Object $obj) {

        $db = new Entities_Colaboradores();
        $db->ColNombre = $obj->Nombre;
        $db->ColPerfil = $obj->Perfil;
        $db->ColOcupacion = $obj->Ocupacion;
        $db->ColRubro = $obj->Rubro;
        $db->ColPais = $obj->Pais;
        $db->ColWeb = $obj->Web;
        $db->ColTema = $obj->Tema;
        $db->ColArticulo = $obj->Articulo;
        $db->ColEmail = $obj->Email;
        $db->ColTelefono = $obj->Telefono;
        
        $db->action = ACTION_INSERT;
        $db->save();
        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Insertado");
    }

    public function doInsertFromWs(Com_Object $obj) {

        $db = new Entities_Colaboradores();
        $db->ColNombre = $obj->Nombre;
        $db->ColPerfil = $obj->Perfil;
        $db->ColOcupacion = $obj->Ocupacion;
        $db->ColRubro = $obj->Rubro;
        $db->ColPais = $obj->Pais;
        $db->ColWeb = $obj->Web;
        $db->ColTema = $obj->Tema;
        $db->ColArticulo = $obj->Articulo;
        $db->ColEmail = $obj->Email;
        $db->ColTelefono = $obj->Telefono;
        $db->action = ACTION_INSERT;
        $db->save();
    }

    public function doUpdate($intId, Com_Object $obj) {
        $db = new Entities_Colaboradores();
        $db->ColId = $intId;
        $db->ColNombre = $obj->Nombre;
        $db->ColPerfil = $obj->Perfil;
        $db->ColOcupacion = $obj->Ocupacion;
        $db->ColRubro = $obj->Rubro;
        $db->ColPais = $obj->Pais;
        $db->ColWeb = $obj->Web;
        $db->ColTema = $obj->Tema;
        $db->ColArticulo = $obj->Articulo;
        $db->ColEmail = $obj->Email;
        $db->ColTelefono = $obj->Telefono;
        $db->action = ACTION_UPDATE;
        $db->save();
        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Actualizado");
    }

    public function doDelete($intId) {
        $db = new Entities_Colaboradores();
        $db->ColId = $intId;
        $db->action = ACTION_DELETE;
        $db->save();
        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Eliminado");
    }

    public function get($intId) {
        $db = new Entities_Colaboradores();
        $db->ColId = $intId;
        $db->get();
        return $db;
    }

    public function getByName($strName) {
        $db = new Entities_Colaboradores();
        $db->ColNombre = $strName;
        $db->get();
        return $db;
    }

    public function getList() {
        $contact = new Entities_Colaboradores();
        return $contact->getAll($contact->getList());
    }
    

}
