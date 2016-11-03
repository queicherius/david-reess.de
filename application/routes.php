<?php

/**
 * In this file you define all of your applications routes
 */

// Add a simple route with closure
NanoMVC\Router::route('/', function () {

	$parser = new JsonParser;

	$projects = $parser->get('projects');
	$portfolio = $parser->get('portfolio');

    return array('index', array('projects' => $projects, 'portfolio' => $portfolio));

});

NanoMVC\Router::route('/impressum', function () {

    return array('impressum');

});