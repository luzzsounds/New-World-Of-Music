

<form method="POST" action="" id="">

    <div class="form-group">

        <label for="titre">Inscription Utilisateur</label>


    <div>

        <input type="text" name="pseudo" id="pseudo" value="<?php if(!empty($_POST['pseudo'])) { echo $_POST['pseudo'];} ?>"/>

    </div>


    <div class="form-group">

        <input type="text" name="email" id="titre" value="<?php if(!empty($_POST['email'])) { echo $_POST['email']; } ?>"/>

    </div>


    <div class="form-group">

        <input type="text" name="password"  id="password"  value="<?php if(!empty($_POST['password'])) { echo $_POST['password']; } ?>"/>
        <input type="text" name="password2" id="password2" value="<?php if(!empty($_POST['password2'])) {echo $_POST['password2']; } ?>"/>

    </div>



    <input type="submit" value="S'inscrire" />
    <input type="hidden" name="frmRegistration"/>



</form>

<?php

if (isset($_POST['frmRegistration'])) {






$pseudo = $_POST['pseudo'] ? "";
$email = $_POST['email'] ? "";
$mdp = $_POST['password'] ? "";
    $mdp2 = $_POST['password2'] ? "";
    $token = tokengenerate(50);
    $createdat = $_POST['created_at'] ? "";

      $erreurs = array();

if ($pseudo == "") array_push($erreurs, "Veuillez saisir votre email");
if ($email == "") array_push($erreurs, "Veuillez saisir votre nom de groupe");
if ($mdp == "") array_push($erreurs, "Veuillez saisir votre mot de passe");
if ($mdp2 == "") array_push($erreurs, "Veuillez confirmer votre mot de passe");

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
     $mdp = hash('sha512',$mdp);
     $connection = mysqli_connect("localhost","root","","New-World-of-Music");

     $sql = " INSERT INTO users (pseudo,email,password,token,created_at,status)
              VALUES (:pseudo,:email,:password,:token,NOW(),1)";

            $query = $pdo->prepare($sql);
            $query ->bindValue(':pseudo',$nomgroupe,PDO::PARAM_STR);

            $query ->bindValue(':email',$email,PDO::PARAM_STR);
            $query ->bindValue(':mdp',$mdp,PDO::PARAM_STR);

            $query ->bindValue(':token',$token,PDO::PARAM_STR);

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


























?>