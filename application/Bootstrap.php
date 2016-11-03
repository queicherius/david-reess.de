<?php

class Bootstrap extends Ice_Application_Bootstrap_Bootstrap {

    public function __construct($application) {

        parent::__construct($application);

    }

    // Register the layout plugin
    public function _initPlugins() {

        require("Project/Plugins/Layout.php");
        $front = Zend_Controller_Front::getInstance();
        $front->registerPlugin(new Project_Plugin_Layout());

    }

    // Register the new routes
    public function _initRoutes() {

        $front = Zend_Controller_Front::getInstance();
        $router = $front->getRouter();

        $category_route = new Zend_Controller_Router_Route('tag/:tag', array('controller' => 'index', 'action' => 'tag'));
        $router->addRoute('tag', $category_route);

        $category_route = new Zend_Controller_Router_Route('contact', array('controller' => 'index', 'action' => 'contact'));
        $router->addRoute('contact', $category_route);

        $category_route = new Zend_Controller_Router_Route('impressum', array('controller' => 'index', 'action' => 'impressum'));
        $router->addRoute('impressum', $category_route);

        $category_route = new Zend_Controller_Router_Route('professions', array('controller' => 'index', 'action' => 'professions'));
        $router->addRoute('professions', $category_route);

    }

}

