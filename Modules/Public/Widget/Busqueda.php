<?php

class Public_Widget_Busqueda extends Com_Object {

    public $lan;
    public $type;

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
    
    public function setType($type) {
        $this->type = $type;
        return $this;
    }

    public function render() {       
        ?>
        <div class="sidebar-module  module-search bg-darker text-left">
            <h5><?= Texts_Helper_Text::getInstance()->get($this->lan, "txtBusqueda")->TxtDescription ?></h5>
            <!-- RD Navbar Search-->
            <div class="rd-navbar-search-mod-1">
                <form class="form-inline-flex-xs" method="POST" action="http://localhost/mkt/mkt/es/search/<?php echo $this->type;?>">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" id="search"
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
