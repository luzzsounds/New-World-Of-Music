<?php

function mois($nb)
{
    $key = $nb -1;
    $ap = array("Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Aout","Septembre","Octobre","Novembre","Décembre");

        return $ap[$key];
}

function calendrier ($mois,$anne)
{
    $nbjour = cal_days_in_month (CAL_GRGORIAN,$mois,$anne); //nombre de jour dans le mois

    echo "<table class='p' >";
    for ($i = 1; $nbjour >= $i; $i++)
    {
        $p = cal_to_jd(CAL_GREGORIAN,$mois,$i,$anne); //formater jour
        $jourweek = jddayofweek($p); // jour de la semaine

        if($i == $nbjour)
        {
            if($jourweek == 1 )
            {
                echo "<tr>";
            }

        echo "<td class='plein'>".$i."</td></tr>";

        }
        else if($i == 1)
        {
            echo "<tr>";

            if($jourweek == 0)
            {
                $jourweek = 7;
            }

        for($b = 1;$b != $jourweek; $b++)
        {
            echo "<td></td>";
        }

        echo "<td class='plein'>" .$i." </td>";

            if($jourweek == 7)
            {
                echo "<tr>";
            }


        }
    }

    echo "</table>";
}

?>