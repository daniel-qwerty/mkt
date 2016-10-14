<?php

class Public_Widget_Calendario extends Com_Object {

    public $lan;

    /**
     *
     * @static
     * @access public
     * @return Public_Widget_Calendario
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
        <div class="sidebar-module bg-gray text-left">
            <h5>Calendar</h5>
            <!-- RD Calendar-->
            <div class="rd-calendar">
                <div class="rdc-panel">
                    <div class="rdc-month"></div>
                    <div class="rdc-fullyear"></div>
                    <a class="rdc-next">
                        <i class="fa fa-arrow-right"
                           style="font-size: 16px;display: inline-block;text-align: center;vertical-align: middle;transition: .4s;"></i>
                    </a>
                    <a class="rdc-prev">
                        <i class="fa fa-arrow-left"
                           style="font-size: 16px;display: inline-block;text-align: center;vertical-align: middle;transition: .4s;"></i>
                    </a>
                </div>
                <div class="rdc-table"></div>
            </div>
        </div>
        <?PHP
    }

}
