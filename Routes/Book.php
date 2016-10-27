<?php

class Routes_Book extends Com_Application_Route {

    public $pattern = "/^(\w+|-)+\/book/";
    public $result = "_0_/Index/Books/Item/";
}