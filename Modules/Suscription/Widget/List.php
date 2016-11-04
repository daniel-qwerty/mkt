<?php

class Suscription_Widget_List extends Com_Object {

    private $lan;

    /**
     *
     * @static
     * @access public
     * @return Suscription_Widget_List 
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    public function setLan($lan) {
        $this->lan = $lan;
        return $this;
    }

    public function render() {

        $list = Suscription_Model_Suscription::getInstance()->getList2($this->lan->LanId);

        foreach ($list as $slide) {
            ?>

            <div data-instafeed-item="" class="owl-item item-suscription">
                <div class="square"
                     style="background: url(<?= Com_Helper_Url::getInstance()->getUploads(); ?>/Image/<?php echo $slide->SusImage; ?>); background-size: cover ">
                </div>
                <div class="item-suscription-title" style="background: <?php echo $slide->SusColor; ?>" >
                    <a href="#"><?php echo $slide->SusTitle; ?></a>
                </div>
                <div class="item-suscription-comprar">
                    <a href="#" class="btn btn-default btn-sm pull-right "><?= Texts_Helper_Text::getInstance()->get($this->lan, "txtComprar")->TxtDescription ?></a>
                </div>
            </div>

            <?PHP
        }
    }

}
