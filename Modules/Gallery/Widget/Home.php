<?php

class Gallery_Widget_Home extends Com_Object
{

    private $lan;
    private $limit;


    /**
     *
     * @return Gallery_Widget_Home
     */
    public static function getInstance()
    {
        return self::_getInstance(__CLASS__);
    }

    public function setLan($lan)
    {
        $this->lan = $lan;
        return $this;
    }

    public function setLimit($limit)
    {
        $this->limit = $limit;
        return $this;
    }


    public function render()
    {

        $list = Gallery_Model_Gallery::getInstance()->getList($this->lan->LanId, $this->limit);
        foreach ($list as $new) {
            ?>
            <div data-instafeed-item="" class="owl-item insta-item">
                <a href="<?= Com_Helper_Url::getInstance()->getUploads(); ?>/Image/<?PHP echo $new->GalFile; ?>"
                   rel="group" <?= !empty($new->GalName) ? 'title="' . $new->GalName . '"' : "" ?>
                   class="img-thumbnail-variant-3 fancybox">
                    <div class="square"
                         style="background: url(<?= Com_Helper_Url::getInstance()->getUploads(); ?>/Image/<?PHP echo $new->GalFile; ?>); background-size: cover">
                    </div>
                </a>
            </div>
        <?php } ?>

        <?PHP
    }

}
