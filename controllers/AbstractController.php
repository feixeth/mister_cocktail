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
        exit;
    }

    /**
     * Debug vars
     *
     * @param string $title
     * @param array $var
     * @return void
     */
    protected function dd(string $title, array $var): void
    {
        echo "<h1>$title</h1>";
        echo '<br>';
        echo '<pre>';
        print_r($var);
        echo '</pre>';
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
    protected function limitText($text, $limit)
    {
        if (str_word_count($text, 0) > $limit) {
            $words = str_word_count($text, 2);
            $pos   = array_keys($words);
            $text  = substr($text, 0, $pos[$limit]) . '...';
        }
        return $text;
    }

    /**
     * Upload File
     *
     * @description Upload de fichier universel
     *
     * @param string $name attr-form
     * @param array $file $_FILES
     * @param string $pathTo Chemin de destination
     * @param array $allowed extension autorisé
     * @return array
     */
    protected function uploadFile(string $name, array $file, string $pathTo, array $allowed = ["jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png"]): array
    {
        if (isset($file[$name]) && $file[$name]["error"] == UPLOAD_ERR_OK) {
            // Extraire les données du fichier
            $filename = $file[$name]["name"];
            $filetype = $file[$name]["type"];
            $filesize = $file[$name]["size"];
            // Test ext Allowed
            if (in_array($filetype, $allowed)) {
                // Check size 1 Mb
                if ($filesize < 1024 * 1024) {
                    // Test file exist yet
                    if (!file_exists($pathTo . '/' . $filename)) {
                        // Tentative d'insertion de la photo
                        if (move_uploaded_file($file[$name]["tmp_name"], $pathTo . '/' . $filename)) return ['fileName' => $filename];
                        else return ['error' => 'Une erreur est survenue lors de l\'upload, merci de ré-essayer'];
                    } else return ['error' => "Ce fichier existe déjà"];
                } else return ['error' => "Merci d'envoyer un fichier inférieur à 1 Mo"];
            } else return ['error' => 'Merci de ne soumettre que des fichiers au format jpg/jpeg'];
        } else return ['error' => 'Impossible d\'upload ce fichier'];
    }
}
