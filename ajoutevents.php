<?php
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
      <input placeholder="Ajouter un extrait de musique" type="url" tabindex="4" required>

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






















































<style>
    @import url(https://fonts.googleapis.com/css?family=Roboto:400,300,600,400italic);
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        -webkit-font-smoothing: antialiased;
        -moz-font-smoothing: antialiased;
        -o-font-smoothing: antialiased;
        font-smoothing: antialiased;
        text-rendering: optimizeLegibility;
    }


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

    #contact h3 {
        display: block;
        font-size: 30px;
        font-weight: 300;
        margin-bottom: 10px;
    }

    #contact h4 {
        margin: 5px 0 15px;
        display: block;
        font-size: 13px;
        font-weight: 400;
    }

    fieldset {
        border: medium none !important;
        margin: 0 0 10px;
        min-width: 100%;
        padding: 0;
        width: 100%;
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
        padding: 10px;
    }

    #contact input[type="text"]:hover,
    #contact input[type="email"]:hover,
    #contact input[type="tel"]:hover,
    #contact input[type="url"]:hover,
    #contact textarea:hover {
        -webkit-transition: border-color 0.3s ease-in-out;
        -moz-transition: border-color 0.3s ease-in-out;
        transition: border-color 0.3s ease-in-out;
        border: 1px solid #aaa;
    }

    #contact textarea {
        height: 100px;
        max-width: 100%;
        resize: none;
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

    #contact button[type="submit"]:active {
        box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.5);
    }

    .copyright {
        text-align: center;
    }

    #contact input:focus,
    #contact textarea:focus {
        outline: 0;
        border: 1px solid #aaa;
    }

    ::-webkit-input-placeholder {
        color: #888;
    }

    :-moz-placeholder {
        color: #888;
    }

    ::-moz-placeholder {
        color: #888;
    }

    :-ms-input-placeholder {
        color: #888;
    }
</style>