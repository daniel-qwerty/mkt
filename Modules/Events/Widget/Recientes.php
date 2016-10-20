<?php

class Events_Widget_Recientes extends Com_Object {

    private $lan;
    private $limit;
    private $category;

    /**
     *
     * @return Events_Widget_Recientes
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
        $list = Events_Model_Event::getInstance()->getListRecientes($this->lan->LanId, $this->limit);
        ?>

        <?php foreach ($list as $new): ?>
            <div class="col-md-6 notas-item">
                <div class="square"
                     style="background-image: linear-gradient(to bottom, rgba(6,5,244,0.6) 0%,rgba(6,5,244,0.6) 100%) , url(<?= Com_Helper_Url::getInstance()->getUploads(); ?>/Image/<?PHP echo $new->EveImage; ?>);background-size:cover ">
                    <div class="pull-bottom">
                        <a href="<?PHP echo Com_Helper_Url::getInstance()->generateUrl($this->lan->LanCode, "events/" . $new->EveCatId); ?>" class="tag bg-note-green"><?= CatEvents_Helper_Category::getInstance()->getId($this->lan, $new->EveCatId)->CatName; ?></a>
                        <h3><a href="<?PHP echo Com_Helper_Url::getInstance()->generateUrl($this->lan->LanCode, "item/" . $new->EveId); ?>"><?PHP echo $new->EveTitle; ?></a></h3>
                        <span><i style="margin-right: 5px" class="fa fa-user"></i><?= $new->EveDate; ?></span>                                
                    </div>
                </div>
            </div>
        <?php endforeach; ?>



        <?php
    }

}
