<?php

class Routes_EventDate extends Com_Application_Route {

    public $pattern = "/^(\w+|-)+\/date/";
    public $result = "_0_/Index/Events/Date/";

}
