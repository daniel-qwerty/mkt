<?php

class Notes_Widget_Important extends Com_Object {

    private $lan;
    private $limit;

    /**
     *
     * @return Notes_Widget_Important
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
        $list = Notes_Model_Note::getInstance()->getImportant($this->lan->LanId, $this->limit);
        foreach ($list as $new) {
      
            ?>

            <div class="post-news height-780 post-news-mod-3"
                 style="background-image: url(<?= Com_Helper_Url::getInstance()->getUploads(); ?>/Image/<?PHP echo $new->NotImage; ?>);background-size: cover;">
                <div class="post-header"><a href="blog_post.html" class="tag bg-pink"><?= Categories_Helper_Category::getInstance()->getId($this->lan, $new->NotCatId)->CatAlias; ?></a></div>
                <div class="post-body"><a href="blog_post.html" class="h4"><?= $new->NotTitle;?></a>

                    <p><?= $new->NotResume;?></p>
                </div>
                <div class="post-footer">
                    <div class="post-meta"><a href="blog_post.html">
                            <time datetime="2015"><?= $new->NotDate;?></time>
                        </a><a href="blog_post.html" class="post-comment">13</a></div>
                    <a href="blog_post.html" class="btn btn-transparent">
                        <i class="fa fa-arrow-right"
                           style="font-size: 24px;display: inline-block;text-align: center;vertical-align: middle;transition: .4s;padding-top: 5px;"></i>
                        <span>read more</span>
                    </a>
                </div>
            </div>

        <?php 
        
        } 
    }

}
