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
        <input type="text" name="mot">
        <input type="submit" name="valider">
        <label>Supprimer un mot</label>
        <input type="text" name="supprimer">
        <input type="submit" name="valide" value="Supprimer">
    </form>
    <br />
    <?php

$fichier = fopen('mots.txt', 'r+');
$fichier2 = file("mots.txt");
$count = count($fichier2);
$i = 1;

while ($i <= $count){
    $ligne = fgets($fichier);
    echo $ligne . "<br />";
    $i++;
}

if (isset($_POST['valider'])){
    $text = htmlspecialchars($_POST['mot']);
    $table = array($text);

    foreach ($table as $test){ 
        if(ctype_alpha($test)){
            if(is_writable('mots.txt')){
                file_put_contents("mots.txt", "\n$text", FILE_APPEND);
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
    file_put_contents('mots.txt', $result);
}







fclose($fichier);
?> 
</body>

</html>


<!-- PENSER AUX DOUBLONS AVANT DE RENDRE LE PROJET -->