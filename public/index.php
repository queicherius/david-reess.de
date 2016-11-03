<?php

// Include NanoMVC
require_once "../vendor/NanoMVC.php";

NanoMVC\Autoloader::init();

// Add routes
require_once '../application/routes.php';

// Run the application
NanoMVC\Application::run();