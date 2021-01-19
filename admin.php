<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>

<body>

    <form action="admin.php" method="POST">
        <label>Ajouter un mot</label>
        <input type="text" name="addmot">
        <input type="submit" name="valider">
        <label>Supprimer un mot</label>
        <input type="text" name="delmot">
        <input type="submit" name="supprimer" value="Supprimer">
    </form>
    <br />

    <?php

    $fichier = file("mots.txt"); //Nom du fichier
    fopen('mots.text', 'a'); // Ouverture du fichier
    $total = count($fichier); //Retourne le nb total de mots dans le fichier
    $tableau = array($fichier);

    for ($i = 0; $i < $total; $i++) { // Boucle FOR pour parcourir les valeurs du fichier mots texte
        $alpha = $fichier[$i];
        echo nl2br($alpha); //nl2br pour revenir à la ligne
    }

    // <?php
    // $input = array("a" => "green", "red", "b" => "green", "blue", "red");
    // $result = array_unique($input);
    // print_r($result);


    if (isset($_POST['valider'])) { // Si on appuie sur le bouton valider

        $text = htmlspecialchars(lcfirst($_POST['addmot'])); //Le mot entré devient $text
        $table = array($text);

        preg_replace("/(^[\r\n]|[\r\n]+)[\s\t][\r\n]+/", "", 'mots.txt'); // Supprimer les espaces vide 

        // for ($i = 0; $i < $total; $i++) { // Boucle FOR pour parcourir les valeurs du fichier mots texte
        //     $alpha = $fichier[$i];
        //     if ($text == $alpha) {
        //     echo "<br />"."Le mot existe déjà";
        //     exit;
        //     }
        // }
        
        $result = array_unique($tableau);

        if($result != $text){
            foreach ($table as $test) {
                if (ctype_alpha($test)){
                    if (is_writable('mots.txt')) { // Si le fichier est accessible en écriture
                        file_put_contents("mots.txt", "\n$text", FILE_APPEND); // fileputcontent to write content in a file  \n pour revenir à la ligne 
    
                        //& FILE APPEND Annexez le contenu du fichier existant.
                        header('Location: http://localhost:8888/pendu/admin.php');
                    }
                } else {
                    echo '<br />' . 'Seul les lettres sont acceptés';
                    return false;
                }
            }
        }else{
            echo'Non';
            exit;
        }
    }

    if (isset($_POST['supprimer'])) {
        $lines = file('mots.txt');
        $search = htmlspecialchars($_POST['delmot']);
        $result = "";

        foreach ($lines as $line) {
            if (stripos($line, $search) === false) {
                $result .= $line;
            }
        }
        preg_replace("/(^[\r\n]|[\r\n]+)[\s\t][\r\n]+/", "", 'mots.txt');
        header('Location: http://localhost:8888/pendu/admin.php');

        file_put_contents('mots.txt', $result);
    }
// BONUS AJOUTER LA VERIF DES DOUBLONS

    ?>
</body>

</html>


