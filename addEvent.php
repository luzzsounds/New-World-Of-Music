<?php
include('inc/pdo.php');
session_start();
$error = array();

//si le formulaire est soumis

if ( !empty($_POST['submitidee']) ) {

    // Protection XSS

    $afficheEVENT = trim(strip_tags($_POST['afficheEVENT']));
    $nomEVENT = trim(strip_tags($_POST['nomEVENT']));
    $emailEVENT = trim(strip_tags($_POST['emailEVENT']));
    $cp = trim(strip_tags($_POST['cp']));
    $ville = trim(strip_tags($_POST['ville']));
    $descriptionEVENT = trim(strip_tags($_POST['descriptionEVENT']));

    //verification affiche event

    if (!empty($afficheEVENT)){
        if(strlen($afficheEVENT) < 3 ) {
            $error['auteur'] = 'Votre nom est trop court. (minimum 3 caractères)';
        } elseif(strlen($afficheEVENT) > 40) {
            $error['afficheEVENT'] = 'Votre nom est trop long.';
        }

    } else {
        $error['afficheEVENT'] = 'Veuillez entrer votre nom';
    }

    //verification nom event

    if (!empty($nomEVENT)){
        if(strlen($nomEVENT) < 3 ) {
            $error['nomEVENT'] = 'Nom trop court. (minimum 3 caractères)';
        } elseif(strlen($nomEVENT) > 70) {
            $error['nomEVENT'] = 'Le nom de lévenements et trop long.';
        }
    } else {
        $error['nomEVENT'] = 'Veuillez entrer le nom de lévenement';
    }

    //verification emailEVENT

    if (!empty($emailEVENT)){
        if(strlen($emailEVENT) < 1 ) {
            $error['emailEVENT'] = 'Votre email est trop court. (minimum 3 caractères)';
        } elseif(strlen($emailEVENT) > 40) {
            $error['emailEVENT'] = 'Votre email est trop long.';
        }
    } else {
        $error['auteur'] = 'Veuillez entrer votre email';
    }

    // code postal

    if (!empty($cp)){
        if(strlen($cp) < 3 ) {
            $error['cp'] = 'Votre code postal est trop court. (minimum 3 caractères)';
        } elseif(strlen($cp) > 5) {
            $error['cp'] = 'Votre code postal est trop long.';
        }
    } else {
        $error['cp'] = 'Veuillez entrer votre code postal';
    }

    //descriptionEVENT

    if (!empty($descriptionEVENT)){
        if(strlen($descriptionEVENT) < 0 ) {
            $error['descriptionEVENT'] = 'Votre description est trop court. (minimum 3 caractères)';
        } elseif(strlen($descriptionEVENT) > 150) {
            $error['descriptionEVENT'] = 'Votre descritpion est trop long.';
        }
    } else {
        $error['descriptionEVENT'] = 'Veuillez entrer votre description';
    }

    // Si aucune error
    $connection = mysqli_connect("localhost","root","","new-world-of-music");
    if (count($error) == 0) {
        $sql = "INSERT INTO event (afficheEVENT,nomEVENT,emailEVENT,dateheureEVENT,cp,ville,descriptionEVENT)
                VALUES ( :afficheEVENT , :nomEVENT , :emailEVENT , :dateheureEVENT , :cp , :ville , :descriptionEVENT )";
        $stmt = $pdo->prepare($sql);


        $query = $pdo->prepare($sql);
        $query ->bindValue(':Pseudo', $Pseudo, PDO::PARAM_STR);
        $query ->bindValue(':Email', $Email, PDO::PARAM_STR);
        $query ->bindValue(':Password', $Mdp, PDO::PARAM_STR);
        $query ->bindValue(':Token', $Token, PDO::PARAM_STR);
        $query ->execute();
        // Protection injections SQL

        $stmt->bindValue(':afficheEVENT', $afficheEVENT, PDO::PARAM_INT);
        $stmt->bindValue(':nomEVENT', $nomEVENT, PDO::PARAM_STR);
        $stmt->bindValue(':emailEVENT', $emailEVENT, PDO::PARAM_STR);
        $stmt->bindValue(':dateheureEVENT', $dateheureEVENT, PDO::PARAM_STR);
        $stmt->bindValue(':cp', $cp, PDO::PARAM_STR);
        $stmt->bindValue(':ville', $ville, PDO::PARAM_STR);
        $stmt->bindValue(':descriptionEVENT', $descriptionEVENT, PDO::PARAM_STR);

        $stmt->execute();
        die;

    }
}
    if (isset($_POST['submit'])){
    //Traitement du formulaire valide
    $alerte = "Votre message a bien été envoyé";

    //Traitement du formulaire non valide
    $alerte = "Echec de l'envoi";
}
    if (isset($alerte)) { echo $alerte; }
?>
<?php
include('inc/header.php'); ?>

<form id="contact" action="" method="post">
    <h3>Ajouter un évenements</h3>
    <fieldset>
        <h6>Affiche de l'évenements </h6>
        <input type="file" name="afficheEVENT">
    </fieldset>


    <fieldset>
        <span class="error"><?php if(!empty($error['nomEVENT'])) { echo $error['nomEVENT']; } ?></span>
        <input type="text" placeholder="Nom de l'evenements" name="nomEVENT" id="auteur"  value="<?php if(!empty($_POST['nomEVENT'])) { echo $_POST['nomEVENT']; } ?>" />
    </fieldset>
    <fieldset>
        <span class="error"><?php if(!empty($error['emailEVENT'])) { echo $error['emailEVENT']; } ?></span>
        <input type="email" name="emailEVENT" id="auteur" placeholder="Email"  value="<?php if(!empty($_POST['emailEVENT'])) { echo $_POST['emailEVENT']; } ?>" />
    </fieldset>
    <fieldset>
        <span class="error"><?php if(!empty($error['dateheureEVENT'])) { echo $error['dateheureEVENT']; } ?></span>
        <input type="date" name="dateheureEVENT" id="dateheureEVENT" class="form-control" value="<?php if(!empty($_POST['dateheureEVENT'])) { echo $_POST['dateheureEVENT']; } ?>" />
    </fieldset>
    <fieldset>
        <span class="error"><?php if(!empty($error['cp'])) { echo $error['cp']; } ?></span>
        <input name="cp" id="cp" type="text" placeholder="Code Postal (ex: 76200)" value="<?php if(!empty($_POST['cp'])) { echo $_POST['cp']; } ?>">
        <span class="error"><?php if(!empty($error['ville'])) { echo $error['ville']; } ?></span>
        <input name="ville" id="ville" type="text" placeholder="Ville" value="<?php if(!empty($_POST['ville'])) { echo $_POST['ville']; } ?>">
    </fieldset>
    <fieldset>
        <optgroupe>Tags Style de musique ( ajouter le bout de codce pour les tags</optgroupe>
    </fieldset>
    <fieldset>
        <!-- <ul class="tags">
             <li class="addedTag">Dubstep<span onclick="$(this).parent().remove();" class="tagRemove">x</span><input type="hidden" name="tags[]" value="Dubstep"></li>

             <li class="addedTag">Techno<span onclick="$(this).parent().remove();" class="tagRemove">x</span><input type="hidden" name="tags[]" value="Techno"></li>

             <li class="addedTag">Hardstyle<span onclick="$(this).parent().remove();" class="tagRemove">x</span><input type="hidden" name="tags[]" value="Hardstyle"></li>
             <li class="tagAdd taglist">
                 <input type="text" id="search-field">
             </li>
         </ul>-->
    </fieldset>
    <fieldset>
        <span class="error"><?php if(!empty($error['descriptionEVENT'])) { echo $error['descriptionEVENT']; } ?></span>
        <textarea placeholder="Description du groupe.." name="descriptionEVENT" id="descriptionEVENT" type="text" value="<?php if(!empty($_POST['descriptionEVENT'])) { echo $_POST['descriptionEVENT']; } ?>" ></textarea>
    </fieldset>
    <fieldset>
        <button type="submit" name="submitidee" id="contact-submit" data-submit="...envoie">Envoyer</button>
    </fieldset>

    </form>
<?php
include('inc/footer.php'); ?>







    <!-------------------------------------------STYLE DU FORMULAIRE----------------------------->

<style>


    .container {
        max-width: 400px;
        width: 100%;
        margin: 0 auto;
        position: relative;
    }

    #contact input[type="text"],
    #contact input[type="email"],
    #contact input[type="tel"],
    #contact input[type="url"],
    #contact textarea,
    #contact button[type="submit"] {
        font: 400 12px/16px "Roboto", Helvetica, Arial, sans-serif;
    }

    #contact {
        background: #F9F9F9;
        padding: 25px;
        margin: 150px 0;
        box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
    }



    fieldset {
        border: medium none !important;
        margin: 0 0 10px;
        min-width: 100%;
        padding: 0;
        width: 90%;
    }

    #contact input[type="text"],
    #contact input[type="email"],
    #contact input[type="tel"],
    #contact input[type="url"],
    #contact textarea {
        width: 100%;
        border: 1px solid #ccc;
        background: #FFF;
        margin: 0 0 5px;
        padding: 5px;
    }



    #contact button[type="submit"] {
        cursor: pointer;
        width: 100%;
        border: none;
        background: #ed6829;
        color: #FFF;
        margin: 0 0 5px;
        padding: 10px;
        font-size: 15px;
    }

    #contact button[type="submit"]:hover {
        background: #ed6829;
        -webkit-transition: background 0.3s ease-in-out;
        -moz-transition: background 0.3s ease-in-out;
        transition: background-color 0.3s ease-in-out;
    }

</style>
<script>
    /*-------------------------------------------SCRIPT AUTO COMPLETION----------------------------*/
    $("#cp").autocomplete({
        source: function (request, response) {
            $.ajax({
                url: "https://api-adresse.data.gouv.fr/search/?postcode="+$("input[name='cp']").val(),
                data: { q: request.term },
                dataType: "json",
                success: function (data) {
                    var postcodes = [];
                    response($.map(data.features, function (item) {
                        // Ici on est obligé d'ajouter les CP dans un array pour ne pas avoir plusieurs fois le même
                        if ($.inArray(item.properties.postcode, postcodes) == -1) {
                            postcodes.push(item.properties.postcode);
                            return { label: item.properties.postcode + " - " + item.properties.city,
                                city: item.properties.city,
                                value: item.properties.postcode
                            };
                        }
                    }));
                }
            });
        },
        // On remplit aussi la ville
        select: function(event, ui) {
            $('#ville').val(ui.item.city);
        }
    });
    $("#ville").autocomplete({
        source: function (request, response) {
            $.ajax({
                url: "https://api-adresse.data.gouv.fr/search/?city="+$("input[name='ville']").val(),
                data: { q: request.term },
                dataType: "json",
                success: function (data) {
                    var cities = [];
                    response($.map(data.features, function (item) {
                        // Ici on est obligé d'ajouter les villes dans un array pour ne pas avoir plusieurs fois la même
                        if ($.inArray(item.properties.postcode, cities) == -1) {
                            cities.push(item.properties.postcode);
                            return { label: item.properties.postcode + " - " + item.properties.city,
                                postcode: item.properties.postcode,
                                value: item.properties.city
                            };
                        }
                    }));
                }
            });
        },
        // On remplit aussi le CP
        select: function(event, ui) {
            $('#cp').val(ui.item.postcode);
        }
    });
    $("#adresse").autocomplete({
        source: function (request, response) {
            $.ajax({
                url: "https://api-adresse.data.gouv.fr/search/?postcode="+$("input[name='cp']").val(),
                data: { q: request.term },
                dataType: "json",
                success: function (data) {
                    response($.map(data.features, function (item) {
                        return { label: item.properties.name, value: item.properties.name};
                    }));
                }
            });
        }
    });
    /*-------------------------------------------SCRIPT TAGS----------------------------*/
    $.expr[":"].contains = $.expr.createPseudo(function(arg) {
        return function( elem ) {
            return $(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
        };
    });
    $(document).ready(function() {
        $('#addTagBtn').click(function() {
            $('#tags option:selected').each(function() {
                $(this).appendTo($('#selectedTags'));
            });
        });
        $('#removeTagBtn').click(function() {
            $('#selectedTags option:selected').each(function(el) {
                $(this).appendTo($('#tags'));
            });
        });
        $('.tagRemove').click(function(event) {
            event.preventDefault();
            $(this).parent().remove();
        });
        $('ul.tags').click(function() {
            $('#search-field').focus();
        });
        $('#search-field').keypress(function(event) {
            if (event.which == '13') {
                if (($(this).val() != '') && ($(".tags .addedTag:contains('" + $(this).val() + "') ").length == 0 ))  {



                    $('<li class="addedTag">' + $(this).val() + '<span class="tagRemove" onclick="$(this).parent().remove();">x</span><input type="hidden" value="' + $(this).val() + '" name="tags[]"></li>').insertBefore('.tags .tagAdd');
                    $(this).val('');

                } else {
                    $(this).val('');

                }
            }
        });

    });
</script>

