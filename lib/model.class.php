<?php

class Model{
    protected $database;

    public function __construct()
    {
        $this->database = App::$database;
    }
}