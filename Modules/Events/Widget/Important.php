<?php

class Events_Widget_Important extends Com_Object {

    private $lan;
    private $limit;

    /**
     *
     * @return Events_Widget_Important
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
        $list = Events_Model_Event::getInstance()->getImportant($this->lan->LanId, $this->limit);
        foreach ($list as $new) {
      
            ?>

            <div class="square"
                     style="background-image: linear-gradient(to bottom, rgba(204,54,247, 0.60) 0%,rgba(204,54,247,0.6) 100%) , url(<?= Com_Helper_Url::getInstance()->getUploads(); ?>/Image/<?PHP echo $new->EveImage; ?>);background-size:cover ">
                    <div class="pull-bottom">
                        <a href="<?PHP echo Com_Helper_Url::getInstance()->generateUrl($this->lan->LanCode, "events/" . $new->EveCatId); ?>" class="tag bg-note-pink"><?= CatEvents_Helper_Category::getInstance()->getId($this->lan, $new->EveCatId)->CatName; ?></a>
                        <h3><a href="<?PHP echo Com_Helper_Url::getInstance()->generateUrl($this->lan->LanCode, "item/" . $new->EveId); ?>"><?PHP echo $new->EveTitle; ?></a></h3>                      
                        <span><i style="margin-right: 5px" class="fa fa-calendar"></i><?= $new->EveDate; ?></span>
                    </div>
                </div>

        <?php 
        
        } 
    }

}
