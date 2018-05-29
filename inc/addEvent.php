<?php
include('inc/pdo.php');
session_start();
include('inc/header.php');
?>

<div class="container">
    <form id="contact" action="" method="post">
        <h3>Ajouter un évenements</h3>
        <h5>BLABLABLA</h5>
        <fieldset>
            <h6>Affiche de l'évenements </h6>
            <input type="file" name="file">
        </fieldset>
        <fieldset>
            <input placeholder="Nom de l'évenements" type="text" tabindex="1" required autofocus>
        </fieldset>
        <fieldset>
            <input placeholder="Adresse Mail" type="text" tabindex="2" required>
        </fieldset>
        <fieldset>
            <input placeholder="Ajouter un extrait de musique" type="url" tabindex="4">

            <fieldset>
                <input name="cp" id="cp" type="text" placeholder="Code Postal (ex: 76200)">
                <input name="ville" id="ville" type="text" placeholder="Ville">
            </fieldset>

            <fieldset>
                <optgroupe>Tags Style de musique </optgroupe>

            </fieldset>
            <ul class="tags">
                <li class="addedTag">Dubstep<span onclick="$(this).parent().remove();" class="tagRemove">x</span><input type="hidden" name="tags[]" value="Dubstep"></li>

                <li class="addedTag">Techno<span onclick="$(this).parent().remove();" class="tagRemove">x</span><input type="hidden" name="tags[]" value="Techno"></li>

                <li class="addedTag">Hardstyle<span onclick="$(this).parent().remove();" class="tagRemove">x</span><input type="hidden" name="tags[]" value="Hardstyle"></li>
                <li class="tagAdd taglist">
                    <input type="text" id="search-field">
                </li>
            </ul>
            <?php
            $sql = "INSERT INTO event (ID_Event,Description_EVENT,Date/Heure,Catégorie_Musique,CodePostal,Ville,Nom_EVENT,Email_EVENT,ExtraitMusique_EVENT,Affiche_EVENT)
            VALUES (:idevent,:descriptionevent,:date/heure,:catégoriemusique,:codepostal,:ville,:nomevent,:emailevent,:extraitmusiqueevent,:afficheevent)";
            $query = $pdo->prepare($sql);
            $query->bindValue(':IDEvent',$ID_Event,PDO::PARAM_INT);
            $query->bindValue(':DescriptionEVENT',$Description_EVENT,PDO::PARAM_INT);
            $query->bindValue(':DateHeure',$Date/Heure,PDO::PARAM_INT);
            $query->bindValue(':CatégorieMusique',$Catégorie_Musique,PDO::PARAM_INT);
            $query->bindValue(':CodePostal',$CodePostal,PDO::PARAM_INT);
            $query->bindValue(':Ville',$Ville,PDO::PARAM_INT);
            $query->bindValue(':NomEVENT',$Nom_EVENT,PDO::PARAM_INT);
            $query->bindValue(':EmailEVENT',$Email_EVENT,PDO::PARAM_INT);
            $query->bindValue(':ExtraitMusiqueEVENT',$ExtraitMusique_EVENT,PDO::PARAM_INT);
            $query->bindValue(':AfficheEVENT',$Affiche_EVENT,PDO::PARAM_INT);

            $query->execute();
            ?>



