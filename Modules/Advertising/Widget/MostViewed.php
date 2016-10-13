<?php

class Notes_Widget_MostViewed extends Com_Object {

    private $lan;
    private $limit;

    /**
     *
     * @return Notes_Widget_MostViewed
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
        $count = 0;
        $list = Notes_Model_Note::getInstance()->getMostViewd($this->lan->LanId, $this->limit);
        foreach ($list as $new) {
            ?>

            <div class="col-xs-12 col-sm-6">
                <div class="post-news height-390 post-news-mod-2"
                     style="background-image: url(<?= Com_Helper_Url::getInstance()->getUploads(); ?>/Image/<?PHP echo $new->NotImage; ?>);background-size: cover;">
                    <div class="post-header"><a href="blog_post.html" class="tag bg-razzmatazz"><?= Categories_Helper_Category::getInstance()->getId($this->lan, $new->NotCatId)->CatAlias; ?></a></div>
                    <div class="post-body"><a href="blog_post.html" class="h5"><?= $new->NotTitle;?></a>

                        <p><?= $new->NotResume;?></p>
                    </div>
                    <div class="post-footer">
                        <div class="post-meta"><a href="blog_post.html">
                                <time datetime="2015"><?= $new->NotDate;?></time>
                            </a><a href="blog_post.html" class="post-comment">27</a></div>
                        <a href="blog_post.html" class="btn btn-transparent">
                            <i class="fa fa-arrow-right"
                               style="font-size: 24px;display: inline-block;text-align: center;vertical-align: middle;transition: .4s;padding-top: 5px;"></i>
                            <span>read more</span>
                        </a>
                    </div>
                </div>
            </div>

            <?php
        }
    }

}
