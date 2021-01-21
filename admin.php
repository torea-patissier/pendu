<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>

<body>
<?php

include 'classes/file.class.php';
//Je créer un objet anonyme
$TYPE_FORM = new file();
// Ici je définis les paramètres que peut venir prendre pour formulaire
$TYPE_FORM->DELETE = "delete";
$TYPE_FORM->CREATE = "create";
// Ici je définis une constance pour le chemin du fichier
const PATH = "mots.txt";






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
            if ($TYPE_FORM->isFileExist(PATH)) {
                if (!$TYPE_FORM->isWordAlreadyExist(PATH, $_POST['word'])) {
                    $TYPE_FORM->saveWordToFile(PATH, $_POST['word']);
                }
            }
            break;
        // Si c'est un delete
        case($TYPE_FORM->DELETE):
            if ($TYPE_FORM->isFileExist(PATH)) {
                $TYPE_FORM->deleteWordFromFile(PATH, $_POST['word']);
            }
            break;
    }
}

echo $TYPE_FORM->getContentFile(PATH);

// dans l'idéal, il aurait fallu tout mettre dans des fichiers séparé, créer une classe Files, et créer des méthodes plutôt
// Que des fonctions, mais là ça fera largmeent l'affaire
?>
</body>
</html>

<!-- PENSER AUX DOUBLONS AVANT DE RENDRE LE PROJET -->