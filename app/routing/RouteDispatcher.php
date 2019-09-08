<?php

/**
 * Created by PhpStorm.
 * User: dips1337x
 * Date: 25/11/2018
 * Time: 13:46
 */

namespace App;

use AltoRouter;

class RouteDispatcher{

    protected $match;
    protected $controller;
    protected $method;

    function __construct(AltoRouter $router){

        $this->match = $router->match();

        if($this->match){

            list($controller,$method) = explode('#',$this->match['target']);
            $this->controller = $controller;
            $this->method = $method;

            if(is_callable([new $this->controller,$this->method])){
                call_user_func([new $this->controller,$this->method],[$this->match['params']]);
            }
            else{
                view('errors/404');
            }

        }else{
            view('errors/404');
        }



    }
}