<?php

class News_Widget_News extends Com_Object {

    private $lan;
    private $limit;
    private $category;

    /**
     *
     * @return News_Widget_News 
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
    
    public function setCategory($category) {
        $this->category = $category;
        return $this;
    }

    public function render() {

        $list = News_Model_New::getInstance()->getList($this->lan->LanId, $this->limit, $this->category);
        foreach ($list as $new) {
            ?>
            <div class="news-item bg-color-5">
                <a href="<?PHP echo Com_Helper_Url::getInstance()->generateUrl($this->lan->LanCode, "news/article/" . $new->NewId); ?>" class="bg-color-6">
                    <img src="<?= Com_Helper_Url::getInstance()->getUploads(); ?>/Image/<?PHP echo $new->NewImage; ?>" alt=""/>

                    <h2 class="color-2"><?PHP echo $new->NewTitle; ?></h2>                  
                    <p class="p-content"><?PHP echo $new->NewDescription;?></p>
                </a>
            </div>
            <?php
        }
    }

}
