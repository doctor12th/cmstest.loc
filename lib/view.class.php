<?php
/**
 * создается каждый раз когда необходимо использовать представление
 * для передачи даных и получения html
*/
class View{

    protected $data; //данные для передачи в представление, связывает между собой контроллер и представление

    protected $path; //путь к файлу представления

    /**
     * @return string default path to view
     */
    protected static function getDefaultViewPath(){ //определяем путь по умолчанию
        $router = App::getRouter();
        if(!$router){//проверка переменной, если проблемы - влепить исключение
            return 0;
        }
        $controller_dir = $router->getController();
        $template_name = $router->getMethodPrefix().$router->getAction().'.html';
        return VIEW_PATH.DS.$controller_dir.DS.$template_name;
    }

    public function __construct($data = array(), $path = null)
    {
        if (!$path){
            $path = self::getDefaultViewPath();
        }

        if (!file_exists($path)){ // проверяем наличие файла
            throw new Exception('Template not found '.$path);
        }
        $this->path = $path;
        $this->data = $data;
    }


    /**
     * @return string
     */
    public function render(){ //рендеринг шаблона
        $data = $this->data; //доступна в шаблоне

        ob_start(); //буферизация вывода. нужно чтоб подключить файл шаблона и получить готовый штмл код из буфера.
        include($this->path); //подтянем шаблон
        $content = ob_get_clean(); //выдернем буфер и вернем его, нужно для отправки страницы

        return $content;
    }

}