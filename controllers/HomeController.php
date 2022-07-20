<?php

declare(strict_types=1);

require_once 'AbstractController.php';

class HomeController extends AbstractController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(): void
    {
        /* // Appel de la sassion via une classe
        require 'lib/Session.php';
        // On appel une méthode static
        Session::start(); */
        // Redirection
        $this->redirectTo('home');
    }
}
