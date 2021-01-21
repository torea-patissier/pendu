<?php

class file
{

    public $path;

    function __construct($path)
    {
        $this->path = $path;
    }

    // Cette fonction va écrire le mot passé en paramètre à la suite du fichier
    function saveWordToFile($word = null)
    {
        if ($this->path && $word && ctype_alpha($word)) {
            $contentFile = file_get_contents($this->path);
            $contentFile .= $word . ",";
            file_put_contents($this->path, $contentFile);
        } else {
            echo "Seuls les lettre sont acceptées" . "<br />";
            return false;


        }
    }

// Cette fonction va suprimmer le mot passé en paramètre et réécrire l'ensemble du fichier
    function deleteWordFromFile($wordToDelete)
    {
        if ($this->path && $wordToDelete) {
            $contentFile = file_get_contents($this->path);
            $explodedContent = explode(",", $contentFile);
            if (($key = array_search($wordToDelete, $explodedContent)) !== false) {
                unset($explodedContent[$key]);
            }
            $implodedContent = implode(",", $explodedContent);
            file_put_contents($this->path, $implodedContent);
        }
    }


// Vérifie si le fichier existe bien
    function isFileExist()
    {
        return file_exists($this->path);
    }


// Vérifie si le mot est déjà présent dans la liste et renvoie un Boolean
    function isWordAlreadyExist($wordToCheck)
    {
        if ($this->path && $wordToCheck) {
            $contentFile = file_get_contents($this->path);
            $explodedContent = explode(",", $contentFile);
            foreach ($explodedContent as $word) {
                if (strtolower($word) == strtolower($wordToCheck)) {
                    return true;
                }
            }
            return false;
        }
        return false;
    }

// Si le fichier existe retourne son contenu
    function getContentFile($path)
    {
        if ($path) {
            return file_get_contents($path);
        }
    }


}


?>