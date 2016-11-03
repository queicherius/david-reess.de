<?php

// Define path to application directory
define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));


// Define the application enviroment
if (getenv('APPLICATION_ENVIROMENT') == 'production') {
    define('APPLICATION_ENV', 'production');
} else {
    define('APPLICATION_ENV', 'development');
}

// Set the include paths
$rootDir = dirname(dirname(__FILE__));
define('ROOT_DIR', $rootDir);

$include_paths = array(
        get_include_path(),
        ROOT_DIR . '/library',
        ROOT_DIR . '/../framework',
        ROOT_DIR . '/application/modules/default/'
        #  ,ROOT_DIR . '/application/modules/admin/
);

set_include_path(implode(PATH_SEPARATOR, $include_paths));

// Add the framework namespaces
require_once 'Zend/Loader/Autoloader.php';
$autoloader = Zend_Loader_Autoloader::getInstance();
$autoloader->registerNamespace('Ice_');
$autoloader->registerNamespace('Project_');

// Create application, bootstrap, and run
require_once 'Zend/Application.php';
$application = new Zend_Application(APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini');

$application->bootstrap()->run();