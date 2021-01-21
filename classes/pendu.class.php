<?php

class pendu{

    public $Word;

    // Si le fichier existe, on crée un tableau avec ses valeurs en supprimant les virgurles
    function makeFileArray($path)
    {
        if($path){
            $contentFile = file_get_contents($path);
            $explodedContent = explode(",", $contentFile);
            return $explodedContent;
        }
    }
    
    // Selectionne une valeur aléatoire dans le tableau
    function arrayRandomValue($array)
    {
            if($array){
                $arrayRand = array_rand($array, 1);
                $Word = $array[$arrayRand];
                $this->Word = $Word;
                return $Word;    
            }
    }
    
    // Tranforme le mot en "_"
    function setWordtoUnderscore($word)
    {
        if ($word){
            $hiddenWord = "";
            $motPendu = array();
            for ($i = 0; $i < strlen($word); $i++){
            array_push($motPendu, "_ ");
            $hiddenWord = $hiddenWord . "<td id='". $i . "'>" . $motPendu[$i] . "</td>"; 
            }
            return $hiddenWord;
        }else{
                return false;
            }
    }
        

}

?>