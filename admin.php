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

$fichier = fopen('mots.txt', 'r+');

$i = 1;

while ($i <= 100){
    $ligne = fgets($fichier);
    echo $ligne . "<br />";
    $i++;
}

if (isset($_POST['valider'])){
    $text = htmlspecialchars($_POST['mot']);
    $table = array($text);


    if(strpos($text, $i)){
        echo "Le mot existe déjà dans la liste";
        exit;
    }else{
        foreach ($table as $test){ 
            if(ctype_alpha($test)){
                if(is_writable('mots.txt')){
                file_put_contents("mots.txt", "\n$text", FILE_APPEND);
                header('Location: http://localhost/pendu/admin.php');
                }
            }
        }
    }
}



if (isset($_POST['valide'])){
    $lines = file('mots.txt');
    $search = htmlspecialchars ($_POST['supprimer']);
    $result = "";

    foreach($lines as $line){
        if (stripos($line, $search) === false) {
            $result .= $line;
        }
    }
    preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "", 'mots.txt');
    header('Location: http://localhost/pendu/admin.php');
    file_put_contents('mots.txt', $result);
}







fclose($fichier);
?> 
</body>

</html>


<!-- PENSER AUX DOUBLONS AVANT DE RENDRE LE PROJET -->