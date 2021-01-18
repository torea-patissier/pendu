<?php

class pendu
{
    public $id;
    public $login;
    public $password;
    public $confpassword;

    //Function pour se connecter à la Db 
    public function connectDb()
    {
        $local = 'mysql:host=localhost;dbname=reservationsalles';
        $user = 'root';
        $pass = '';
        try {
            $db = new PDO($local, $user, $pass);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $db;
        // Important le return sinon la function ne marche pas
    }

    // Function pour s'inscrire
    public function register()
    {
        if (isset($_POST['envoyer'])) {
            //Connexion Db
            $con = $this->connectDb();
            //HTMLSPECHARS
            $login = htmlspecialchars($_POST['login']);
            $password = htmlspecialchars($_POST['password']);
            $confpassword = htmlspecialchars($_POST['confpassword']);
            // Hashage mdp
            $options = ['cost' => 12,];
            $hash = password_hash($password, PASSWORD_BCRYPT, $options);
            //Vérifier si un login est déjà existant
            $stmt = $con->prepare("SELECT * FROM utilisateurs WHERE login =?");
            $stmt->execute([$login]);
            $user = $stmt->fetch();
            if ($user) {
                // Si il existe déjà echo message d'erreur
                echo '<br/> Identifiant déjà existant';
                return $user;
                // Vérifier si les MDP sont les mêmes
            }
            if ([$password] != [$confpassword]) {
                echo '<br/> Mot de passe incorrecte';
                return $password;
            } else { // Si oui on créer le compte en Db
                $sql = $con->query("SELECT * FROM utilisateurs WHERE login = '$login' ");
                $newuser = $con->prepare("INSERT INTO utilisateurs (login, password) VALUES (?,?)");
                $newuser->execute(array($login, $hash));
                echo ' <br/> Votre compte à bien été créer';
                return $newuser;
            }
        }
    }

    public function connect()
    {

        $con = $this->connectDb();
        $stmt = $con->prepare("SELECT * FROM utilisateurs");
        $stmt->execute();
        $result = $stmt->fetchAll();
        if (isset($_POST['connecter'])) {
            $login = htmlspecialchars($_POST['login']);
            $password = htmlspecialchars($_POST['password']);
            $session = $_SESSION['id'];
            for ($i = 0; isset($result[$i]); $i++) { // Boucle for pour parcourir le tableau
                $logcheck = $result[$i]['login']; // On recupère le login dans le tableau parcouru
                $passcheck = $result[$i]['password']; // Et ici le MDP 
                $idcheck = $result[$i]['id'];
                if ($login == $logcheck and password_verify($password, $passcheck) == TRUE) { // Si Login et MDP == aux valeurs dans le tab alors co + Verify pass 
                    $_SESSION['login'] = $logcheck;
                    $_SESSION['id'] = $idcheck;
                    $_SESSION['password'] = $passcheck;

                    header('location:http://localhost:8888/reservation-salles/profil/profil.php');
                    return [$login, $password]; // JA-MAIS DE EXIT DANS LA BOUCLE FOR
                }
            }
            if (password_verify($password, $passcheck) == FALSE) {
                echo 'Identifiant ou mot de passe incorrecte';
                return FALSE;
            }
        }
    }

    public function profil()
    {

        if (isset($_POST['modifier'])) {
            $log = $this->login;
            $con = $this->connectDb();
            $stmt = $con->prepare("SELECT * FROM utilisateurs WHERE login = '$log' ");
            $stmt->execute();
            $fetch = $stmt->fetch(PDO::FETCH_ASSOC);
            $login = htmlspecialchars($_POST['login']);
            $mdp = htmlspecialchars($_POST['password']);
            $conf =  htmlspecialchars($_POST['confpass']);
            $options = ['cost' => 12,];
            $hash = password_hash($mdp, PASSWORD_BCRYPT, $options);

            if (!empty($_POST['login'])) {
                $requete = "UPDATE utilisateurs SET login='$login' WHERE id = '" . $_SESSION['id'] . "' ";
                $sql = $con->prepare($requete);
                $sql->execute();
                $_SESSION['login'] = $_POST['login'];
                echo '<br/> Login modifié ';
            }
            if ($mdp != $conf) {
                echo ('<br/> Mot de passe incorrecte ');
            } elseif (!empty($_POST['password'])) {

                $requete = "UPDATE utilisateurs SET password='$hash' WHERE id = '" . $_SESSION['id'] . "' ";
                $sql = $con->prepare($requete);
                $sql->execute();
                $_SESSION['password'] = $_POST['password'];

                echo '<br/> Mot de passe modifié ';
            }
        }
    }

    public function destroy_txt() 
    {
        global $delete_txt;
        unset($delete_txt);
}
}
