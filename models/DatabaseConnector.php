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
                'mysql:host=localhost;dbname=mister_cocktail_oo',
                'root',
                '',
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
