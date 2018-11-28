<?php

class ContactsController extends Controller {

    public function index(){
        $this->data['test_content'] = "О нас";//доступ соверщается по ключу
    }
}