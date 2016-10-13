<?php

class Public_Widget_Pauta extends Com_Object {

    public $lan;

    /**
     *
     * @static
     * @access public
     * @return Public_Widget_Pauta
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    public function setLan($lan) {
        $this->lan = $lan;
        return $this;
    }

    public function render() {
        ?>
        <div class="sidebar-module module-pauta text-left">
            <h3>Pauta</h3>
            <div class="pauta-container">
                <div class="pauta-item">
                    <a href="#" class="tag bg-pink">Revista</a>
                    <h4>Titulo lorem ipsum</h4>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed blandit din dignissim.
                        Pellee habitant morbi trisque Lorem ipsum dolor sit amet, consectetur adipiscing
                        elit. Sed blandit din dignissim. Pellee habitant morbi trisque...
                    </p>
                </div>
                <div class="pauta-item">
                    <a href="#" class="tag bg-punch">WEB</a>
                    <h4>Titulo lorem ipsum</h4>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed blandit din dignissim.
                        Pellee habitant morbi trisque Lorem ipsum dolor sit amet, consectetur adipiscing
                        elit. Sed blandit din dignissim. Pellee habitant morbi trisque...
                    </p>
                </div>
                <div class="pauta-item">
                    <a href="#" class="tag bg-info">Revista</a>
                    <h4>Titulo lorem ipsum</h4>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed blandit din dignissim.
                        Pellee habitant morbi trisque Lorem ipsum dolor sit amet, consectetur adipiscing
                        elit. Sed blandit din dignissim. Pellee habitant morbi trisque...
                    </p>
                </div>
            </div>
        </div>
        <?PHP
    }

}
