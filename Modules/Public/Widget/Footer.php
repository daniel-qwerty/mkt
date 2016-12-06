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
                            <li><a data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo" > Contacto</a></li>
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
        <style>
            .modal-backdrop {
                z-index: -2000;
            }
            
            .modal-dialog {
               
                margin: 50px auto;
            }
        </style>
        <div class="modal " id="exampleModal" tabindex="-99999999999" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">Contacto</h4>
                    </div>
                    <div class="modal-body">
                        <form id="formContact">
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><?= Texts_Helper_Text::getInstance()->get($this->lan, "txtContactNombre")->TxtDescription ?></label>
                                <input type="text" class="form-control" id="name">
                            </div>                            
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><?= Texts_Helper_Text::getInstance()->get($this->lan, "txtContactTelefono")->TxtDescription ?></label>
                                <input type="text" class="form-control" id="phone">
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label"><?= Texts_Helper_Text::getInstance()->get($this->lan, "txtContactEmail")->TxtDescription ?></label>
                                <input type="text" class="form-control" id="email">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label"><?= Texts_Helper_Text::getInstance()->get($this->lan, "txtContactMensaje")->TxtDescription ?></label>
                                <textarea class="form-control" id="message"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><?= Texts_Helper_Text::getInstance()->get($this->lan, "txtContactCancelar")->TxtDescription ?></button>
                        <button onclick="sendContact();" type="button" class="btn btn-primary"><?= Texts_Helper_Text::getInstance()->get($this->lan, "txtContactEnviar")->TxtDescription ?></button>
                    </div>
                </div>
            </div>
        </div>
        <?PHP
    }

}
