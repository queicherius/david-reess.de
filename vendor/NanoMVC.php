<?php

namespace NanoMVC;

/**
 * This class is used to autoload the user models
 *
 * Class Autoloader
 * @package NanoMVC
 */
class Autoloader
{

    /**
     * @var string The directory the models are in
     */
    public static $model_directory = 'models';
    /**
     * @var string The directory the controllers are in
     */
    public static $controller_directory = 'controllers';

    /**
     * Registers the classes autoloaders
     */
    public static function init()
    {
        spl_autoload_register('NanoMVC\Autoloader::autoloadModel');
        spl_autoload_register('NanoMVC\Autoloader::autoloadController');
    }

    /**
     * Loads a model
     *
     * @param string $model_name The model to load
     */
    public static function autoloadModel($model_name)
    {
        self::load(self::$model_directory, $model_name);
    }

    /**
     * Loads a controller
     *
     * @param string $controller_name The controller to load
     */
    public static function autoloadController($controller_name)
    {
        self::load(self::$controller_directory, $controller_name);
    }

    /**
     * Loads a class out of a specific directory
     *
     * @param string $directory  The directory in which the class has to be
     * @param string $class_name The class to load
     */
    public static function load($directory, $class_name)
    {

        // Every namespace is handled as a directory
        $model_name = str_replace('\\', DIRECTORY_SEPARATOR, $class_name);

        $file = '..' . DIRECTORY_SEPARATOR . 'application' . DIRECTORY_SEPARATOR . $directory . DIRECTORY_SEPARATOR . $model_name . '.php';

        if (is_file($file)) {
            include $file;
        }

    }

}

/**
 * This class is used to route the user request
 *
 * Class Router
 * @package NanoMVC
 */
class Router
{

    /**
     * @var Router The instance of the object
     */
    protected static $instance;
    /**
     * @var array The registered routes
     */
    private $routes;

    /**
     * Static wrapper for adding a route
     *
     * @param string          $route        The route on which the closure function or controller should trigger.
     *                                      You are allowed to use regex here, the matches in brackets will be
     *                                      the parameters for the function
     * @param callable|string $callback     The closure function for the route, or a controller in the form
     *                                      controllername@methodname
     */
    public static function route($route, $callback)
    {
        self::getInstance()->_route($route, $callback);
    }

    /**
     * Adds a route
     *
     * @param string          $route        The route on which the closure function or controller should trigger.
     *                                      You are allowed to use regex here, the matches in brackets will be
     *                                      the parameters for the function
     * @param callable|string $callback     The closure function for the route, or a controller in the form
     *                                      controllername@methodname
     */
    private function _route($route, $callback)
    {
        $this->routes[] = array($route, $callback);
    }

    /**
     * Returns a instance of itself
     *
     * @return Router Instance of itself
     */
    public static function getInstance()
    {
        return (self::$instance) ? self::$instance : self::$instance = new self;
    }

    /**
     * Executes the current route
     *
     * @return array|bool The current route with callback and parameters or false, if no route was found
     */
    public function execute()
    {
        $route = $this->getCurrentRoute();

        foreach ($this->routes as $route_array) {
            if (preg_match('#^' . $route_array[0] . '$#', $route, $matches)) {

                // Delete the first element of the array, as it is the complete request
                if ($matches) {
                    array_shift($matches);
                }

                return array('callback' => $route_array[1], 'parameters' => $matches);
            }
        }

        $this->routeNotFound();

        return false;
    }

    /**
     * Gets the current route
     *
     * @return string The current route
     */
    private function getCurrentRoute()
    {

        // Remove script directory
        $script_directory = str_ireplace('/index.php', '', $_SERVER['SCRIPT_NAME']);
        $route = str_ireplace($script_directory, '', $_SERVER['REQUEST_URI']);

        // Remove query string
        return substr($route, 0, (strpos($route, '?') == false) ? strlen($route) : strpos($route, '?'));

    }

    /**
     * Renders the 404 Page
     */
    private function routeNotFound()
    {
        header("HTTP/1.0 404 Not Found");
        die("Error 404 - Page not found");
    }

}

/**
 * This class is used to execute everything else
 *
 * Class Application
 * @package NanoMVC
 */
class Application
{

    /**
     * @var string The directory the views are in
     */
    public static $view_directory = 'views';

    /**
     * Gets the route, executes the callback and renders the view
     */
    public static function run()
    {

        $route = Router::getInstance()->execute();

        if ($route['callback'] instanceof \Closure) {
            // The route has a closure
            $view = call_user_func_array($route['callback'], $route['parameters']);
        } else {
            // The route has a controller
            $route['callback'] = explode('@', $route['callback']);
            $controller = new $route['callback'][0];
            $view = call_user_func_array(array($controller, $route['callback'][1]), $route['parameters']);
        }

        // Render the view
        if ($view) {
            $variables = isset($view[1]) ? $view[1] : false;
            self::view($view[0], $variables);
        }

    }

    /**
     * Distributes the variables to the view and renders it
     *
     * @param string     $name      The name of the view, as in views/{filename}.phtml
     * @param array|bool $variables The variables distributed to the view as key=>value
     */
    public static function view($name, $variables)
    {

        if ($variables) {
            foreach ($variables as $key => $value) {
                $$key = $value;
            }
        }

        include '..' . DIRECTORY_SEPARATOR . 'application' . DIRECTORY_SEPARATOR . self::$view_directory . DIRECTORY_SEPARATOR . $name . '.phtml';

    }

}