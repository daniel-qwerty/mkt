<?php

class Advertising_Widget_Ad extends Com_Object
{

    private $type;
    private $limit;

    /**
     *
     * @return Advertising_Widget_Ad
     */
    public static function getInstance()
    {
        return self::_getInstance(__CLASS__);
    }

    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function setLimit($limit)
    {
        $this->limit = $limit;
        return $this;
    }

    public function renderF()
    {

        $list = Advertising_Model_Advertising::getInstance()->getAd($this->type, $this->limit);
        //print_r($list);
        foreach ($list as $new) {
            ?>

            <a href="<?= $new->AdLink; ?>" target="_blanck">
                <img src="<?= Com_Helper_Url::getInstance()->getUploads(); ?>/Image/<?PHP echo $new->AdImage; ?>"
                     style="width: 100%">
            </a>

            <?php
        }
    }
    
    public function renderI()
    {

        $list = Advertising_Model_Advertising::getInstance()->getAd($this->type, $this->limit);
        //print_r($list);
        foreach ($list as $new) {
            ?>

            <a href="<?= $new->AdLink; ?>" target="_blanck">
                <img src="<?= Com_Helper_Url::getInstance()->getUploads(); ?>/Image/<?PHP echo $new->AdImage; ?>"
                     style="width: 100%">
            </a>

            <?php
        }
    }

    public function renderC()
    {

        $list = Advertising_Model_Advertising::getInstance()->getAd($this->type, $this->limit);
        //print_r($list);
        foreach ($list as $new) {
            ?>
            <div class="banner-block">
                <a href="<?= $new->AdLink; ?>" target="_blanck">
                    <img src="<?= Com_Helper_Url::getInstance()->getUploads(); ?>/Image/<?PHP echo $new->AdImage; ?>"
                         style="width: 100%">
                </a>
            </div>
            <?php
        }
    }

    public function renderE()
    {

        $list = Advertising_Model_Advertising::getInstance()->getAd($this->type, $this->limit);
        //print_r($list);
        foreach ($list as $new) {
            ?>
            <div class="banner-block">
                <a href="<?= $new->AdLink; ?>" target="_blanck">
                    <img
                        src="<?= Com_Helper_Url::getInstance()->getUploads(); ?>/Image/<?PHP echo $new->AdImage; ?>"
                        alt="">
                </a>
            </div>

            <?php
        }
    }

    public function renderB()
    {

        $list = Advertising_Model_Advertising::getInstance()->getAd($this->type, $this->limit);
        //print_r($list);
        foreach ($list as $new) {
            ?>
            <a href="<?= $new->AdLink; ?>" target="_blanck">
                <img src="<?= Com_Helper_Url::getInstance()->getUploads(); ?>/Image/<?PHP echo $new->AdImage; ?>" alt=""
                     style="width: 100%">
            </a>
            <?php
        }
    }

}
