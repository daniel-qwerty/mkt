<?php

class Public_Widget_PostRecientes extends Com_Object {

    public $lan;

    /**
     *
     * @static
     * @access public
     * @return Public_Widget_PostRecientes
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
        <div class="sidebar-module module-post text-left">
                        <h5>Post recientes</h5>
                        <ul>
                            <li>
                                <a href="#">
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris quam ex,
                                        suscipit
                                        sollicitudin ipsum id, bibendum efficitur erat. Cras euismod, quam non vulputate
                                        semper, nunc mi accumsan sapien
                                    </p>
                                </a>
                                <span><i class="fa fa-calendar"></i> 2016-12-5</span>
                            </li>
                            <li>
                                <a href="#">
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris quam ex,
                                        suscipit
                                        sollicitudin ipsum id, bibendum efficitur erat. Cras euismod, quam non vulputate
                                        semper, nunc mi accumsan sapien
                                    </p>
                                </a>
                                <span><i class="fa fa-calendar"></i> 2016-12-5</span>
                            </li>
                            <li>
                                <a href="#">
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris quam ex,
                                        suscipit
                                        sollicitudin ipsum id, bibendum efficitur erat. Cras euismod, quam non vulputate
                                        semper, nunc mi accumsan sapien
                                    </p>
                                </a>
                                <span><i class="fa fa-calendar"></i> 2016-12-5</span>
                            </li>
                            <li>
                                <a href="#">
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris quam ex,
                                        suscipit
                                        sollicitudin ipsum id, bibendum efficitur erat. Cras euismod, quam non vulputate
                                        semper, nunc mi accumsan sapien
                                    </p>
                                </a>
                                <span><i class="fa fa-calendar"></i> 2016-12-5</span>
                            </li>
                        </ul>
                    </div>
        <?PHP
    }

}
