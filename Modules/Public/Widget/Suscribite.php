<?php

class Public_Widget_Suscribite extends Com_Object
{

    public $lan;

    /**
     *
     * @static
     * @access public
     * @return Public_Widget_Suscribite
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

    public function render()
    {
        ?>
        <div class="sidebar-module bg-gray module-suscribe-magazine text-left">
            <h5>Suscribete</h5>

            <div class="magazine-container m_purpura">
                <img src="<?PHP echo Com_Helper_Url::getInstance()->getImage(); ?>/Public/magazine01.jpg"
                     alt=""/>
            </div>
            <img style="width: 60px; margin-top: -8px;"
                 src="<?PHP echo Com_Helper_Url::getInstance()->getImage(); ?>/Public/suscribe-decor.png" alt="">
            <div class="magazine-container-decoration"></div>

            <p>Suspendisse vel aliquam est. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus pellentesque
                diam vel nunc sagittis blandit. Donec aliquam aliquam orci et bibendum. In eu lacinia felis. Morbi in elit aliquet</p>
        </div>
        <?PHP
    }

}
