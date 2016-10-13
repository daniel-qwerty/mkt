<?php

class Public_Widget_Busqueda extends Com_Object {

    public $lan;

    /**
     *
     * @static
     * @access public
     * @return Public_Widget_Busqueda
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
        <div class="sidebar-module  module-search bg-darker text-left">
            <h5>Busqueda</h5>
            <!-- RD Navbar Search-->
            <div class="rd-navbar-search-mod-1">
                <form class="form-inline-flex-xs">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control" id="exampleInputAmount"
                                   placeholder="buscar">

                            <div class="input-group-addon">
                                <button type="submit" class="btn"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
        <?PHP
    }

}
