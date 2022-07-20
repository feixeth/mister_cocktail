<?php

declare(strict_types=1);

require_once 'controllers/HomeController.php';
require_once 'controllers/AuthController.php';
require_once 'controllers/CocktailController.php';

class Router
{
    /**
     * Méthode de redirection vers les actions demandées
     * Via le $_GET['page'] ou 'home' par défaut
     * Chaque méthode appelée, interrogera la bdd si besoin
     * et effectuera les contrôle de formulaire nécessaire
     *
     * *NB: Il sera donc nécessaire de transmettre ces POSTs si une soumission est effectuée
     *
     * @return void
     */
    public function handleRequest(): void
    {
        // Define route
        $route = $_GET['page'] ?? 'home';
        // Get post if exist
        $params = $_POST ?? null;

        // Dispatch route
        switch ($route) {
            case 'home':
                $controller = new HomeController();
                $controller->index();
                break;
            case 'cocktails':
                $controller = new CocktailController();
                $controller->index();
                break;
            case 'add_cocktail':
                // POst exist
                $controller = new CocktailController();
                $controller->add($params);
                break;
            case 'login':
                // $params = !empty($_POST) && array_key_exists('email', $_POST) && array_key_exists('password', $_POST) ? ['email' => $_POST['email'], 'password' => $_POST['password']] : null;
                $controller = new AuthController();
                $controller->login($params);
                break;
            case 'signin':
                // $params = !empty($_POST) && array_key_exists('name', $_POST) && array_key_exists('email', $_POST) && array_key_exists('password', $_POST) ? ['name' => $_POST['name'], 'email' => $_POST['email'], 'password' => $_POST['password']] : null;
                $controller = new AuthController();
                $controller->signin($params);
                break;
            case 'logout':
                $controller = new AuthController();
                $controller->logout((int) $_GET['user_id']);
                break;
            case 'cocktails':
                $controller = new CocktailController();
                $controller->index();
                break;
            case 'show':
                $id = (int) $_GET['id'] ?? null;
                $controller = new CocktailController();
                $controller->show($id);
                break;
        }
    }
}
