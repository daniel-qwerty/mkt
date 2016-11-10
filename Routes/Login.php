<?php

class Routes_Login extends Com_Application_Route {

    //public $pattern = "/^Login/";
    //public $result = "Index/Public/Login";
    
    public $pattern = "/^(\w+|-)+\/login/";
    public $result = "_0_/Index/Public/Login";

}
