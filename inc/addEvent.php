<?php
include('pdo.php');
session_start();
include('header.php');
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
            $query->bindValue(':Date/Heure',$Date/Heure,PDO::PARAM_INT);
            $query->bindValue(':CatégorieMusique',$Catégorie_Musique,PDO::PARAM_INT);
            $query->bindValue(':CodePostal',$CodePostal,PDO::PARAM_INT);
            $query->bindValue(':Ville',$Ville,PDO::PARAM_INT);
            $query->bindValue(':NomEVENT',$Nom_EVENT,PDO::PARAM_INT);
            $query->bindValue(':EmailEVENT',$Email_EVENT,PDO::PARAM_INT);
            $query->bindValue(':ExtraitMusiqueEVENT',$ExtraitMusique_EVENT,PDO::PARAM_INT);
            $query->bindValue(':AfficheEVENT',$Affiche_EVENT,PDO::PARAM_INT);

            $query->execute();
            ?>
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

        </fieldset>

        <fieldset>
            <textarea placeholder="Description du groupe.." tabindex="5" required></textarea>
        </fieldset>
        <fieldset>
            <button name="submit" type="submit" id="contact-submit" data-submit="...envoie">Envoyer</button>
        </fieldset>

    </form>
</div>







