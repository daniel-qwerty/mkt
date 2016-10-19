<?php

class Public_Widget_Footer extends Com_Object {
public $lan;
    /**
     *
     * @static
     * @access public
     * @return Public_Widget_Footer
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
                        <h2><?= Texts_Helper_Text::getInstance()->get($this->lan, "txtNavegacion")->TxtDescription ?></h2>
                        <ul>
                            <li><a href="#"> Contacto</a></li>
                            <li><a href="#"> Escribe para nos.</a></li>
                            <li><a href="#"> Kit de ventas</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-4 col-footer color-gray-2">
                        <h2><?= Texts_Helper_Text::getInstance()->get($this->lan, "txtRedesSociales")->TxtDescription ?></h2>
                        <ul>
                            <li><a target="_blank" href="<?PHP echo Links_Helper_Link::getInstance()->get('LinkFacebook')->LinUrl; ?>"> Facebook</a></li>
                            <li><a target="_blank" href="<?PHP echo Links_Helper_Link::getInstance()->get('LinkTwitter')->LinUrl; ?>"> Twitter</a></li>
                            <li><a target="_blank" href="<?PHP echo Links_Helper_Link::getInstance()->get('LinkInstagram')->LinUrl; ?>"> Instagram</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-4 text-center col-footer color-gray-1">
                        <img class="logo img-responsive"
                             src="<?PHP echo Com_Helper_Url::getInstance()->getImage(); ?>/Public/logo_black.png" alt=""/>

                        <p class="copy"><?= Texts_Helper_Text::getInstance()->get($this->lan, "txtCopy")->TxtDescription ?> </p>
                    </div>
                </div>
            </div>
        </section>
        <?PHP
    }

}
