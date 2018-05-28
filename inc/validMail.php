
<?php



// On vérifie si les paramètres d'URL 'id' et 'token' existent
if (isset($_GET['id']) && isset($_GET['token'])) {


    // S'ils existent, on les récupère pour les affecter à des variables plus simples à manipuler
    $id = $_GET['id'];
    $token = $_GET['token'];

    // Connexion à la base de données
    $connection = mysqli_connect("localhost", "root", "", "new-world-of-music");


    // On vérifie si la connexion est OK. En cas de problème, on affiche le numéro d'erreur et l'erreur correspondante
    if (!$connection) {
        die("Erreur MySQL " . mysqli_connect_errno() . " | " . mysqli_connect_error());
    }
    else {
        $requeteVerif = "SELECT * FROM users
                        WHERE pseudo=$id
                        AND token='$token'";

        if ($resultatRequete = mysqli_query($connection, $requeteVerif)) {

            $nbrResultats = mysqli_num_rows($resultatRequete);

            mysqli_free_result($resultatRequete);

            if ($nbrResultats > 0) {

                $requeteUpdate = "UPDATE users
                                SET USEVERIF=1
                                WHERE pseudo=$id";

                if (mysqli_query($connection, $requeteUpdate)) {
                    echo "Inscription validée";

                }

                else {
                    echo "Inscription pas validée, mais alors pas validée du tout";
                }
            }

            else {
                echo "<h1>Bien tenté, mais essaie encore</h1>";
            }
        }
        else {
            echo "Erreur";
        }
        mysqli_close($connection);
    }
}
else {
    echo "<h1>Bien tenté, mais essaie encore</h1>";
}