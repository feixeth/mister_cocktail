<?php

declare(strict_types=1);

/**
 * Classe représentant la session php $_SESSION
 *
 * liste de fonctionnalitées :
 *      - start(): void // Démarrage de la session, afin de pouvoir l'utiliser
 *      - destroy(): void // Destruction de la session, afin de déconnecter le user
 *      - init(id, nom, email, ... (role) ): void // Remplissage de la session avec les infos du user
 *      - isConnected(): bool // méthode retournerai un booléen pour dire si oui ou non quelqu'un est connecté
 *      - getLogged(): array // méthode retournerai les infos du user connecté
 *
 * Usage de l'opérateur static '::'
 * Pour utiliser des props ou méthodes static au sein de la class elle-même
 */
class Session
{
    public static function start(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function destroy(): void
    {
        $_SESSION['auth'] = [];
        unset($_SESSION['auth']);
    }

    public static function init(int $id, string $nom, string $email, int $role): void
    {
        $_SESSION['auth'] = [
            'id'    => $id,
            'name'  => $nom,
            'email' => $email,
            'isAdmin' => $role === 1 ? true : false
        ];
    }

    public static function isConnected(): bool
    {
        return isset($_SESSION['auth']) ?? false;
    }

    public static function isAdmin(): bool
    {
        return self::isConnected() && $_SESSION['auth']['isAdmin'] ?? false;
    }

    public static function getLogged()
    {
        // il faut utiliser 'self' ou le nom de la classe elle-même, ici 'Session' devant l'opérateur
        return self::isConnected() ? $_SESSION['auth'] : false;
    }

    public static function setError(string $error = null): void
    {
        $_SESSION['error'] = $error;
    }

    public static function getError(): ?string
    {
        return isset($_SESSION['error']) ? $_SESSION['error'] : null;
    }

    // Gestion notifs
    /**
     * Add notif
     * ex : ['error' => 'une problème est survenu']
     * ex : ['success' => 'tout s'est bien passé']
     *
     * @param array $msg
     * @return void
     */
    public static function addFlashMsg(array $msg): void
    {
        $_SESSION['notif'] = $msg;
    }

    public static function getFlashMsg(): ?array
    {
        return $_SESSION['notif'] ?? null;
    }

    public static function resetFlashMsg(): void
    {
        $_SESSION['notif'] = [];
    }
}
