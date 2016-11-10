<?php

class Clients_Widget_Menu extends Com_Object {

    /**
     *
     * @return Clients_Widget_Menu 
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    public function render() {
        $client = get('sessionCliente');
        if ($client->CliId > 0) {
            ?>
            <div id="loginMenu">
                <div class="container">
                    <ul>
                        <li><a href="<?PHP echo Com_Helper_Url::getInstance()->urlBase; ?>/Index/Clients/Profile" title="Editar Perfil" alt="Editar Perfil"><?PHP echo $client->CliName; ?></a></li>
                        <li><a href="<?PHP echo Com_Helper_Url::getInstance()->urlBase; ?>/Index/Clients/Favorites">Favoritos</a></li>
                        <li><a onclick="closeSession();">Salir</a></li>
                    </ul>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
            <?PHP
        }
    }

}
