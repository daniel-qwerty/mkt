<?php

class SlideShowsPauta_Widget_Slideshow extends Com_Object {

    private $lan;
    
    

   /**
     *
     * @static
     * @access public
     * @return SlideShowsPauta_Widget_Slideshow 
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    public function setLan($lan) {
        $this->lan = $lan;
        return $this;
    }
    

    public function render() {

        $list = SlideShowsPauta_Model_SlideShow::getInstance()->getListEnable($this->lan->LanId);
        
        foreach ($list as $slide) {
         
            ?>

            <div data-slide-bg="<?= Com_Helper_Url::getInstance()->getUploads(); ?>/Image/<?php echo $slide->SliImage; ?>" class="swiper-slide" data-swiper-slide-index="2"
                 style=" background-image: url(<?= Com_Helper_Url::getInstance()->getUploads(); ?>/Image/<?php echo $slide->SliImage; ?>); background-size: cover;">
                <div class="swiper-slide-caption">
                    <div class="jubotron-variant-1">
                        <div data-caption-animate="fadeInUp" class="post-meta not-animated">
                            <p>
                                <time datetime="2016"><a target="_blank" href="<?PHP echo $slide->SliLink;?>"> april 05, 2016</a></time>
                            </p>
                        </div>
                        <h1 data-caption-animate="fadeInUp" data-caption-delay="400" class="not-animated"><a
                                target="_blank" href="<?PHP echo $slide->SliLink;?>"><?PHP echo $slide->SliTitle;?></a></h1><a
                            target="_blank" href="<?PHP echo $slide->SliLink;?>" data-caption-animate="fadeInUp" data-caption-delay="800"
                            class="btn btn-transparent btn-lg not-animated">Read more</a>
                    </div>
                </div>
            </div>
           
            <?PHP
        }
    }

}
