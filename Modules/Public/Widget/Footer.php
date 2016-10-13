<?php

class Public_Widget_Footer extends Com_Object {

    /**
     *
     * @static
     * @access public
     * @return Public_Widget_Footer
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    public function render() {
        ?>
        <section>
            <div class="container-fluid">
                <div class="row text-center">
                    <div class="go-up">
                        <i class="fa fa-angle-up icon-white"></i>
                    </div>
                </div>
            </div>
        </section>
        <section class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-4 col-footer color-gray-1">
                        <h2>Navegar</h2>
                        <ul>
                            <li><a href="#"> Contacto</a></li>
                            <li><a href="#"> Escribe para nos.</a></li>
                            <li><a href="#"> Kit de ventas</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-4 col-footer color-gray-2">
                        <h2>Social</h2>
                        <ul>
                            <li><a href="#"> Facebook</a></li>
                            <li><a href="#"> Twitter</a></li>
                            <li><a href="#"> Google +</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-4 text-center col-footer color-gray-1">
                        <img class="logo img-responsive"
                             src="<?PHP echo Com_Helper_Url::getInstance()->getImage(); ?>/Public/logo_black.png" alt=""/>

                        <p class="copy">    &copy; 2016</p>
                    </div>
                </div>
            </div>
        </section>
        <?PHP
    }

}
