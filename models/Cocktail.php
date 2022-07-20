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
class Cocktail extends DatabaseConnector
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Find One by id (cocktail with alcohol + ingredients)
     *
     */
    public function findById(int $id)
    {
        try {
            $cocktail = $this->getConnection()->prepare('
                SELECT cocktail.id as id, cocktail.name, cocktail.content, cocktail.picture, alcohol.name as alcool
                FROM cocktail
                INNER JOIN alcohol ON alcohol.id = cocktail.alcohol_id
                WHERE cocktail.id = :id
            ');
            $cocktail->execute(['id' => $id]);
            $ingredients = $this->getConnection()->prepare('
                SELECT ingredient.name
                FROM cocktail_assoc
                INNER JOIN ingredient ON ingredient.id = cocktail_assoc.ingredient_id
                WHERE cocktail_assoc.cocktail_id = :id
            ');
            $ingredients->execute(['id' => $id]);
            return [
                'cocktail' => $cocktail->fetch(),
                'ingredients' => $ingredients->fetchAll()
            ];
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
        return false;
    }
    /**
     * Find All with alcohol
     *
     */
    public function findAll()
    {
        try {
            $result = $this->getConnection()->query('
                SELECT cocktail.id as id, cocktail.name, cocktail.content, cocktail.picture, alcohol.name as alcool
                FROM cocktail
                INNER JOIN alcohol ON alcohol.id = cocktail.alcohol_id
                ORDER BY name
            ');
            return $result->fetchAll();
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
        return false;
    }
    /**
     * Insert Cocktail
     */
    public function insert()
    {
        // S'inspirer de user
    }
}