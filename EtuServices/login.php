<?php
require_once("db_connect.php");

if (isset($_POST["connexion"])) {
    if (empty($_POST['mail'])) {
        echo "Veulliez saisir un mail.";
    } 
    else {
        if (empty($_POST['mdp'])) {
            echo "Veulliez saisir un mot de passe.";
        } 
        else {

            $mail = $_POST['mail'];
            $mdp = $_POST['mdp'];


            $sql="SELECT * FROM utilisateur WHERE mail='".$_POST["mail"]."' and mdp = '".$_POST["mdp"]."';";
            
            $result=mysqli_query($conn, $sql);
            
            if($result->fetch_array()==NULL){
                echo "La connexion a échouée";
            }
            else{
                $command = escapeshellcmd("python3.10.exe client_launcher.py $mail");
                echo $command;
                $output = shell_exec($command);
                echo $output;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
</head>

<title>Connexion</title>

<body>

    <div id="connect">

        <h2>Connexion</h2>
        
        <form id="informations" method="POST">
            Mail : <input type="email" name="mail" required></br>
            Mot de passe : <input type="password" name="mdp" required></br>
            <button type="submit" name="connexion">Connexion</button>
        </form>



    </div>

</body>