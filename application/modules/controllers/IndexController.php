<?php


class IndexController extends Ice_Controller_Action {

    public function init() {

    }

    public function indexAction() {

        $article_model = new Model_Article;
        $this->view->articles = $article_model->getArticles();

    }

    public function tagAction(){

        $tag = $this->getRequest()->getParam('tag');

        $this->_helper->viewRenderer('index');

        $article_model = new Model_Article;
        $this->view->articles = $article_model->getArticles($tag);


    }

    public function impressumAction(){

    }

}
