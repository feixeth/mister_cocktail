<?php

declare(strict_types=1);
/**
 * C'est une classe abstraite qui ne peut être instancié
 *
 * Elle va servir pour faire de l'héritage vis à vis des Models, qui héritera de ses méthodes et de la connexion
 *
 * De quoi doit-elle être composée :
 *      - propriété / méthode de connexion
 *
 * Au besoin, elle pourrait contenir :
 *      - méthode pour fetch : une donnée (1 résultat tableau)
 *      - méthode pour fetchAll :  un ensemble de données (plusieurs résultats tableaux)
 *      - méthode de manipulation : insert / update / delete
 */
abstract class DatabaseConnector
{
    private PDO $connection;
    protected string $table;

    public function __construct()
    {
        $this->initConnection();
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }

    private function initConnection(): void
    {
        try {
            $this->connection = new PDO(
                'mysql:host=localhost;dbname=mister_cocktail_oo;charset=utf8',
                'root',
                'root',
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Find One by email
     *
     */
    public function findAll()
    {
        try {
            $result = $this->getConnection()->query(
                "SELECT * FROM {$this->table}"
            );

            return $result->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return false;
    }

    /**
     * Find One by email
     *
     */
    public function findById(int $id)
    {
        try {
            $result = $this->getConnection()->prepare(
                "SELECT * FROM {$this->table} WHERE id = :id"
            );
            $result->execute(['id' => $id]);
            return $result->fetch();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return false;
    }

    /**
     * Find One by name
     */
    public function findByName(string $name)
    {
        try {
            $result = $this->getConnection()->prepare(
                "SELECT id, name
                FROM {$this->table}
                WHERE name = :name"
            );
            $result->execute(['name' => $name]);

            return $result->fetch();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return false;
    }
}
