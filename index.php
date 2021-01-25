<?php
session_start();

//Je vérifie si les sessions existent, sinon, je les créer
if (!isset($_SESSION["Tentatives"]))$_SESSION["Tentatives"] = array();
if (!isset($_SESSION["MotAvecTentatives"])) $_SESSION["MotAvecTentatives"] = array();
if (!isset($_SESSION["Erreurs"])) $_SESSION["Erreurs"] = 0;
if (!isset($_SESSION["MotADeviner"])) $_SESSION["MotADeviner"] = "";
if (!isset($_SESSION["Img"])) $_SESSION["Img"] = "IMG/Pendu0.png";

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
    <link rel="stylesheet" href="css/pendu.css" />
</head>
<body>
<header>
    <nav>
        <ul>
            <p><a href="index.php">Accueil</a></p>
            <p><a href="admin.php">Gèrer les mots</a></p>
        </ul>
    </nav>
</header>
<?php

//J'enregistre la lettre essayée dans les tentatives
    if(isset($_GET["word"]) && !empty($_GET["word"])){
        array_push($_SESSION["Tentatives"],$_GET["word"]);
        $PENDU->verifyErrors();        
    }

    //Ici c'est pour réinitialiser
    if(isset($_POST["new"])){
        $PENDU->newGame();
    }
?>
<main>
    <h1>Jeu du Pendu</h1>
<section class="Jeu">
<?php
if (isset($_SESSION['MotADeviner'])) {
    $PENDU->displayWord();
    $formatedWord = implode("", $_SESSION["MotAvecTentatives"]);
    echo "<div class='motCache'>";
    echo "<br />" . "<h2>" . $formatedWord . "</h2>" . "<br />";
    echo "</div>";
    echo "<br />";
    echo "<div id='Stats'>";
    echo "<div class='compteurErreurs'>";
    echo "Erreurs :";
    print_r ($_SESSION["Erreurs"]);
    echo "</div>";
    echo "<div class='propositions'>";
    echo "Lettres proposées :";
    $PENDU->arrayValuesToStr();
    echo "</div>";
    echo "</div>";
    echo "<br />";
    $PENDU->imgDisplay();
    echo "<br />";
    $PENDU->Victory();
}
?>

<form action="" method="GET">
    <input class="textBox" type="text" name="word">
</form>
<br />
<form action="" method="post">
    <input type="hidden" name="new">
    <input class="button" type="submit" value="Rejouer">
</form>
</section>
</main>
</body>
</html>

