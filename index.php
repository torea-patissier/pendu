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

    $_SESSION["error"] = "0";
    $_SESSION["img"] = "";
    $_SESSION["message"] = "";
    $_SESSION["trouve"] = 0;


    //Je créer un objet anonyme
    $TYPE_FORM = new stdClass();

    // Ici je définis une constance pour le chemin du fichier
    const PATH = "mots.txt";

    // Vérifie si le fichier existe bien
    function isFileExist($path)
    {
    return file_exists($path);
    }

    // Si le fichier existe retourne son contenu
    function getContentFile($path)
    {
        if($path){
            return file_get_contents($path);
        }
    } 
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
            return $arrayRand;    
        }
    }

    $rand = makeFileArray(PATH);
    $array_keys = arrayRandomValue($rand);
    echo $rand[$array_keys];
    

    
?>

</body>
</html>

