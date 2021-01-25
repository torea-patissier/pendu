<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="css/pendu.css" />
</head>
<header>
    <nav>
        <ul>
            <p><a href="index.php">Accueil</a></p>
            <p><a href="admin.php">Gèrer les mots</a></p>
        </ul>
    </nav>
</header>
<body>
<?php

include 'classes/file.class.php';
//Je créer un objet anonyme
$TYPE_FORM = new file("mots.txt");
// Ici je définis les paramètres que peut venir prendre pour formulaire
$TYPE_FORM->DELETE = "delete";
$TYPE_FORM->CREATE = "create";
// Ici je définis une constance pour le chemin du fichier
const PATH = "mots.txt";


?>

<main>
    <H1>Gestion des mots</H1>
<section class="Gestion des mots">
<div id="AddMot">
<form action="" method="POST">
    <label>Ajouter un mot</label>
    <input type="text" name="word">
    <input type="hidden" name="TYPE_FORM" value="<?= $TYPE_FORM->CREATE ?>">
    <input type="submit" name="valider">
</form>
<br/>
<form action="" method="POST">
    <label>Supprimer un mot</label>
    <input type="text" name="word">
    <input type="hidden" name="TYPE_FORM" value="<?= $TYPE_FORM->DELETE ?>">
    <input type="submit" name="supprimer" value="Supprimer">
</form>
<br/>


<?php

//Ici je vérifie d'abord si dans la variable d'environnement POST on a des valeurs
if (isset($_POST) && !empty($_POST)) {
    // Et je créer un switch en fonction du type du formulaire
    switch ($_POST["TYPE_FORM"]) {
        // Si c'est un create
        case ($TYPE_FORM->CREATE):
            if ($TYPE_FORM->isFileExist()) {
                if (!$TYPE_FORM->isWordAlreadyExist($_POST['word'])) {
                    $TYPE_FORM->saveWordToFile($_POST['word']);
                }
            }
            break;
        // Si c'est un delete
        case($TYPE_FORM->DELETE):
            if ($TYPE_FORM->isFileExist()) {
                $TYPE_FORM->deleteWordFromFile($_POST['word']);
            }
            break;
    }
}
echo "<p><b> Mots actuellement contenus dans la liste : </b></p> ";
echo $TYPE_FORM->getContentFile(PATH);


?>
</div>
</section>
</main>
</body>
</html>

<!-- PENSER AUX DOUBLONS AVANT DE RENDRE LE PROJET -->