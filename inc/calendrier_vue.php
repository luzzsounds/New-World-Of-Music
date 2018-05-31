<?php
include ("modele_calendrier.php");

$mois = $_GET['mois'];
$anne = $_GET['anne'];
?>

<h1 style="text-align:center"><?php echo mois ($mois). "" .$anne;?><h1>
        <?php
calendrier ($mois,$anne);

?>
