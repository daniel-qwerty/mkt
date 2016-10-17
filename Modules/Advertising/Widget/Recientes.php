<?php

class Notes_Widget_Recientes extends Com_Object {

    private $lan;
    private $limit;
    private $category;

    /**
     *
     * @return Notes_Widget_Recientes 
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

        $list = Notes_Model_Note::getInstance()->getListRecientes($this->lan->LanId, $this->limit);
        foreach ($list as $new) {
            ?>
            <div class="owl-item">
                <div class="post-news height-480"
                     style="background: url(<?= Com_Helper_Url::getInstance()->getUploads(); ?>/Image/<?PHP echo $new->NotImage; ?>);background-size: cover; ">
                    <div class="post-header"><a href="blog_post.html" class="tag bg-razzmatazz"><?= Categories_Helper_Category::getInstance()->getId($this->lan, $new->NotCatId)->CatAlias; ?></a></div>
                    <div class="post-body">
                        <h4><a href="blog_post.html"><?PHP echo $new->NotTitle; ?></a></h4>

                        <p></p>
                    </div>
                    <div class="post-footer post-meta"><a href="blog_post.html">
                            <time datetime="2015"><?PHP echo $new->NotDate; ?></time>
                        </a><a href="blog_post.html" class="btn btn-transparent">read more</a></div>
                </div>
            </div>
            <?php
        }
    }
    public function render2() {

        $list = Notes_Model_Note::getInstance()->getListRecientes($this->lan->LanId, $this->limit);
        foreach ($list as $new) {
            ?>
            <div class="owl-item">
                <div class="post-news height-260"
                     style="background: url(<?= Com_Helper_Url::getInstance()->getUploads(); ?>/Image/<?PHP echo $new->NotImage; ?>);background-size: cover; ">
                    <div class="post-header"><a href="blog_post.html" class="tag bg-razzmatazz"><?= Categories_Helper_Category::getInstance()->getId($this->lan, $new->NotCatId)->CatAlias; ?></a></div>
                    <div class="post-body">
                        <h4><a href="blog_post.html"><?PHP echo $new->NotTitle; ?></a></h4>

                        <p></p>
                    </div>
                    <div class="post-footer post-meta"><a href="blog_post.html">
                            <time datetime="2015"><?PHP echo $new->NotDate; ?></time>
                        </a><a href="blog_post.html" class="btn btn-transparent">read more</a></div>
                </div>
            </div>
            <?php
        }
    }

}
