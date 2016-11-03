<?php

class ErrorController extends Ice_Controller_Action {

    public function init() {
        $this->view->headTitle()->prepend(translate('ERROR_TITLE'));

        $layout = Zend_Layout::getMvcInstance();
        $layout->setLayout('error');
    }

    public function errorAction() {

        $errors = $this->_getParam('error_handler');

        if (!$errors || !$errors instanceof ArrayObject) {
            $this->view->message = translate('ERROR_MESSAGE');
            return;
        }

        if($errors->type == 'EXCEPTION_OTHER'){
            if(isset($errors->exception->type)){
                $errors->type = $errors->exception->type;
            }
        }

        switch ($errors->type) {
            case 'EXCEPTION_404':
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ROUTE:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION:
            // 404 error -- controller or action not found
                $this->getResponse()->setHttpResponseCode(404);
                $this->view->message = 'ERROR_PAGE_NOT_FOUND';
                break;
            default:
            // application error
                $this->getResponse()->setHttpResponseCode(500);
                $this->view->message = 'ERROR_APPLICATION_ERROR';
                break;
        }

        // Log exception
        Ice_Debug::f()->log($this->view->message, $errors->exception, $errors->request->getRequestUri());

        // conditionally display exceptions
        if ($this->getInvokeArg('displayExceptions') == true) {
            $this->view->exception = $errors->exception;
        }

        $this->view->request = $errors->request;
    }

}

