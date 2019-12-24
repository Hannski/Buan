<?php
class App
{

 	function __construct()
    {
        $router = new Router();
        $router->resolveUrl();

    }
}
