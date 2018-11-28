<?php

class Database{

    protected $connection;


    public function __construct($host,$user,$pass,$db_name){
        $this->connection=new mysqli($host,$user,$pass,$db_name);

        if(mysqli_connect_error()){
            throw new Exception('Connection is interrupt.');
        }
    }

    public function query($sql){
        if(!$this->connection){
          return 0;
        }
        $result = $this->connection->query($sql);

        if(mysqli_error($this->connection)){
            throw new Exception(mysqli_error($this->connection));
        }

        if(is_bool($result)){
            return $result;
        }

        $data = array();
        while ($row = mysqli_fetch_assoc($result)){
            $data[]=$row;
        }

        return $data;

    }

    public function escape($str){ //protect from sql injection
        return mysqli_escape_string($this->connection,$str);
    }
}