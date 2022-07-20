<?php

declare(strict_types=1);

require_once 'AbstractController.php';
require_once 'lib/AuthInterface.php';
require_once 'models/User.php';

class AuthController extends AbstractController implements AuthInterface
{
    private User $userM;

    public function __construct()
    {
        // Rappel des propriétés et méthodes du parent
        parent::__construct();
        // Composition d'un model
        $this->userM = new User;
    }

    public function login(?array $form): void
    {
        try {
            // If submit
            if (!empty($form) && !$this->isNullForm([$form['email'], $form['password']])) {
                extract($form);
                // Check Empty form
                if ($this->isEmptyForm([$email, $password])) throw new LogicException("Merci de remplir tous les champs");
                // Check valid email
                if (!$this->isValidEmail($email)) throw new LogicException("L'email est invalide");
                // Fill User
                if (!$user = $this->userM->findByEmail($email)) throw new LogicException("L'utilisateur n'existe pas");
                // try to save it
                // Need Authenticator Interface
                if ($this->auth($user, $password)) {
                    // Init session
                    Session::init((int) $user['id'], $user['name'], $user['email'], (int) $user['role_id']);
                    // Redirect to home to login
                    header('Location: index.php');
                    exit;
                } else throw new LogicException("Mot de passe incorrect");
            }
        } catch (LogicException $e) {
            $error = $e->getMessage();
        }
        // Display form
        $this->redirectTo('login', ['error' => $error]);
    }

    public function signin(?array $form): void
    {
        // Test si data -> traitement
        try {
            // If submit
            if (!empty($form) && !$this->isNullForm([$form['name'], $form['email'], $form['password']])) {
                extract($form);
                // Check Empty form
                if ($this->isEmptyForm([$name, $email, $password])) throw new LogicException("Merci de remplir tous les champs");
                // Check valid email
                if (!$this->isValidEmail($email)) throw new LogicException("L'email est invalide");
                // yet exist by name
                if ($this->userM->findByName($name)) throw new LogicException("Un utilisateur existe déjà avec ce nom !!! ");
                // yet exist by mail
                if ($this->userM->findByEmail($email)) throw new LogicException("Un utilisateur existe déjà avec cet email !!!");
                // Fill User Model with form datas
                $this->userM
                    ->setEmail($email)
                    ->setName($name)
                    ->setPassword($password)
                    ->setRole();
                // try to save it
                if ($this->userM->insert()) {
                    // Redirect to home to login
                    header('Location: index.php?page=login');
                    exit;
                } else throw new LogicException("Une erreur est survenue lors de l'insertion, merci de réessayer");
            }
        } catch (LogicException $e) {
            $error = $e->getMessage();
        }

        // Display form
        $this->redirectTo('signin', ['error' => $error]);
    }

    public function logout(int $user_id): void
    {
        // Disconnect user
        Session::destroy();
        $this->redirectTo('home');
    }

    // implement interface
    public function auth(array $user, string $pass): bool
    {
        // Check password
        if (!password_verify($pass, $user['password'])) {
            return false;
        }
        return true;
    }
}
