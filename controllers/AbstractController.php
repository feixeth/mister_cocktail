<?php

declare(strict_types=1);

abstract class AbstractController
{
    private ?string $error;

    public function __construct()
    {
        $this->error = null;
    }

    // Behaviors
    protected function redirectTo(string $viewName, ?array $args = null): void
    {
        $params = $args;
        $template = $viewName;
        include_once 'layout.php';
    }

    /**
     * Get the value of error
     */
    protected function getError()
    {
        return $this->error;
    }

    /**
     * Set the value of error
     *
     * @return  self
     */
    protected function setError($error)
    {
        $this->error = $error;
        return $this;
    }

    // Behaviors move to FormValidator class
    /**
     * Valider qu'un formulaire ne soit pas remplit
     *
     * @param array $form
     * @return boolean
     */
    protected function isNullForm(array $form): bool
    {
        foreach ($form as $field) {
            if (is_null($field)) {
                var_dump('champ null');
                return true;
            }
        }
        return false;
    }

    /**
     * Valider qu'un formulaire soit vide
     *
     * @param array $form
     * @return boolean
     */
    protected function isEmptyForm(array $form): bool
    {
        foreach ($form as $field) {
            if (empty($field)) {
                var_dump('champ vide');
                return true;
            }
        }
        return false;
    }

    /**
     * Valider un email
     *
     * @param [type] $email
     * @return boolean
     */
    protected function isValidEmail($email): bool
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            var_dump('mail pourrit');
            return false;
        }
        return true;
    }

    /**
     * Limiter un rendu textuel
     *
     * @param [type] $text
     * @param [type] $limit
     * @return void
     */
    public function limitText($text, $limit)
    {
        if (str_word_count($text, 0) > $limit) {
            $words = str_word_count($text, 2);
            $pos   = array_keys($words);
            $text  = substr($text, 0, $pos[$limit]) . '...';
        }
        return $text;
    }
}
