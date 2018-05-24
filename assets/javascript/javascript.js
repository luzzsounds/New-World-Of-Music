
// Ajouter une option a un select

function ajoutCategorie(){
    var x = document.getElementById("sel");
    var option = document.createElement("option");
    option.text = "ValeurCategorie";
    x.add(option);
}