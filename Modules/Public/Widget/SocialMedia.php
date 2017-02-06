<?php

class Public_Widget_SocialMedia extends Com_Object {

    public $lan;

    /**
     *
     * @static
     * @access public
     * @return Public_Widget_SocialMedia
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
        <div class="sidebar-module module-social m_amarillo text-left">
            <h5 style="color: #FFF;"><?= Texts_Helper_Text::getInstance()->get($this->lan, "txtRedesSociales")->TxtDescription ?></h5>
            <ul class="list-inline">
                <li><a target="_blank" href="<?PHP echo Links_Helper_Link::getInstance()->get('LinkFacebook')->LinUrl; ?>" class="icon icon-sm icon-white icon-circle icon-border fa fa-facebook"></a>
                </li>
                <li><a target="_blank" href="<?PHP echo Links_Helper_Link::getInstance()->get('LinkTwitter')->LinUrl; ?>" class="icon icon-sm icon-white icon-circle icon-border fa fa-twitter"></a>
                </li>
                <li><a target="_blank" href="<?PHP echo Links_Helper_Link::getInstance()->get('LinkIntagram')->LinUrl; ?>"
                       class="icon icon-sm icon-white icon-circle icon-border fa fa-instagram"></a></li>
            </ul>
        </div>
        <?PHP
    }

}
