
<!--Formulaire Inscription Groupe-->







<form method="POST" action="" id="">

    <div class="form-group">

        <label for="titre">Inscription Groupe/Artiste </label>

<input type="text" name="nomgroupe" id="nomgroupe" value="<?php if(!empty($_POST['nomgroupe'])) { echo $_POST['nomgroupe']; } ?> "/>

    </div>



    <div class="form-group">

        <input type="text" name="email" id="titre" value="<?php if(!empty($_POST['email'])) { echo $_POST['email']; } ?>"/>

    </div>


    <div class="form-group">

        <input type="text" name="password"  id="password"  value="<?php if(!empty($_POST['password'])) { echo $_POST['password']; } ?>"/>
        <input type="text" name="password2" id="password2" value="<?php if(!empty($_POST['password2'])) {echo $_POST['password2']; } ?>"/>

    </div>

    <div class="form-group">

        <select id="musique" name="select" onchange="AjoutOptionAuSelect(this)">
            <option value="1">Metal</option>
            <option value="2">Electro</option>
            <option value="3">Minimal</option>
            <option value="4">Pop</option>
            <option value="5">Folk</option>
            <option value="6">Drum'n'Bass</option>
            <option value="7">Soul</option>
            <option value="8">Ragga,DanceHall</option>
            <option value="9">Reggae</option>
            <option value="10">Funk</option>
            <option value="11">House</option>
            <option value="12">Hip-Hop</option>
            <option value="13">Variétés</option>
        </select>

    </div>

    <input type="submit" value="S'inscrire" />
    <input type="hidden" name="frmRegistration" />






</form>

<?php

if (isset($_POST['frmRegistration'])) {


    if (isset($_POST['nomgroupe'])) {
        $nomgroupe = $_POST['nomgroupe'];
    }
    if(isset($_POST['select'])){
        echo "Option choisie :'.$_POST['select'].'";

        $resultat = $_POST['select'];
    }
    else {
        $nomgroupe = "";
    }
}


$nomgroupe = $_POST['nomgroupe'] ? "";
$email = $_POST['email'] ? "";
$mdp = $_POST['password'] ? "";
    $mdp2 = $_POST['password2'] ? "";
    $token = tokengenerate(50);
    $createdat = $_POST['created_at'] ? "";

      $erreurs = array();

if ($nomgroupe == "") array_push($erreurs, "Veuillez saisir votre email");
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

     $sql = " INSERT INTO users (nomgroupe,ville,email,password,token,created_at,status)
              VALUES (:nomgroupe,:ville,:email,:password,:token,NOW(),1)";

            $query = $pdo->prepare($sql);
            $query ->bindValue(':nomgroupe',$nomgroupe,PDO::PARAM_STR);

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
