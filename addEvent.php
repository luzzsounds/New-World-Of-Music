<?php
include('inc/pdo.php');
session_start();
include('inc/header.php');

$error = array();

//si le formulaire est soumis
if ( !empty($_POST['submitidee']) ) {
    // Protection XSS
    $afficheEVENT = trim(strip_tags($_POST['afficheEVENT']));
    $nomEVENT = trim(strip_tags($_POST['nomEVENT']));
    $emailEVENT = trim(strip_tags($_POST['emailEVENT']));
    $dateheureEVENT = trim(strip_tags($_POST['dateheureEVENT']));
    $cp = trim(strip_tags($_POST['cp']));
    $ville = trim(strip_tags($_POST['ville']));
    $descriptionEVENT = trim(strip_tags($_POST['descriptionEVENT']));


    //verification auteur
    if (!empty($auteur)){
        if(strlen($auteur) < 3 ) {
            $error['auteur'] = 'Votre nom est trop court. (minimum 3 caractères)';
        } elseif(strlen($auteur) > 40) {
            $error['auteur'] = 'Votre nom est trop long.';
        }
    } else {
        $error['auteur'] = 'Veuillez entrer votre nom';
    }

    //verification idee
    if (!empty($idee)){
        if(strlen($idee) < 3 ) {
            $error['idee'] = 'Votre nom est trop court. (minimum 3 caractères)';
        } elseif(strlen($idee) > 220) {
            $error['idee'] = 'Votre nom est trop long.';
        }

    } else {
        $error['idee'] = 'Veuillez renseigner votre idée';
    }




            // Si aucune error
            if (count($error) == 0) {
                $sql = "INSERT INTO event (ID_Event,afficheEVENT,nomEVENT,emailEVENT,dateheureEVENT,cp,ville,descriptionEVENT)
                VALUES (:ID_Event,:afficheEVENT,:nomEVENT,:emailEVENT,:dateheureEVENT,:cp,:ville,:descriptionEVENT)";
                $query = $pdo->prepare($sql);

                $query->bindValue(':ID_Event', $ID_Event, PDO::PARAM_INT);
                $query->bindValue(':afficheEVENT', $afficheEVENT, PDO::PARAM_INT);
                $query->bindValue(':nomEVENT', $nomEVENT, PDO::PARAM_STR);
                $query->bindValue(':emailEVENT', $dateheureEVENT, PDO::PARAM_STR);
                $query->bindValue(':cp', $cp, PDO::PARAM_STR);
                $query->bindValue(':ville', $ville, PDO::PARAM_STR);
                $query->bindValue(':descriptionEVENT', $descriptionEVENT, PDO::PARAM_STR);

                $query->execute();
                die;
            }
}

?>


<div class="container">
    <form id="contact" action="" method="post">
        <h3>Ajouter un évenements</h3>
        <h5>BLABLABLA</h5>
        <fieldset>
            <h6>Affiche de l'évenements </h6>
            <input type="file" name="afficheEVENT">
        </fieldset>
        <fieldset>
            <input type="text" name="nomEVENT" id="auteur" class="form-control" value="<?php if(!empty($_POST['nomEVENT'])) { echo $_POST['nomEVENT']; } ?>" />
        </fieldset>
        <fieldset>
            <input type="mail" name="emailEVENT" id="auteur" class="form-control" value="<?php if(!empty($_POST['emailEVENT'])) { echo $_POST['emailEVENT']; } ?>" />
        </fieldset>
        <fieldset>
            <input type="date" name="dateheureEVENT" id="dateheureEVENT" class="form-control" value="<?php if(!empty($_POST['dateheureEVENT'])) { echo $_POST['dateheureEVENT']; } ?>" />
        </fieldset>
            <fieldset>
                <input name="cp" id="cp" type="text" placeholder="Code Postal (ex: 76200)" value="<?php if(!empty($_POST['cp'])) { echo $_POST['cp']; } ?>">
                <input name="ville" id="ville" type="text" placeholder="Ville" value="<?php if(!empty($_POST['ville'])) { echo $_POST['ville']; } ?>">
            </fieldset>

            <fieldset>
                <optgroupe>Tags Style de musique </optgroupe>

            </fieldset>
            <fieldset>
            <ul class="tags">
                <li class="addedTag">Dubstep<span onclick="$(this).parent().remove();" class="tagRemove">x</span><input type="hidden" name="tags[]" value="Dubstep"></li>

                <li class="addedTag">Techno<span onclick="$(this).parent().remove();" class="tagRemove">x</span><input type="hidden" name="tags[]" value="Techno"></li>

                <li class="addedTag">Hardstyle<span onclick="$(this).parent().remove();" class="tagRemove">x</span><input type="hidden" name="tags[]" value="Hardstyle"></li>
                <li class="tagAdd taglist">
                    <input type="text" id="search-field">
                </li>
            </ul>
            </fieldset>
        <fieldset>
            <textarea placeholder="Description du groupe.." name="descriptionEVENT" id="descriptionEVENT" type="text" value="<?php if(!empty($_POST['descriptionEVENT'])) { echo $_POST['descriptionEVENT']; } ?>" ></textarea>

        </fieldset>
        <fieldset>
            <button name="submit" type="submit" id="contact-submit" data-submit="...envoie">Envoyer</button>
        </fieldset>









            <!-------------------------------------------STYLE TAGS ---------------------------->
            <style>
                ol, ul {
                    list-style: outside none none;
                }
                #container {
                    margin: 0 auto;
                    width: 60rem;
                }
                .tags {
                    background: none repeat scroll 0 0 #fff;
                    border: 1px solid #ccc;
                    display: table;
                    padding: 0.5em;
                    width: 100%;
                }
                .tags li.tagAdd, .tags li.addedTag {
                    float: left;
                    margin-left: 0.25em;
                    margin-right: 0.25em;
                }
                .tags li.addedTag {
                    background: none repeat scroll 0 0 #ed6829;
                    border-radius: 2px;
                    color: #fff;
                    padding: 0.25em;
                }
                .tags input, li.addedTag {
                    border: 1px solid transparent;
                    border-radius: 2px;
                    box-shadow: none;
                    display: block;
                    padding: 0.5em;
                }
                .tags input:hover {
                    border: 1px solid #000;
                }
                span.tagRemove {
                    cursor: pointer;
                    display: inline-block;
                    padding-left: 0.5em;
                }
                span.tagRemove:hover {
                    color: #222222;
                }
                P, H1 {
                    text-align: center;
                }
                p {
                    color: #ccc;
                }
                h1 {
                    color: #6b6b6b;
                    font-size: 1.5em;
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
