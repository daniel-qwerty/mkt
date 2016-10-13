<?php

class Categories_Widget_CategoriesImportant extends Com_Object {

    private $lan;
    private $type;
    private $limit;

    /**
     *
     * @static
     * @access public
     * @return Categories_Widget_CategoriesImportant
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    public function setType($id) {
        $this->type = $id;
        return $this;
    }
    
    public function setLimit($id) {
        $this->limit = $id;
        return $this;
    }

    public function setLan($lan) {
        $this->lan = $lan;
        return $this;
    }

    /**
     * @access public
     */
    public function render() {

        $list = Categories_Model_Category::getInstance()->getImportant($this->lan->LanId, $this->type, $this->limit);
       
        foreach ($list as $item){
            if ($item->CatImportant == 1) { ?>
               
                        <div class="post-news height-520 bg-item-5 post-news-mod-1 bg-primary"
                             style="background: url(<?= Com_Helper_Url::getInstance()->getUploads(); ?>/Image/<?= $item->CatImage?>); background-size: cover">
                            <div class="post-body">
                                <h4><a href="blog_post.html"><?= $item->CatAlias?></a></h4>

                                <p><?= $item->CatDescription?></p>
                            </div>
                            <div class="post-footer">
                                <span class="post-count">27 posts</span>
                                <a href="blog_post.html" class="btn btn-transparent">
                                    <i class="fa fa-arrow-right"
                                       style="font-size: 24px;display: inline-block;text-align: center;vertical-align: middle;transition: .4s;padding-top: 5px;"></i>
                                </a>
                            </div>
                        </div>
              
                
            <?php
            }  

            
        }
       
    }
}
?>
