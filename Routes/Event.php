<?php

class Routes_Event extends Com_Application_Route {

    public $pattern = "/^(\w+|-)+\/event/";
    public $result = "_0_/Index/Events/Item/";
}