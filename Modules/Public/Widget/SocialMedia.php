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
        <div class="sidebar-module module-social bg-primary text-left">
            <h5>Social</h5>
            <ul class="list-inline">
                <li><a href="#" class="icon icon-sm icon-white icon-circle icon-border fa fa-facebook"></a>
                </li>
                <li><a href="#" class="icon icon-sm icon-white icon-circle icon-border fa fa-twitter"></a>
                </li>
                <li><a href="#"
                       class="icon icon-sm icon-white icon-circle icon-border fa fa-google-plus"></a></li>
            </ul>
        </div>
        <?PHP
    }

}
