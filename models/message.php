<?php


class Message extends Model {

    public function save($data, $id=null){
        if (!isset($data['name']) || !isset($data['email']) || !isset($data['message'])){
            return 0;
        }
        $id = (int)$id;
        $name = $this->database->escape($data['name']);
        $email = $this->database->escape($data['email']);
        $message = $this->database->escape($data['message']);

        if(!$id){ //add new record ro db
            $sql = "insert into messages 
                      set name = '{$name}',
                          email = '{$email}',
                          message = '{$message}'";
        }
        else { //update data in db
            $sql = "update messages 
                      set name = '{$name}',
                          email = '{$email}',
                          message = '{$message}'
                          where id='{$id}'";
        }
        return $this->database->query($sql);
    }

    public function getList(){
        $sql = "select * from messages where 1";
        return $this->database->query($sql);
    }
}