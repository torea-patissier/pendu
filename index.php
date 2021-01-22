<?php
session_start();

//Je vérifie si les sessions existent, sinon, je les créer
if (!isset($_SESSION["Tentatives"]))$_SESSION["Tentatives"] = array();
if (!isset($_SESSION["MotAvecTentatives"])) $_SESSION["MotAvecTentatives"] = array();
if (!isset($_SESSION["Erreurs"])) $_SESSION["Erreurs"] = 0;
if (!isset($_SESSION["MotADeviner"])) $_SESSION["MotADeviner"] = "";
if (!isset($_SESSION["Img"])) $_SESSION["Img"] = "";

const PATH = "mots.txt";
include "classes/pendu.class.php";

$PENDU = new pendu(PATH);

//Je vérifie si le MotADeviner à été initialiser
if (strlen($_SESSION["MotADeviner"]) === 0) {
    //Sinon, je le fais
    $newWord = $PENDU->arrayRandomValue($PENDU->makeFileArray());
    $_SESSION["MotADeviner"] = $newWord;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendu</title>
</head>
<body>

<?php

//J'enregistre la lettre essayée dans les tentatives
    if(isset($_GET["word"]) && !empty($_GET["word"])){
        array_push($_SESSION["Tentatives"],$_GET["word"]);

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
                    $_SESSION['Img'] = "";
                    break;
                case 1:
                    $_SESSION['Img'] = "";
                    break;
                case 2:
                    $_SESSION['Img'] = "";
                    break;
                case 3:
                    $_SESSION['Img'] = "";
                    break;
                case 4:
                    $_SESSION['Img'] = "";
                    break;
                case 5:
                    $_SESSION['Img'] = "";
                    break;
                case 6:
                    $_SESSION['Img'] = "";
                    
                    break;
                default:
                $_SESSION['Img'] = "";
            }
        }
    }

    //Ici c'est pour réinitialiser
    if(isset($_POST["new"])){
        $PENDU->newGame();
    }
?>


<?php
if (isset($_SESSION['MotADeviner'])) {
    $PENDU->displayWord();
    $formatedWord = implode("", $_SESSION["MotAvecTentatives"]);
    echo $_SESSION["MotADeviner"];
    echo "<br>";
    echo $formatedWord;
}

echo "<br />";
print_r ($_SESSION["MotAvecTentatives"]);
echo "<br />";
print_r ($_SESSION["Tentatives"]);
echo "<br />";
print_r ($_SESSION["Erreurs"]);
?>


<form action="" method="GET">
    <input type="text" name="word">
</form>

<form action="" method="post">
    <input type="hidden" name="new">
    <input type="submit" value="rejouer">
</form>


</body>
</html>

