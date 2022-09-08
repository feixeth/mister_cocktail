<?php

declare(strict_types=1);

require_once 'controllers/HomeController.php';
require_once 'controllers/AuthController.php';
require_once 'controllers/DashBoardController.php';
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
        // #TODO Optimize route in config file
        switch ($route) {
            case 'home':
                $controller = new HomeController();
                $controller->index();
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
            case 'add_cocktail':
                $file = $_FILES ?? null;
                $controller = new CocktailController();
                $controller->add($params, $file);
                break;
            case 'edit_cocktail':
                $id = (int) $_GET['id'] ?? null;
                $controller = new CocktailController();
                $controller->edit($id, $params);
                break;
            case 'del_cocktail':
                $id = (int) $_GET['id'] ?? null;
                $controller = new CocktailController();
                $controller->del($id);
                break;
            case 'dashboard':
                $controller = new DashBoardController();
                $controller->index();
                break;
            case 'add_alcohol':
                $controller = new DashBoardController();
                $controller->addAlcohol($params);
                break;
            case 'add_ingredient':
                $controller = new DashBoardController();
                $controller->addIngredient($params);
                break;
            case 'login':
                $controller = new AuthController();
                $controller->login($params);
                break;
            case 'signin':
                $controller = new AuthController();
                $controller->signin($params);
                break;
            case 'logout':
                $controller = new AuthController();
                $controller->logout((int) $_GET['user_id']);
                break;
        }
    }
}
