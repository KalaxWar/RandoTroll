<div class='container'>
<div class='col-sm-12' >
<div class="section-inner" style="background-color:#FDBA23;padding:20px;">
<ul class="nav nav-tabs nav-justified">
<h1 align='center' class='TextBlanc'><b>Tableau de bord</b></h1><br>
<h3 align='center' class='TextBlanc'><b>INSCRIPTION</b></h3><br>
<table  class="table table-Info table-hover">
<th> </th>
<?php 
$totalEquipe = 0;
$totalParticipant = 0;
$totalAdultes = 0;
$totalEnfant = 0;
$totalMaxParcours=0;
foreach ($Lesparcours as $key => $UnParcours) {
    echo '<th>'.$key.'kms</th>';
    //-- Calculs des sommes de chaques lignes.
    $totalEquipe += $UnParcours['NBEquipe'];
    //--
    $somme = $UnParcours[0]+$UnParcours[1]; // [0] = adultes | [1] = enfants.
    $totalParticipant += $somme;
    //--
    $totalAdultes += $UnParcours[0];
    //--
    $totalEnfant += $UnParcours[1];
    //--
    $totalMaxParcours += $UnParcours[2];
}
echo '<th> TOTAL </th>';
//---------------------------------------
echo '<tr><td>Nombre d\'équipe inscrite et validée</td>';
foreach ($Lesparcours as $UnParcours) {
    $Pourcentage = round($UnParcours['NBEquipe'] * 100 / $totalEquipe);
    echo '<td>'.$UnParcours['NBEquipe'].' ('.$Pourcentage.' %)</td>';
}
echo '<td>'.$totalEquipe.' (100%)</td>';
//----------------------------------------
echo '</tr><tr><td>Nombre de participant ADULTES</td>';
foreach ($Lesparcours as $UnParcours) {
    $Pourcentage = round($UnParcours[0] * 100 / $totalAdultes);
    echo '<td>'.$UnParcours[0].' ('.$Pourcentage.' %)</td>';
}
echo '<td>'.$totalAdultes.' (100%)</td>';
//----------------------------------------
echo '</tr><tr><td>Nombre de participant ENFANTS</td>';
foreach ($Lesparcours as $UnParcours) {
    $Pourcentage = round($UnParcours[1] * 100 / $totalEnfant);
    echo '<td>'.$UnParcours[1].' ('.$Pourcentage.' %)</td>';
}
echo '<td>'.$totalEnfant.' (100%)</td>';
//----------------------------------------
echo '</tr><tr><td>Nombre de participant TOTAL</td>';
foreach ($Lesparcours as $UnParcours) {
    $somme = $UnParcours[0]+$UnParcours[1]; // [0] = adultes | [1] = enfants.
    $Pourcentage = round($somme * 100 / $totalParticipant);
    echo '<td>'.$somme.' ('.$Pourcentage.' %)</td>';
}
echo '<td>'.$totalParticipant.' (100%)</td>';
//----------------------------------------
echo '</tr><tr><td>Nombre maximum de participant</td>';
foreach ($Lesparcours as $UnParcours) {
    if ($UnParcours[2] == null) {
        echo '<td>Non définie</td>';
    }
    else
    {
        echo '<td>'.$UnParcours[2].'</td>';
    }
}
if ($totalMaxParcours == 0) {
    echo '<td>Non définie</td>';
}
else
{
    echo '<td>'.$totalMaxParcours.'</td>';
}
?>
</table>
<h3 align='center' class='TextBlanc'><b>REPAS</b></h3><br>
<table  class="table table-Info table-hover">
<th> </th><th>Nombres de repas</th><th>Nombre d'inscription</th>
<tr><td>Adultes</td><td><?php echo $NombreRepasAdultes?></td><td><?php echo $totalAdultes?></td></tr>
<tr><td>Enfants</td><td><?php echo $NombreRepasEnfants?></td><td><?php echo $totalEnfant?></td></tr>
</table>
<br><br>
<h4 class='TextBlanc'><b>TOTAL encaissé : <?php echo $TotalEncaisse ?> €</b></h4><br>