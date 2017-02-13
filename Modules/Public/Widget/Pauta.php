<?php

class Public_Widget_Pauta extends Com_Object
{

    public $lan;

    /**
     *
     * @static
     * @access public
     * @return Public_Widget_Pauta
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
        <div class="sidebar-module module-pauta text-left hidden-xs hidden-sm">

            <div class="pauta-container">
                <div class="pauta-item m_amarillo">
                    <h3>Bookmall</h3>
                    <a href="#" class="tag m_naranja">Revista</a>
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
    
    public function renderVerde()
    {
        ?>
        <div class="sidebar-module module-pauta text-left">

            <div class="pauta-container">
                
                <div class="pauta-item m_verde">
                    <h3>Pauta</h3>
                    <a href="#" class="tag m_naranja">Revista</a>
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
    
    public function renderAzul()
    {
        ?>
        <div class="sidebar-module module-pauta text-left">

            <div class="pauta-container">
                
                <div class="pauta-item m_azul">
                    <h3>Evento</h3>
                    <a href="#" class="tag m_naranja">Revista</a>
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
