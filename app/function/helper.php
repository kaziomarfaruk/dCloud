<?php

require __DIR__.'/../../vendor/autoload.php';

use Philo\Blade\Blade;

function view($path,$Data = []){

    $view = __DIR__.'/../../resource/view';
    $cache = __DIR__.'/../../bootstrap/cache';

    $blade = new Blade($view,$cache);

    echo $blade->view()->make($path,$Data)->render();

}

function makemail($filename,$data=[]){
    extract($data);
    ob_start();
    include __DIR__.'/../../resource/view/email/'.$filename.'.php';
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}






