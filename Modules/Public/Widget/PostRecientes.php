<?php

class Public_Widget_PostRecientes extends Com_Object {

    public $lan;
    private $limit;

    /**
     *
     * @return Public_Widget_PostRecientes
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    public function setLan($lan) {
        $this->lan = $lan;
        return $this;
    }

    public function setLimit($limit) {
        $this->limit = $limit;
        return $this;
    }

    public function render() {
      
        $list = Notes_Model_Note::getInstance()->getListRecientes($this->lan->LanId, $this->limit);
        print_r($list);
        ?>
        <div class="sidebar-module module-post text-left">
            <h5>Post recientes</h5>
            <ul>
                <?php
                foreach ($list as $new) {
                    ?>


                    <li>
                        <a href="<?PHP echo Com_Helper_Url::getInstance()->generateUrl($this->lan->LanCode, "article/" . $new->NotId); ?>">
                            <p>
            <?= $new->NotResume; ?>
                            </p>
                        </a>
                        <span><i class="fa fa-calendar"></i><?= $new->NotDate; ?></span>
                    </li>

        <?php } ?>
            </ul>
        </div>



        <?php
    }

}
