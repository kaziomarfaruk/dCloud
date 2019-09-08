<?php

define('BASEPATH',realpath(__DIR__.'/../../'));

require_once BASEPATH.'/vendor/autoload.php';

$dotEnv = new \Dotenv\Dotenv(BASEPATH);

$dotEnv->load();










