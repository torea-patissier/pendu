<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendu</title>
</head>
<body>
    
<?php

    include "classes/pendu.class.php";

    //Je créer un objet
    $PENDU = new pendu();

    // Ici je définis une constance pour le chemin du fichier
    const PATH = "mots.txt";

    $_SESSION["error"] = "0";
    $_SESSION["img"] = "";
    $_SESSION["message"] = "";
    $_SESSION["find"] = 0;
    $_SESSION["word"] = "";
    $_SESSION["Hword"] = "";

    $array = $PENDU->makeFileArray(PATH);
    $_SESSION['word'] = $PENDU->arrayRandomValue($array);
    $_SESSION["HWord"] = $PENDU->setWordtoUnderscore($_SESSION['word']);

    echo $_SESSION["HWord"];

    echo '<br />';
    echo '<br />';

?>

    <form action="" method="GET">
    <input type="text" name="word">
    </form>

    <?php

    if(isset($_GET['word']) && !empty($_GET['word'])){

    }

?>
</body>
</html>

