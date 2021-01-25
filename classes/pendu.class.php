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
        // Je réinitialise le mot à chaque fois
        $_SESSION["MotAvecTentatives"] = Array();

        //Dans cette première boucle je vais parcourir le tableau du mot à deviner
        for ($i = 0; $i < strlen($motADeviner); $i++) {
            // J'initialise une lettre avec un underscor
            $letter = "_ ";

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
    }

// Je détruis les variables de sessions pour relancer la partie.
    function newGame(){
        session_destroy();
        header("Location: index.php");
    }

    function verifyErrors()
    {
        if(isset($_GET["word"]) && !empty($_GET["word"])){
            $indexMot = array();
            $ADeviner = $_SESSION["MotADeviner"];

            for($i=0; $i < strlen($ADeviner); $i++){
                if(substr(strtolower($_SESSION["MotADeviner"]), $i, 1) == strtolower($_GET["word"])){
                    array_push($indexMot, $i);
                }
            }
            if(count($indexMot) == 0){
                $_SESSION["Erreurs"] = $_SESSION["Erreurs"] +1;

                switch ($_SESSION['Erreurs']) {
                    case 0:
                        $_SESSION['Img'] = "IMG/Pendu0.png";
                        break;
                    case 1:
                        $_SESSION['Img'] = "IMG/Pendu1.png";
                        break;
                    case 2:
                        $_SESSION['Img'] = "IMG/Pendu2.png";
                        break;
                    case 3:
                        $_SESSION['Img'] = "IMG/Pendu3.png";
                        break;
                    case 4:
                        $_SESSION['Img'] = "IMG/Pendu4.png";
                        break;
                    case 5:
                        $_SESSION['Img'] = "IMG/Pendu5.png";
                        break;
                    case 6:
                        $_SESSION['Img'] = "IMG/Pendu6.png";
                        
                        break;
                    default:
                    $_SESSION['Img'] = "IMG/Pendu7.png";
                }
            }
        }
    }

    function arrayValuesToStr(){
        if ($_SESSION["Tentatives"] == true){
            $Tentatives = $_SESSION["Tentatives"];
            $Lettres = implode(", ", $Tentatives);
            echo " " . $Lettres;
        }
    }

    function imgDisplay(){
        if(isset($_SESSION["Img"]) && $_SESSION['Img'] != "IMG/Pendu7.png"){
            echo '<div id="image">';
            echo    '<img src=' . $_SESSION["Img"] . '>';
            echo '</div>';
        }else{
            echo '<div id="image">';
            echo    '<img src=' . $_SESSION["Img"] . '>';
            echo '</div>';
            echo "Partie Terminée, le pauvre bonhomme est mort à cause de toi OH CAVE !";
        }
    }

    function Victory(){
        $formatedWord = implode("", $_SESSION["MotAvecTentatives"]);
        $underScor = "_";
        $pos = strpos($formatedWord, $underScor);
    
        if($pos !== false){
        // echo "Continuez à chercher zebi";
            }else{
                echo "Bien joué, pour recommencer une partie, cliques sur Rejouer ci-dessous";
            }

    }

}

?>