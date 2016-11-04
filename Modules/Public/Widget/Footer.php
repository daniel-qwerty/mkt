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
                            <li><a href="#myModal" data-toggle="modal"> Contacto</a></li>
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
        <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 id="myModalLabel">CONTACTO</h3>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal col-sm-12">
                            <div class="form-group"><label>Name</label><input class="form-control required" placeholder="Your name" data-placement="top" data-trigger="manual" data-content="Must be at least 3 characters long, and must only contain letters." type="text"></div>
                            <div class="form-group"><label>Message</label><textarea class="form-control" placeholder="Your message here.." data-placement="top" data-trigger="manual"></textarea></div>
                            <div class="form-group"><label>E-Mail</label><input class="form-control email" placeholder="email@you.com (so that we can contact you)" data-placement="top" data-trigger="manual" data-content="Must be a valid e-mail address (user@gmail.com)" type="text"></div>
                            <div class="form-group"><label>Phone</label><input class="form-control phone" placeholder="999-999-9999" data-placement="top" data-trigger="manual" data-content="Must be a valid phone number (999-999-9999)" type="text"></div>
                            <div class="form-group"><button type="submit" class="btn btn-success pull-right">Send It!</button> <p class="help-block pull-left text-danger hide" id="form-error">&nbsp; The form is not valid. </p></div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
        <?PHP
    }

}
