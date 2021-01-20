<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>

<body>
<?php
//Je créer un objet anonyme
$TYPE_FORM = new stdClass();
// Ici je définis les paramètres que peut venir prendre pour formulaire
$TYPE_FORM->DELETE = "delete";
$TYPE_FORM->CREATE = "create";
// Ici je définis une constance pour le chemin du fichier
const PATH = "mots.txt";


// Cette fonction va écrire le mot passé en paramètre à la suite du fichier
function saveWordToFile($path = null, $word = null)
{
    if ($path && $word) {
        $contentFile = file_get_contents($path);
        $contentFile .= $word . ",";
        file_put_contents($path, $contentFile);
    }
}

// Cette fonction va suprimmer le mot passé en paramètre et réécrire l'ensemble du fichier
function deleteWordFromFile($path, $wordToDelete)
{
    if ($path && $wordToDelete) {
        $contentFile = file_get_contents($path);
        $explodedContent = explode(",", $contentFile);
        if (($key = array_search($wordToDelete, $explodedContent)) !== false) {
            unset($explodedContent[$key]);
        }
        $implodedContent = implode(",", $explodedContent);
        file_put_contents($path, $implodedContent);
    }
}


// Vérifie si le fichier existe bien
function isFileExist($path)
{
    return file_exists($path);
}


// Vérifie si le mot est déjà présent dans la liste et renvoie un Boolean
function isWordAlreadyExist($path, $wordToCheck)
{
    if ($path && $wordToCheck) {
        $contentFile = file_get_contents($path);
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
function getContentFile($path){
    if($path){
        return file_get_contents($path);
    }
}

//Vérifie si des mots existent et les affiche


?>


<form action="" method="POST">
    <label>Ajouter un mot</label>
    <input type="text" name="word">
    <input type="hidden" name="TYPE_FORM" value="<?= $TYPE_FORM->CREATE ?>">
    <input type="submit" name="valider">
</form>
<br />
<form action="" method="POST">
    <label>Supprimer un mot</label>
    <input type="text" name="word">
    <input type="hidden" name="TYPE_FORM" value="<?= $TYPE_FORM->DELETE ?>">
    <input type="submit" name="supprimer" value="Supprimer">
</form>
<br />



<?php

//Ici je vérifie d'abord si dans la variable d'environnement POST on a des valeurs
if (isset($_POST) && !empty($_POST)) {
    // Et je créer un switch en fonction du type du formulaire
    switch ($_POST["TYPE_FORM"]) {
        // Si c'est un create
        case ($TYPE_FORM->CREATE):
            if (isFileExist(PATH)) {
                if (!isWordAlreadyExist(PATH, $_POST['word'])) {
                    saveWordToFile(PATH, $_POST['word']);
                    echo "Mot ajouté à la liste" . "<br />";
                }
            }
            break;
        // Si c'est un delete
        case($TYPE_FORM->DELETE):
            if (isFileExist(PATH)) {
                deleteWordFromFile(PATH, $_POST['word']);
                echo "Mot supprimé de la liste" . "<br />";
            }
            break;
    }
}

echo getContentFile(PATH);

// dans l'idéal, il aurait fallu tout mettre dans des fichiers séparé, créer une classe Files, et créer des méthodes plutôt
// Que des fonctions, mais là ça fera largmeent l'affaire
?>
</body>
</html>

<!-- PENSER AUX DOUBLONS AVANT DE RENDRE LE PROJET -->

!=