<?php

class Page extends Model{

    public function getList($only_published = false){
        $sql = "select * from pages where 1";
        if($only_published){
            $sql .= "and is_published 1";
        }
        return $this->database->query($sql);
    }

    public function getByAlias($alias){
        $alias = $this->database->escape($alias);
        $sql = "select * from pages where alias = '{$alias}' limit 1";
        $result = $this->database->query($sql);
        return isset($result[0]) ? $result[0] : null;
    }

    public function getById($id){
        $id = (int)$id;
        $sql = "select * from pages where id = '{$id}' limit 1";
        $result = $this->database->query($sql);
        return isset($result[0]) ? $result[0] : null;
    }

    public function save($data, $id=null){
        if (!isset($data['alias']) || !isset($data['title']) || !isset($data['content'])){
            return 0;
        }
        $id = (int)$id;
        $alias = $this->database->escape($data['alias']);
        $title = $this->database->escape($data['title']);
        $content = $this->database->escape($data['content']);
        $is_published = isset($data['is_published']) ? 1 : 0;

        if(!$id){ //add new record ro db
            $sql = "insert into pages
                      set alias = '{$alias}',
                          title = '{$title}',
                          content = '{$content}',
                          is_published = '{$is_published}'";
        }
        else { //update data in db
            $sql = "update pages
                      set alias = '{$alias}',
                          title = '{$title}',
                          content = '{$content}',
                          is_published = '{$is_published}'
                      where id='{$id}'";
        }
        return $this->database->query($sql);
    }

    public function delete($id){
        $sql = "delete from pages where id = {$id}";
        return $this->database->query($sql);
    }
}