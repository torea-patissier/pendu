<?php


class pendu
{

    public $word;
    public $path;

    function __construct($path)
    {
        $this->path = $path;
    }

    // Si le fichier existe, on crée un tableau avec ses valeurs en supprimant les virgurles
    function makeFileArray()
    {
        if ($this->path) {
            $contentFile = file_get_contents($this->path);
            $explodedContent = explode(",", $contentFile);
            return $explodedContent;
        }
        return [];
    }

    // Selectionne une valeur aléatoire dans le tableau
    function arrayRandomValue($array)
    {
        if ($array) {
            $arrayRand = array_rand($array, 1);
            $Word = $array[$arrayRand];
            $this->word = $Word;
            return $Word;
        }
        return "";
    }

    // Fonction principale
    function displayWord()
    {
        // Je mets juste les sessions dans un variable pour pas avoir à tout retaper à chaque fois
        $tentatives = $_SESSION["Tentatives"];
        $motADeviner = $_SESSION["MotADeviner"];
        $_SESSION["Erreurs"] = 0;
        // Je réinitialise le mot à chaque fois
        $_SESSION["MotAvecTentatives"] = Array();

        //Dans cette première boucle je vais parcourir le tableau du mot à deviner
        for ($i = 0; $i < strlen($motADeviner); $i++) {
            // J'initialise une lettre avec un underscor
            $letter = "_";

            //Je vais parcourir le tableau des essais
            for ($j = 0; $j < count($tentatives); $j++) {

                // Si les deux corespondent
                if (!strcasecmp($motADeviner[$i],$tentatives[$j])) {
                    //La lettre devient la lettre essayée
                    $letter = $tentatives[$j];
                }
            }
            
            //Je push le resultat ici dans la session
            array_push($_SESSION["MotAvecTentatives"], $letter);
            
        }
        if(end($tentatives) == true){
            if(end($tentatives) != $motADeviner[$i]){
            $_SESSION["Erreurs"] ++;
            }
        }
            
    }


// Je détruis les variables de sessions pour relancer la partie.
    function newGame(){
        session_destroy();
        header("Location: index.php");
    }

}

?>