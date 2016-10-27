<?php

class Routes_Books extends Com_Application_Route {

    public $pattern = "/^(\w+|-)+\/listbooks/";
    public $result = "_0_/Index/Books/Lista/";
}
