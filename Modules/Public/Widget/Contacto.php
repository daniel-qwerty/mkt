<?php

class Pages_Widget_Contacto extends Com_Object
{

    private $lan;

    /**
     *
     * @static
     * @access public
     * @return Pages_Widget_Contacto
     */
    public static function getInstance()
    {
        return self::_getInstance(__CLASS__);
    }

    public function setLan($lan) {
        $this->lan = $lan;
        return $this;
    }


    public function render()
    {

        ?>
        <section class="section">

            <div class="container">
                <div class="row element-top-60 element-bottom-60">
                    <div class="col-sm-4">
                        <div class="sidebar-widget">
                            <h3 class="sidebar-header">
                                <?PHP echo Texts_Helper_Text::getInstance()->get($this->lan, 'titleNosotros')->TxtDescription; ?>
                            </h3>
                            <div>
                                <p class="element-bottom-20"><img alt="decor"
                                                                  src="<?PHP echo Com_Helper_Url::getInstance()->getImage(); ?>/Public/hotel/decor-small-white.png">
                                </p>
                                <p><?PHP Menu_Widget_MenuFooter::getInstance()->setLan($this->lan)->setParent(25)->render(); ?></p>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="sidebar-widget " id="text-2">
                            <h3 class="sidebar-header">
                                <?PHP echo Texts_Helper_Text::getInstance()->get($this->lan, 'txtContacto')->TxtDescription; ?>
                            </h3>
                            <div>
                                <p class="element-bottom-20"><img alt="decor"
                                                                  src="<?PHP echo Com_Helper_Url::getInstance()->getImage(); ?>/Public/hotel/decor-small-white.png">
                                </p>
                                <?PHP echo Texts_Helper_Text::getInstance()->get($this->lan, 'txtTelefono')->TxtDescription; ?>
                                - <?PHP echo Texts_Helper_Text::getInstance()->get($this->lan, 'txtFax')->TxtDescription; ?>
                                <br>
                                <?PHP echo Texts_Helper_Text::getInstance()->get($this->lan, 'txtTollFree')->TxtDescription; ?>
                                - <?PHP echo Texts_Helper_Text::getInstance()->get($this->lan, 'txtPoBox')->TxtDescription; ?>
                                <br>
                                <?PHP echo Texts_Helper_Text::getInstance()->get($this->lan, 'txtEmail')->TxtDescription; ?>
                            </div>
                        </div>
                        <div class="sidebar-widget">
                            <!--<ul class="unstyled inline social-icons social-simple">

                                <li>
                                    <a class="fa fa-paypal" data-iconcolor="#3b9999" href="#"></a>
                                </li>
                                <li>
                                    <a class="fa fa-bank" data-iconcolor="#3b9999" href="#"></a>
                                </li>
                                <li>
                                    <a class="fa fa-cc-mastercard" data-iconcolor="#3b9999" href="#"></a>
                                </li>
                                <li>
                                    <a class="fa fa-credit-card" data-iconcolor="#3b9999" href="#"></a>
                                </li>
                            </ul>-->
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="sidebar-widget ">
                            <h3 class="sidebar-header">
                                <?PHP echo Texts_Helper_Text::getInstance()->get($this->lan, 'txtUbicacion')->TxtDescription; ?>
                            </h3>
                            <div>
                                <p class="element-bottom-20"><img alt="decor"
                                                                  src="<?PHP echo Com_Helper_Url::getInstance()->getImage(); ?>/Public/hotel/decor-small-white.png">
                                </p>
                                <address>
                                    <?PHP echo Texts_Helper_Text::getInstance()->get($this->lan, 'txtDireccion')->TxtDescription; ?>
                                    <br>
                                    Santa Cruz de la Sierra - Bolivia.
                                </address>

                            </div>
                        </div>
                        <br>
                        <div class="sidebar-widget">
                            <ul class="unstyled inline social-icons social-simple">
                                <li>
                                    <a target="_blank" href="<?PHP echo Links_Helper_Link::getInstance()->get('LinkFacebook')->LinUrl; ?>"><img src="<?PHP echo Com_Helper_Url::getInstance()->getImage(); ?>/Public/hotel/fb.png"></a>
                                </li>
                                <li>
                                    <a target="_blank" href="<?PHP echo Links_Helper_Link::getInstance()->get('LinkLinkedin')->LinUrl; ?>"><img src="<?PHP echo Com_Helper_Url::getInstance()->getImage(); ?>/Public/hotel/in.png"></a>
                                </li>
                                <li>
                                    <a target="_blank" href="<?PHP echo Links_Helper_Link::getInstance()->get('LinkTwitter')->LinUrl; ?>"><img src="<?PHP echo Com_Helper_Url::getInstance()->getImage(); ?>/Public/hotel/tw.png"></a>
                                </li>
                                <li>
                                    <a target="_blank" href="<?PHP echo Links_Helper_Link::getInstance()->get('LinkInstagram')->LinUrl; ?>"><img src="<?PHP echo Com_Helper_Url::getInstance()->getImage(); ?>/Public/hotel/instagram.png"></a>
                                </li>
                                <li>
                                    <a target="_blank" href="<?PHP echo Links_Helper_Link::getInstance()->get('LinkYoutube')->LinUrl; ?>"><img src="<?PHP echo Com_Helper_Url::getInstance()->getImage(); ?>/Public/hotel/youtube.png"></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section subfooter">
            <div class="container">
                <div class="row element-top-10 element-bottom-10 footer-columns-2">
                    <div class="col-sm-6">
                        <div class="sidebar-widget">
                            <div> © 2015 Lambda Hotel. All Rights Reserved</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="sidebar-widget widget_nav_menu">
                            <div class="menu-footer-container">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?PHP
    }

}
