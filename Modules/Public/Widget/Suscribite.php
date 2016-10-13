<?php

class Public_Widget_Suscribite extends Com_Object {

    public $lan;

    /**
     *
     * @static
     * @access public
     * @return Public_Widget_Suscribite
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    public function setLan($lan) {
        $this->lan = $lan;
        return $this;
    }

    public function render() {
        ?>
        <div class="sidebar-module  bg-gray module-suscribe-magazine text-left">
            <h5>Suscribete</h5>

            <div class="magazine-container">
                <img src="<?PHP echo Com_Helper_Url::getInstance()->getImage(); ?>/Public/magazine01.jpg"
                     alt=""/>
            </div>
            <div class="magazine-container-decoration"></div>

            <form class="form-inline-flex-xs">
                <div class="form-group">
                    <input type="text" class="form-control" id="nombre" placeholder="nombre">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="apellido" placeholder="epallido">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="email" placeholder="email">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-block">Suscribete!</button>
                </div>
            </form>
        </div>
        <?PHP
    }

}
