<?php

declare(strict_types=1);

require_once 'AbstractController.php';
require_once 'models/Cocktail.php';
require_once 'models/Alcohol.php';
require_once 'models/Ingredient.php';

class CocktailController extends AbstractController
{
    private Cocktail $cocktailM;
    private Alcohol $alcoholM;
    private Ingredient $ingredientM;

    public function __construct()
    {
        parent::__construct();
        // On a accès aux méthodes du model qui gère les Cocktails
        $this->cocktailM = new Cocktail;
        $this->alcoholM = new Alcohol;
        $this->ingredientM = new Ingredient;
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
     * Display One
     *
     * @param integer $id
     * @return void
     */
    public function show(int $id): void
    {
        // Use Cocktail Model to get this cocktail
        // Redirection
        $this->redirectTo('cocktail', $this->cocktailM->findById($id));
    }

    /**
     * Edit One
     *
     * @param integer $id
     * @return void
     */
    public function edit(int $id, ?array $form = null): void
    {
        try {
            // Test if exist
            if (!$cocktail = $this->cocktailM->findById($id))  throw new LogicException('Impossible d\'editer, la ressource n\'existe pas');
            // Transfert data to form ti fill it
            // Redirection
            $this->redirectTo('dashboard', $cocktail);
        } catch (LogicException $e) {
            //throw $th;
        }
    }

    /**
     * Remove One
     *
     * @param integer $id
     * @return void
     */
    public function del(int $id): void
    {
        // Si Non Connecté
        if (!Session::isAdmin()) {
            Session::addError('Vous n\'êtes pas autorisé à accéder à cette page');
            Session::destroy();
            $this->redirectTo('login');
        }

        try {
            // Test if exist
            $cocktail = $this->cocktailM->findById($id);
            if (!$cocktail['cocktail']) throw new LogicException('Impossible de supprimer, la ressource n\'existe pas');
            // test file exist associate
            if (!file_exists('templates/www/img/' . $cocktail['cocktail']['picture'])) throw new LogicException("Suppression du fichier impossible");
            // Remove file
            unlink('templates/www/img/' . $cocktail['cocktail']['picture']);
            // Remove from bdd
            $this->cocktailM->remove($id);

            // Send notif
            echo json_encode([
                'success' => 'Suppression effectuée, sans accroc',
                'cocktails' => $this->cocktailM->findAll()
            ]);
        } catch (LogicException $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
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
    public function add(?array $form, ?array $fileUpload = null): void
    {
        // Si Non Connecté
        if (!Session::getUser()) {
            Session::addError('Vous n\'êtes pas autorisé à accéder à cette page');
            $this->redirectTo('login');
        }

        // 2 On traite
        try {
            if (isset($form) && count($form) > 0) {
                // Test if form not empty
                if ($this->isEmptyForm($form)) throw new LogicException('Merci de remplir chaque champ');
                // Test if cocktail exist
                if ($this->cocktailM->findByName($form['name'])) throw new LogicException('Ce cocktail exist déjà');
                /*
                    Traiter le file
                    Test s'il existe
                    NB : on pourra continuer les tests(extensions, nom de fichier, taille, ...)
                */
                if (!array_key_exists('picture', $fileUpload) || empty($fileUpload['picture'])) throw new LogicException('La photo est obligatoire');

                // On appel la function qui gère l'upload de fichier (on y a accès grace à l'héritage du controleur abstrait)
                $fileResult = $this->uploadFile(
                    'picture',
                    $fileUpload,
                    "templates/www/img",
                    [
                        "jpg" => "image/jpg",
                        "jpeg" => "image/jpeg"
                    ]
                );
                // Test si file ok ? insert with img : insert without
                if (array_key_exists('error', $fileResult)) throw new LogicException('Une erreur est survenue lors de l\'insertion du fichier');

                // Insert with Cocktail Model
                if ($this->cocktailM->add($form, $fileResult)) {
                    Session::addFlashMsg('Cocktail ajouté');
                    // Redirection
                    header('Location: index.php?page=cocktails');
                    exit;
                } else throw new LogicException('Une erreur est survenue lors de l\'ajout du cocktail');
            }
        } catch (LogicException $e) {
            Session::addError($e->getMessage());
        }

        // Redirection
        $this->redirectTo('add_cocktail', [
            'alcools' => $this->alcoholM->findAll(),
            'ingredients' => $this->ingredientM->findAll()
        ]);
    }
}
