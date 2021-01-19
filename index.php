<?php

if(isset($_POST['valider'])){
    $min=$_POST['nbMin'];
    $max=$_POST['nbMax'];

    $tirage = rand($min,$max);

    echo $tirage;
}else{
    echo'Entrez un entier dans les 2 cases différentes  pour commencer le pendu. <br />';
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
</head>
<body>

<form action="index.php" method="POST">
    <label>Nombre min</label>
    <input type="text" name="nbMin">
    <label>Nombre max</label>
    <input type="text" name="nbMax">
    <input type="submit" name="valider">
</form>
    
</body>
</html>


<!-- index.php : permet de jouer -->

<!-- Déroulé d’une partie :

Lorsqu’une partie commence, un mot est choisi aléatoirement dans le fichier mots.txt.
La page affiche alors autant d’éléments (espaces vides, tirets, étoiles, images...) qu’il y a de
lettres dans le mot secret choisi.

Le joueur peut choisir, une lettre parmi les 26 qui composent l’alphabet (latin) et la renseigner
dans un “input” (ou assimilé).

Si le mot secret contient une ou plusieurs occurrences de la lettre renseignée par l’utilisateur,
celles-ci sont découvertes et affichées à leur position correspondante.
Si le mot secret ne contient aucune occurrence de la lettre choisie par le joueur, le dessin du
pendu s’enrichit d’un membre.

Un historique comporte l’ensemble des propositions faites.
La partie se termine quand toutes les lettres ont été trouvées (Victoire) ou quand le bonhomme
est pendu (Défaite). Un message spécifique apparaît alors et incite l’utilisateur à faire une
nouvelle partie. -->