<link href="calendrier.css" rel="stylesheet" type="text/css" />
<?php

$mois = date("m");
$anne = date("Y");
?>
<div style="margin-bottom:5%" >
    <img id="pre" src="flep.png" height="40px" width="40px" style="float:left">
    <img id="post" src="flep2.png" height="40px" width="40px" style="float:right">
</div>

<div id="cont" >

</div>

<script src="jquery.js"></script>
<script>

    var mois = <?php echo $mois;?>;

    var anne = <?php echo $anne;?>;

    $(document).ready(function(){


        $("#cont").load("calendrier_vue.php?mois="+mois+"&anne="+anne,function(){});
// chargement initial
//  nous écrirons ici le reste du code

        $("#pre").click(function(){

            mois--; // on décrémente la variable

            if(mois < 1) //Si mois est inférieur a 1
            {
                anne--; // On décrémente anné
                mois = 12; // On affecte 12 a mois
            }

                // On charge notre calendrier

            $("#cont").load("calendrier_vue.php?mois="+mois+"&anne="+anne,function(){});

        });

        $("#post").click(function(){

            mois++;

            if(mois > 12)
            {
                anne++;
                mois = 1;
            }

            $("#cont").load("calendrier_vue.php?mois="+mois+"&anne="+anne,function(){});

        });

    });
</script>
