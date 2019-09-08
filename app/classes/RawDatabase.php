<?php
/**
 * Created by PhpStorm.
 * User: dipsn
 * Date: 16/03/2019
 * Time: 21:57
 */

namespace App\classes;
class RawDatabase
{

    protected $connection;

    public function __construct()
    {

        $this->connection = mysqli_connect(
            getenv('DB_HOST'),
            getenv('DB_USERNAME'),
            getenv('DB_PASSWORD'),
            getenv('DB_NAME')
        );

    }

    public function getConnection(){
        return $this->connection;
    }


    public function insert($data = []){



    }










}