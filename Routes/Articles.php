<?php

class Routes_Articles extends Com_Application_Route {

    public $pattern = "/^(\w+|-)+\/articles/";
    public $result = "_0_/Index/Notes/Articles/";
}