<?php

declare(strict_types=1);

require_once 'AbstractController.php';
require_once 'models/Cocktail.php';

class CocktailController extends AbstractController
{
    private Cocktail $cocktailModel;

    public function __construct()
    {
        parent::__construct();
        // On a accès aux méthodes du model qui gère les Cocktails
        $this->cocktailM = new Cocktail;
    }

    /**
     * Display all
     *
     * @return void
     */
    public function index(): void
    {
        // Use Cocktail Model to get all cocktails
        // Redirection
        $this->redirectTo('cocktails', $this->cocktailM->findAll());
    }

    /**
     * Methode de traitement du formulaire d'ajout
     *
     * Ici, 1 - soit on affiche le form pour la 1ère fois
     * Soit 2 - on le traite, (success, error)
     *
     * @param array|null $form
     * @return void
     */
    public function add(?array $form): void
    {

        // 2 On traite
        if (isset($form)) {
            $this->redirectTo('add_cocktail');
        }

    }
    public function show(int $id): void
        {
            // Use Cocktail Model to get this cocktail
            // Redirection
            $this->redirectTo('cocktail', $this->cocktailM->findById($id));
        }
}
