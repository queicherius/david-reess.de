<?php

class Project_Plugin_Layout extends Zend_Controller_Plugin_Abstract {

    public function preDispatch(Zend_Controller_Request_Abstract $request) {

        // Get the Layout and the View
        $layout = Zend_Layout::getMvcInstance();
        $view = $layout->getView();

        // Set the head title
        $view->headTitle(translate('APPLICATION_NAME'), 'SET');
        $view->headTitle()->setSeparator(' | ');

        // Set the default layout
        $layout_switch = "application";
        $layout->setLayout($layout_switch);

    }
}
