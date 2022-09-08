<?php

declare(strict_types=1);

require_once 'DatabaseConnector.php';
/**
 * CocktailModel est une classe qui va hérité de Database afin de pouvoir effectuer des requête sur la table User
 *
 * liste des champs de la table cocktail
 *
 * Et seulement celle-ci
 */
class Ingredient extends DatabaseConnector
{
    public function __construct()
    {
        parent::__construct();
        $this->table = 'ingredient';
    }

    /**
     * Insert Cocktail
     */
    public function insert(string $name)
    {
        try {
            $q = $this->getConnection()->prepare(
                'INSERT INTO ingredient(name)
                    VALUES (:name)'
            );
            // Transmettre le paramètre
            $res = $q->execute([
                'name' => $name
            ]);
            // Test if KO
            if (!$res) {
                return false;
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
        return true;
    }
}
