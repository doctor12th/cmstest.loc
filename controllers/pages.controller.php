<?php
/**
 * Default controller, extended from main Controller
 * Контроллер формирует данные для передачи в представление. Ни контроллер, ни модель ничего не показывают, то есть
 * не передают html
 *
 * Для каждого контроллера создается папка со страницами, и в контролере создается инормация для представлений.
 * Каждый контроллер должен иметь те же самые методы, что и названия представлений в соответсвующей папке.
 *
 *
 */
class PagesController extends Controller {

    public function __construct($data = array())
    {
        parent::__construct($data);
        $this->model = new Page();
    }

    public function index(){
        $this->data['pages'] = $this->model->getList();//доступ соверщается по ключу
    }

    public function view(){
        $params = App::getRouter()->getParams();

        if(isset($params[0])){

            $alias = strtolower($params[0]);
            $this->data['page']=$this->model->getByAlias($alias);
        }
    }

    public function admin_index(){
        $this->data['pages']=$this->model->getList();
    }

    public function admin_edit(){
        if (isset($this->params[0])){
            $this->data['page'] = $this->model->getById($this->params[0]);
        }else{
            Session::setFlash('Wrong page id');
            Router::redirect("/admin/pages/");
        }
    }
}