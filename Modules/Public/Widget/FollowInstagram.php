<?php

class Public_Widget_FollowInstagram extends Com_Object {

    public $lan;

    /**
     *
     * @static
     * @access public
     * @return Public_Widget_FollowInstagram
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
        <div class="insta-btn-wrap bg-chambray"><a href="#">Follow us!</a></div>
        <!-- RD Instafeed-->
        <div data-instafeed-clientid="44f19408f04040bd85214315861a84a1" data-instafeed-get="user"
             data-instafeed-user="499522078" data-items="2" data-sm-items="5" data-lg-items="9" data-loop="false"
             data-nav="true" class="owl-carousel instafeed element-groups-xs-custom">
        <?php Gallery_Widget_Home::getInstance()->setLan($this->lan)->setLimit(20)->render(); ?>
        </div>
        <script>
            $(document).ready(function () {
                $(".fancybox").fancybox();
            });
        </script>
        <?PHP
    }

}
