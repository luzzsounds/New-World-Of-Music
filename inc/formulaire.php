
<!--Formulaire Inscription Groupe-->



<?php

if (isset($_POST['frmRegistration'])) {


    if (isset($_POST['nom-groupe'])) {
        $nom-groupe = $_POST['nom-groupe'];
    }
    else {
        $nom-groupe = "";
    }
}

$pseudo = $_POST['pseudo'] ?? "";
$mail = $_POST['email'] ?? "";
$mdp = $_POST['password'] ?? "";
    $mdp2 = $_POST['password2'] ?? "";
    $token = tokengenerate(50);
    $createdat = $_POST['created_at'] ?? "";

      $erreurs = array();

if ($pseudo == "") array_push($erreurs, "Veuillez saisir votre email");
if ($mail == "") array_push($erreurs, "Veuillez saisir votre pseudo");
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
              VALUES (:pseudo,:mail,:password,:token,NOW(),1)";

            $query = $pdo->prepare($sql);
            $query ->bindValue(':pseudo',$pseudo,PDO::PARAM_STR);
            $query ->bindValue(':mail',$mail,PDO::PARAM_STR);
            $query ->bindValue('mdp',$mdp,PDO::PARAM_STR);
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

            };

}





?>




<form method="POST" action="" id="">

    <div class="form-group">

        <label for="titre">Inscription Groupe/Artiste </label>

<input type="text" name="nom-groupe" id="nom-groupe" value="<?php if(!empty($_POST['nom'])) { echo $_POST['nom']; } ?> "/>

    </div>

<div>

    <input type="text" name="lieu" id="group-location" value="<?php if(!empty($_POST['lieu'])) {echo $_POST['lieu'];} ?>"/>

</div>

    <div class="form-group">

        <input type="text" name="email" id="titre" value="<?php if(!empty($_POST['email'])) { echo $_POST['email']; } ?>"/>

    </div>


    <div class="form-group">

        <input type="text" name="password"  id="password"  value="<?php if(!empty($_POST['password'])) { echo $_POST['password']; } ?>"/>
        <input type="text" name="password2" id="password2" value="<?php if(!empty($_POST['password2'])) {echo $_POST['password2']; } ?>"/>

    </div>

    <div class="form-group">

        <select id="interet" multiple>
            <option value="Metal">Metal</option>
            <option value="Electro">Electro</option>
            <option value="Minimal">Minimal</option>
            <option value="Pop">Pop</option>
            <option value="Folk">Folk</option>
            <option value="Drum'n'Bass">Drum'n'Bass</option>
            <option value="Soul">Soul</option>
            <option value="Ragga,Dancehall">Ragga,DanceHall</option>
            <option value="Reggae">Reggae</option>
            <option value="Funk">Funk</option>
            <option value="House">House</option>
            <option value="Hip-Hop">Hip-Hop</option>
            <option value="Varietes">Variétés</option>
        </select>

    </div>

    <input type="submit" value="Envoyer" />







</form>