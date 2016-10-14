<?php

class Routes_Post extends Com_Application_Route {

    public $pattern = "/^(\w+|-)+\/post/";
    public $result = "_0_/Index/Notes/Post/";
}