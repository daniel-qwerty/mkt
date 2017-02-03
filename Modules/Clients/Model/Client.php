<?php

class Clients_Model_Client extends Com_Module_Model {

    /**
     *
     * @return Clients_Model_Client 
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    public function doInsert(Com_Object $obj) {

        $db = new Entities_Client();
        $db->CliName = $obj->Name;
        $db->CliBirthDate = $obj->Nacimiento;
        $db->CliGender = $obj->Gender;
        $db->CliEmail = $obj->Email;
        $db->CliCountry = $obj->Country;
        $db->CliCity = $obj->City;
        $db->CliPassword = $obj->Password;
        $db->CliFacebook = $obj->Facebook;
        $db->CliPhone = $obj->Phone;
        $db->CliType = $obj->Type;
        $db->CliDate = $obj->Date;
        $db->CliStatus = $obj->Status;
        $cli = $this->getByEmail($obj->Email)->CliId;
        if ($cli == '') {
            $db->action = ACTION_INSERT;
            $db->save();
            Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Insertado");
        }
    }

    public function doSaveEmailFromWs(Com_Object $obj) {

        $db = new Entities_Client();
        $db->CliName = $obj->Name;
        $db->CliBirthDate = $obj->Nacimiento;
        $db->CliGender = $obj->Gender;
        $db->CliEmail = $obj->Email;
        $db->CliCountry = $obj->Country;
        $db->CliCity = $obj->City;
        $db->CliPassword = $obj->Password;
        $db->CliFacebook = $obj->Facebook;
        $db->CliPhone = $obj->Phone;
        $db->CliType = $obj->Type;
        $db->CliDate = $obj->Date;
        $db->CliStatus = $obj->Status;
        $cli = $this->getByEmail($obj->Email)->CliId;
        if ($cli == '') {
            $db->action = ACTION_INSERT;
            $db->save();
            $this->sendEmail($db);
        } else {
            $db->action = ACTION_UPDATE;
            $db->save();
        }
    }

    public function doSaveFacebookFromWs(Com_Object $obj) {
        $db = new Entities_Client();
        $db->CliName = $obj->Name;
        $db->CliBirthDate = $obj->Nacimiento;
        $db->CliGender = $obj->Gender;
        $db->CliEmail = $obj->Email;
        $db->CliCountry = $obj->Country;
        $db->CliCity = $obj->City;
        $db->CliPassword = $obj->Password;
        $db->CliFacebook = $obj->Facebook;
        $db->CliPhone = $obj->Phone;
        $db->CliType = $obj->Type;
        $db->CliDate = $obj->Date;
        $db->CliStatus = $obj->Status;
        $cli = $this->getByFacebookAndEmail($obj->Facebook, $obj->Email)->CliId;
        if ($cli == '') {
            $db->action = ACTION_INSERT;
            $db->save();
        } else {
            $db->action = ACTION_UPDATE;
            $db->save();
        }
    }

    public function doUpdate($intId, Com_Object $obj) {
        $db = new Entities_Client();
        $db->CliId = $intId;
        $db->CliName = $obj->Name;
        $db->CliBirthDate = $obj->Nacimiento;
        $db->CliGender = $obj->Gender;
        $db->CliEmail = $obj->Email;
        $db->CliCountry = $obj->Country;
        $db->CliCity = $obj->City;
        $db->CliPassword = $obj->Password;
        $db->CliFacebook = $obj->Facebook;
        $db->CliPhone = $obj->Phone;
        $db->CliType = $obj->Type;
        $db->CliDate = $obj->Date;
        $db->CliStatus = $obj->Status;
        $db->action = ACTION_UPDATE;
        $db->save();
        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Actualizado");
    }

    public function doUpdateWs(Entities_Client $obj) {
        $db = new Entities_Client();
        $db = $obj;
        $db->action = ACTION_UPDATE;
        $db->save();
    }

    public function doUpdateFromPage(Com_Object $obj) {
        $db = new Entities_Client();
        $db->CliId = $obj->Id;
        //$db->get();
        $db->CliName = $obj->Name;
        $db->CliEmail = $obj->Email;
        $db->CliPhone = $obj->Phone;
        $db->CliBirthDate = $obj->Nacimiento;
        if ($obj->Password != "") {
            $db->CliPassword = $obj->Password;
        }
        $db->action = ACTION_UPDATE;
        $db->save();
    }

    public function doDelete($intId) {
        $db = new Entities_Client();
        $db->CliId = $intId;
        $db->action = ACTION_DELETEF;
        $db->save();
        Com_Wizard_Messages::getInstance()->addMessage(MESSAGE_INFORMATION, "Registro Eliminado");
    }

    public function doLogin(Com_Object $post) {
        $db = new Entities_Client();
        $db->CliEmail = $post->Email;
        $db->CliPassword = $post->Password;
        $db->get();
        if ($db->CliId > 0) {
            return $db;
        }
        return "";
    }

    public function doLoginFb(Com_Object $post) {
        $db = new Entities_Client();
        $db->CliEmail = $post->Email;
        $db->CliFacebook = $post->Facebook;
        $db->get();
        if ($db->CliId > 0) {
            return $db;
        }
        return "";
    }

    public function get($intId) {
        $db = new Entities_Client();
        $db->CliId = $intId;
        $db->get();
        return $db;
    }

    public function getByEmail($strEmail) {
        $db = new Entities_Client();
        $db->CliEmail = $strEmail;
        $db->get();
        return $db;
    }

    public function getByMd5Email($strEmail) {
        $db = new Entities_Client();
        $list = $db->getAll($db->getList()->where("md5(CliEmail)='{$strEmail}'"));
        $db = $list[0];
        return $db;
    }

    public function getByFacebookAndEmail($strFacebbok, $strEmail) {
        $db = new Entities_Client();
        $db->CliFacebook = $strFacebbok;
        $db->CliEmail = $strEmail;
        $db->get();
        return $db;
    }

    public function getByFacebook($strFacebbok) {
        $db = new Entities_Client();
        $db->CliFacebook = $strFacebbok;
        $db->get();
        return $db;
    }

    public function forgot($strEmail) {
        $db = new Entities_Client();
        $db->CliEmail = $strEmail;
        $db->get();
        if ($db->CliId > 0) {
            $db->CliPassword = generateCharacters(6);
            $db->action = ACTION_UPDATE;
            $db->save();
            $this->sendForgotEmail($db);
            //$db->CliName = utf8_encode($db->CliName);
            return true;
        }
        return false;
    }

    public function sendForgotEmail(Entities_Client $obj) {
        $email = new Com_Wizard_Mail();
        $strTitle = strtoupper("Recordatorio");
        $strLogo = Com_Helper_Url::getInstance()->getImage() . "/Public/logo.png";
        $email->setSubject($strTitle);
        $email->setFrom(EMAIL_USERNAME, EMAIL_FROM);
        $strMessage = file_get_contents(Com_Helper_Url::getInstance()->physicalDirectory . "/Resources/Layouts/Email/forgot.phtml");
        $strMessage = str_replace("{Title}", Configurations_Helper_Configuration::getInstance()->getKey("PAGE_TITLE"), $strMessage);
        $strMessage = str_replace("{Footer}", Configurations_Helper_Configuration::getInstance()->getKey("FORGOT_FOOTER"), $strMessage);
        $strMessage = str_replace("{Logo}", $strLogo, $strMessage);
        $strMessage = str_replace("{Register.Date}", date("d/m/Y H:i:s"), $strMessage);
        $strMessage = str_replace("{Register.Name}", $obj->CliName, $strMessage);
        $strMessage = str_replace("{Register.Email}", $obj->CliEmail, $strMessage);
        $strMessage = str_replace("{Register.Content}", "Su nueva contrase&ntilde;a es: " . $obj->CliPassword, $strMessage);
        $email->addAddress($obj->CliEmail, $obj->CliName);
        $email->setMessage($strMessage);
        $email->send();
    }

    public function sendEmail(Entities_Client $obj) {
        $email = new Com_Wizard_Mail();
        $strTitle = strtoupper("Nuevo Registro de Usuario");
        $strLogo = Com_Helper_Url::getInstance()->getImage() . "/Public/logo.png";
        $email->setSubject($strTitle);
        $email->setFrom(EMAIL_USERNAME, EMAIL_FROM);
        $strMessage = file_get_contents(Com_Helper_Url::getInstance()->physicalDirectory . "/Resources/Layouts/Email/register.phtml");
        $strMessage = str_replace("{Title}", Configurations_Helper_Configuration::getInstance()->getKey("PAGE_TITLE"), $strMessage);
        $strMessage = str_replace("{Footer}", Configurations_Helper_Configuration::getInstance()->getKey("REGISTER_FOOTER"), $strMessage);
        $strMessage = str_replace("{Logo}", $strLogo, $strMessage);
        $strMessage = str_replace("{Title}", $strTitle, $strMessage);
        $strMessage = str_replace("{Register.Date}", date("d/m/Y H:i:s"), $strMessage);
        $strMessage = str_replace("{Register.Name}", $obj->CliName, $strMessage);
        $strMessage = str_replace("{Register.Email}", $obj->CliEmail, $strMessage);
        $strMessage = str_replace("{Register.Content}", "Muchas Gracias por utilizar Diabetes tu Riesgo", $strMessage);
        $strMessage = str_replace("{Register.activate}", Com_Helper_Url::getInstance()->urlBase . "/Index/Clients/Activate/key/" . md5($obj->CliEmail), $strMessage);
        $email->addAddress($obj->CliEmail, $obj->CliName);
        $email->setMessage($strMessage);
        $email->send();
    }

    public function getList() {
        $client = new Entities_Client();
        return $client->getAll($client->getList());
    }

}
