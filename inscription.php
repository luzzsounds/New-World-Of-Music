<?php
include ("assets/functions/function.php");
include ("inc/pdo.php");
?>

<form method="POST" action="" id="">

    <div class="form-group">

        <label for="titre">Inscription Utilisateur</label>


    <div>

        <input type="text" name="pseudo" id="pseudo" placeholder="Pseudo" value="<?php if(!empty($_POST['pseudo'])) { echo $_POST['pseudo'];} ?>"/>

    </div>


    <div class="form-group">

        <input type="text" name="email" id="email" placeholder="Email" value="<?php if(!empty($_POST['email'])) { echo $_POST['email']; } ?>"/>

    </div>


    <div class="form-group">

        <input type="text" name="password"  id="password" placeholder="Mot de Passe" value="<?php if(!empty($_POST['password'])) { echo $_POST['password']; } ?>"/>
        <input type="text" name="password2" id="password2" placeholder="Confirmer votre Mot de Sasse" value="<?php if(!empty($_POST['password2'])) {echo $_POST['password2']; } ?>"/>

    </div>



    <input type="submit" value="S'inscrire" />
    <input type="hidden" name="frmRegistration"/>



</form>

<?php

if (isset($_POST['frmRegistration'])) {


$Pseudo = $_POST['pseudo'] ?? "";
$Email = $_POST['email'] ?? "";
$Mdp = $_POST['password'] ?? "";
    $Mdp2 = $_POST['password2'] ?? "";
    $Token = tokengenerate(50);

      $erreurs = array();

if ($Pseudo == "") array_push($erreurs, "Veuillez saisir votre email");
if ($Email == "") array_push($erreurs, "Veuillez saisir votre nom de groupe");
if ($Mdp == "") array_push($erreurs, "Veuillez saisir votre mot de passe");
if ($Mdp2 == "") array_push($erreurs, "Veuillez confirmer votre mot de passe");

if (count($erreurs) > 0) {
    $message = "<ul>";

    foreach($erreurs as $ligneMessage) {
        $message .= "<li>";
        $message .= $ligneMessage;
        $message .= "</li>";
    }

    $message .= "</ul>";
    echo $message ;

}

else {
     $Mdp = hash('sha256',$Mdp);
     $connection = mysqli_connect("localhost","root","","new-world-of-music");

    $sql = "INSERT INTO users (Pseudo,Email,Password, Token  ) VALUES ( :Pseudo , :Email , :Password , :Token)";

    $query = $pdo->prepare($sql);
    $query ->bindValue(':Pseudo', $Pseudo, PDO::PARAM_STR);
    $query ->bindValue(':Email', $Email, PDO::PARAM_STR);
    $query ->bindValue(':Password', $Mdp, PDO::PARAM_STR);
    $query ->bindValue(':Token', $Token, PDO::PARAM_STR);
    $query ->execute();

            if (!$connection) {
                die("Erreur MySqL" . mysqli_connect_errno() . " | " . mysqli_connect_error());
                }

                else {
                if (mysqli_query($connection,$sql)) {
                    echo "Données enregistrées";
                }

                else {
                    echo "Erreur";
                }

            mysqli_close($connection);
            }

            }
};





?>





















