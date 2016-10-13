<?php

class News_Widget_Important extends Com_Object
{

    private $lan;
    private $limit;

    /**
     *
     * @return News_Widget_Important
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
        $count = 0;
        $list = News_Model_New::getInstance()->getImportant($this->lan->LanId, $this->limit);
        foreach ($list as $new) {
            $count++;
            ?>

            <div class="row item-noticias <?= ($count == 1) ? 'active' : '' ?> bg-white"
                 rel="<?PHP echo $new->NewId; ?>">
                <div class="col-lg-12">
                    <span class="date"><?PHP echo $new->NewDate; ?></span>

                    <h2><?PHP echo $new->NewTitle; ?></h2>
                    <a href="<?PHP echo Com_Helper_Url::getInstance()->generateUrl($this->lan->LanCode, "news/article/" . $new->NewId); ?>">
                        <img  style="width: 100%; height: auto" src="<?= Com_Helper_Url::getInstance()->getImage(); ?>/Public/ic_go.png" alt=""/>
                    </a>
                </div>
                <div class="col-lg-6 p-image">
                    <img src="<?= Com_Helper_Url::getInstance()->getUploads(); ?>/Image/<?PHP echo $new->NewImage; ?>"
                         alt=""/>
                </div>
                <div class="col-lg-6 p-content">

                    <div class="">
                        <p><?PHP echo $new->NewContent; ?></p>

                    </div>

                </div>
            </div>

        <?php } ?>

    <?PHP
    }

}
