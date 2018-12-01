<?php

class ContactsController extends Controller {

    public function __construct(array $data = array())
    {
        parent::__construct($data);
        $this->model = new Message();
    }

    public function index(){
       if($_POST){
           if($this->model->save($_POST)){
               Session::setFlash("your message was saved succesfully");
           }
       }
    }
}