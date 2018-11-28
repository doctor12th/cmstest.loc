<?php
/**
 * application class, to call methods with params
*/
class App{

    protected static $router;

    public static $database;

    /**
     * @return router
     */
    public static function getRouter()
    {
        return self::$router;
    }

    /**
     * @param $uri - url from request
     * @throws Exception
     */
    public static function run($uri)
    {
        self::$database= new Database(Config::get('host'),Config::get('user'),Config::get('password'),Config::get('db_name'));

        self::$router = new Router($uri);

        Lang::load(self::$router->getLanguage());

        $controller_class = ucfirst(self::$router->getController()).'Controller';
        $controller_method = strtolower(self::$router->getMethodPrefix().self::$router->getAction());

        //call controller
        $controller_object = new $controller_class();
        if ( method_exists($controller_object, $controller_method)) {
            $view_path = $controller_object->$controller_method();
            $view_object = new View($controller_object->getData(),$view_path);
            $content = $view_object->render();
        }else{
            throw new Exception('Method '.$controller_method .' of class '. $controller_class.' does not exist.');
        }

        $layout = self::$router->getRoute();
        $layout_path = VIEW_PATH.DS.$layout.'.html';
        $layout_view_object = new View(compact('content'),$layout_path);
        echo $layout_view_object->render();
    }

}