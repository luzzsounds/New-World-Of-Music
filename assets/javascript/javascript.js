
// Ajouter une option a un select

function AjoutOptionAuSelect(this_select)
{
    if (this_select.value == "Autre")

    {
        var saisie;
        var pass = false;
        do {
            if (pass) alert ("La valeur est incorrecte.Elle ne doit comporter que des lettres");

            saisie = prompt("Entrer nouveau style de musique");

            if (saisie == null) return false;
            pass = true;
        }

        while (saisie.match(/[^a-z]/i) && saisie != "")

        this_select.options[this_select.length-1] = new Option(saisie,saisie,true,true);




    }



}
