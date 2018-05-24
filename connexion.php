/*------------------------------------------ CONNEXION  ------------------------------------------*/

/* ATTENTION NE PAS OUBLIER DE FAIRE EN SORTE QU'A LA CONNEXION DE FAIRE LA DIFFERENCE AVEC LES STATUS SIMPLE UTILISATEUR /  OU ARTISTE/ GROUPE */

<?php
// connexion.php
include('inc/pdo.php');


$errors = array();
$success = false;
session_start();
$title = 'Connexion';

if(!empty($_POST['submitconnexion'])) {
    // protection XSS
    $pseudo    = trim(strip_tags($_POST['pseudo']));
    $password  = trim(strip_tags($_POST['password']));

    // faire plus de verification +++++
    if(empty($pseudo)) {
        $errors['pseudo'] = 'Veuillez indiquer un pseudo.';
    }
    if(empty($password)) {
        $errors['password'] = 'Veuillez indiquer un password.';
    }
    // Si pas d'erreur => verification que compte existe
    if(count($errors) == 0) {
        // verifier si utilisateur existe et si mot de passe correspond.
        $sqluser = "SELECT * FROM users WHERE pseudo = :login OR email = :login";
        $smtp = $pdo->prepare($sqluser);
        $smtp->bindValue(':login',$pseudo);
        $smtp->execute();
        $user = $smtp->fetch();

        if(!$user) {
            $errors['pseudo'] = 'pseudo or email invalide.';
        } else {
            if(password_verify($password,$user['password'])) {
                $_SESSION['user'] = array(
                    'id'     => $user['id'],
                    'pseudo' => $user['pseudo'],
                    'status' => $user['status'],
                    'ip'     => $_SERVER['REMOTE_ADDR']
                    // Add ip +++
                );
                header('Location: index.php');
            } else {
                $errors['password'] = 'password invalide.';
            }
        }
    }
}
?>

<?php include('inc/header.php'); ?>
<h1>Connexion</h1>
<form method="POST" action="connexion.php" id="formconnexion">
    <div class="form-group">
        <label for="pseudo">Pseudo or email*</label>
        <span class="error"><?php if(!empty($errors['pseudo'])) { echo $errors['pseudo']; } ?></span>
        <input type="text" name="pseudo" id="pseudo" class="form-control" value="<?php if(!empty($_POST['pseudo'])) { echo $_POST['pseudo']; } ?>" />
    </div>

    <div class="form-group">
        <label for="password">Password*</label>
        <span class="error"><?php if(!empty($errors['password'])) { echo $errors['password']; } ?></span>
        <input type="text" name="password" id="password" class="form-control" value="<?php if(!empty($_POST['password'])) { echo $_POST['password']; } ?>" />
    </div>

    <input type="submit" name="submitconnexion" value="Connexion" class="btn btn-default" />
</form>


<?php include('inc/footer.php'); ?>
