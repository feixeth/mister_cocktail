<?php

require_once 'lib/Router.php';
// Appel de la sassion via une classe
require 'lib/Session.php';

// On appel une méthode static
Session::start();

// Ici on récupère le paramètre GET dans la méthode handleRequest
// Ce paramètre GET['page'] s'il existe, nous aidera à instancier le bon controlleur
// ainsi que la bonne méthode d'action

// instance
$router = new Router;
// Check Route
$router->handleRequest();
