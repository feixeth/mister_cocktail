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
    // Properties
    private string $name;
    private string $content;
    private string $picture;
    private int $alcohol_id;
    private array $ingredients;

    public function __construct()
    {
        parent::__construct();
    }

    public function getNbCocktails()
    {
        try {
            $result = $this->getConnection()->query(
                'SELECT COUNT(cocktail.id) as nb
                FROM cocktail'
            );

            return $result->fetch();
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
        return false;
    }

    /**
     * Find One by id
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

            //@TODO Get ingredients
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

    public function findByName(string $name)
    {
        try {
            $cocktail = $this->getConnection()->prepare('
                SELECT id
                FROM cocktail
                WHERE cocktail.name = :name
            ');
            $cocktail->execute(['name' => $name]);

            return $cocktail->fetch();
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
    public function add(array $form, array $file)
    {
        try {
            // Insert cocktail
            $q = $this->getConnection()->prepare(
                'INSERT INTO cocktail(name, content, picture, alcohol_id)
                VALUES (:nom, :description, :urlPhoto, :alcohol)'
            );
            // Transmettre le paramètre
            $q->execute([
                'nom' => $form['name'],
                'description'  => $form['content'],
                'urlPhoto'   => $file['fileName'],
                'alcohol'   => (int) $form['alcohol_id']
            ]);
            // Get last id inserted
            $id = $this->getConnection()->lastInsertId();

            // Create assoc cocktail => ingredients
            // Requête insertion du cocktail assoc ingredient
            foreach ($form['ingredients'] as $ingredientId) {
                $q = $this->getConnection()->prepare(
                    'INSERT INTO cocktail_assoc(cocktail_id, ingredient_id)
                    VALUES (:id_cocktail, :id_ingredient)'
                );
                $q->execute([
                    'id_cocktail' => $id,
                    'id_ingredient' => $ingredientId
                ]);
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
        return true;
    }

    public function remove(int $id)
    {
        // Del
        try {
            // Insert cocktail
            $q = $this->getConnection()->prepare(
                'DELETE FROM cocktail WHERE id = :id'
            );
            // Transmettre le paramètre
            $q->execute([
                'id' => $id
            ]);
            return $this->findAll();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    // Getter / Setter
    /**
     * Get the value of name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Get the value of content
     */
    public function getContent(): string
    {
        return htmlspecialchars_decode($this->content);
    }

    /**
     * Set the value of content
     *
     * @return  self
     */
    public function setContent(string $content): void
    {
        $this->content = htmlspecialchars($content);
    }

    /**
     * Get the value of picture
     */
    public function getPicture(): string
    {
        return $this->picture;
    }

    /**
     * Set the value of picture
     *
     * @return  self
     */
    public function setPicture(string $picture): void
    {
        $this->picture = $picture;
    }

    /**
     * Get the value of alcohol_id
     */
    public function getAlcohol(): int
    {
        return $this->alcohol_id;
    }

    /**
     * Set the value of alcohol_id
     */
    public function setAlcohol(int $alcohol_id): void
    {
        $this->alcohol_id = $alcohol_id;
    }

    /**
     * Get the value of ingredients
     */
    public function getIngredients(): array
    {
        return $this->ingredients;
    }

    /**
     * Set the value of ingredients
     *
     * @return  self
     */
    public function addIngredient(int $ingredientId): void
    {
        array_push($this->ingredients, $ingredientId);
    }
}
