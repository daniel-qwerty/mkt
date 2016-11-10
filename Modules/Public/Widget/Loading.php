<?php

class Public_Widget_Loading extends Com_Object {

    public $lan;

    /**
     *
     * @static
     * @access public
     * @return Public_Widget_Loading
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
        <style>
            body {
                padding: 0;
                margin: 0
            }

            #preload {
                position: fixed;
                top:0;
                width: 100%;
                height: 100vh;
                z-index: 9000;
                background: white;
            }

            #preloader {
                position: absolute;
                left: 50%;
                top: 50%;
                transform: translate(-50%, -50%);
            }

            .preloader-item {
                width: 80px;
                height: 80px;
                margin: 10px;
                background: #CCCCCC;
                border-radius: 10px;
                float: left;
                display: block;
            }

            .preloader-item1 {
                animation-name: pulse;
                animation-duration: 1.5s;
                animation-delay: 0.3s;
                animation-iteration-count: infinite;
            }

            .preloader-item2 {
                animation-name: pulse;
                animation-duration: 1.5s;
                animation-delay: 0.6s;
                animation-iteration-count: infinite;
            }

            .preloader-item3 {
                animation-name: pulse;
                animation-duration: 1.5s;
                animation-delay: 0.9s;
                animation-iteration-count: infinite;
            }

            @keyframes pulse {
                0% {
                    background-color: #941b80;
                }
                33% {
                    background-color: #e5007e;
                }
                66% {
                    background-color: #e20613;
                }
                100% {
                    background-color: #941b80;
                }
            }
        </style>
        <?PHP

    }

}
