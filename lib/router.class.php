<?php
/**
 * Route actions
 */

class Router
{
    protected $uri;

    protected $controller;

    protected $action;

    protected $params;

    protected $route;

    protected $method_prefix;

    protected $language;

    public function __construct($uri) //parse url
    {
        $this->uri = urldecode(trim($uri,'/')); //очищаем от слешей и обрабатвываем urldecode, чтобы норм парсить
        //дефолтные херни тянем
        $routes = Config::get('routes');
        $this->route = Config::get('default_route');
        $this->method_prefix = isset($routes[$this->route]) ? $routes[$this->route] : '';
        $this->language = Config::get('default_language');
        $this->controller = Config::get('default_controller');
        $this->action = Config::get('default_action');

        $uri_parts = explode('?', $this->uri); //разделяем uri, убираем знак вопроса и GET параметров

        //path like /lng/controller/action/param1/param2/../..
        //make string to array
        $path = $uri_parts[0];

        $path_parts = explode('/',$path);

        //echo "<pre>"; print_r($path_parts);
        //parse array

        if(count($path_parts)){ //check if it is not empty
            //get route or language
            if (in_array(strtolower(current($path_parts)),array_keys($routes))){  //check is element content route
                $this->route = strtolower(current($path_parts)); //rewrite current route instead default
                $this->method_prefix = isset($routes[$this->route]) ? $routes[$this->route] : ''; // rewrite method_prefix
                array_shift($path_parts); // remove current element from path_array
            }elseif(in_array(strtolower(current($path_parts)),Config::get('languages'))){ //if there is language
                $this->language = strtolower(current($path_parts)); //rewrite current language instead default
                array_shift($path_parts); // remove element from array
            }
            //get controller, because next element only controller
            if (current($path_parts)){
                $this->controller = strtolower(current($path_parts));
                array_shift($path_parts);
            }
            //get action
            if (current($path_parts)){
                $this->action = strtolower(current($path_parts));
                array_shift($path_parts);
            }
            //get params
            $this->params = $path_parts;

        }
    }

    /**
     * @return mixed
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @return mixed
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @return mixed
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @return mixed
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * @return mixed
     */
    public function getMethodPrefix()
    {
        return $this->method_prefix;
    }

    /**
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->language;
    }

    public static function redirect($location){
        header("Location: $location");
    }
}