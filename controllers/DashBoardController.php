<?php

declare(strict_types=1);

require_once 'AbstractController.php';
require_once 'models/User.php';
require_once 'models/Cocktail.php';
require_once 'models/Alcohol.php';
require_once 'models/Ingredient.php';

class DashBoardController extends AbstractController
{
    private User $userM;
    private Cocktail $cocktailM;
    private Alcohol $alcoholM;
    private Ingredient $ingredientM;

    public function __construct()
    {
        parent::__construct();
        // On a accès aux méthodes du model qui gère les Cocktails
        $this->userM = new User;
        $this->cocktailM = new Cocktail;
        $this->alcoholM = new Alcohol;
        $this->ingredientM = new Ingredient;
    }

    public function index(): void
    {
        // Envoi des datas nécessaires pour l'affichage
        $this->redirectTo('dashboard', [
            'cocktails' => $this->cocktailM->findAll(),
            'alcohols' => $this->alcoholM->findAll(),
            'ingredients' => $this->ingredientM->findAll(),
            'users' => $this->userM->findAll()
        ]);
    }

    // Ajax methods
    public function addAlcohol(?array $form)
    {
        // Test si data -> traitement
        try {
            // Check Empty form
            if ($this->isEmptyForm($form)) throw new LogicException("Merci de remplir le champ");
            // yet exist by name
            if ($this->alcoholM->findByName($form['name'])) throw new LogicException("Un alcool existe déjà avec ce nom !!! ");
            // try to save it
            if ($this->alcoholM->insert($form['name'])) {
                // Notif
                // $alcohols = $this->alcoholM->findAll();
                // asort($alcohols);
                echo json_encode([
                    'success' => 'Ajout réussie',
                    'alcohols' => $this->alcoholM->findAll()
                ]);
            } else throw new LogicException("Une erreur est survenue lors de l'insertion, merci de réessayer");
        } catch (LogicException $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function addIngredient(?array $form)
    {
        // Test si data -> traitement
        try {
            // Check Empty form
            if ($this->isEmptyForm($form)) throw new LogicException("Merci de remplir le champ");
            // yet exist by name
            if ($this->ingredientM->findByName($form['name'])) throw new LogicException("Un ingredient existe déjà avec ce nom !!! ");
            // try to save it
            if (!$this->ingredientM->insert($form['name'])) throw new LogicException("Une erreur est survenue lors de l'insertion, merci de réessayer");
            // Notif
            $ingredients = $this->ingredientM->findAll();
            asort($ingredients);
            echo json_encode([
                'success' => 'Ajout réussie',
                'ingredients' => $ingredients
            ]);
        } catch (LogicException $e) {
            echo json_encode(['success' => $e->getMessage()]);
        }
    }
}
