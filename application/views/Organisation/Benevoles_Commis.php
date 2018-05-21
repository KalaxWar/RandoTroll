<br><div class="row">
<div class='col-sm-6' >
<section>
<div class="section-inner" style="background-color:#FDBA23;padding:20px;">
<h3 align='center' class='textBlanc'>Bénévoles COMMIS :</h3>
<table class="table table-Info table-hover">
<h3 align='center' class='textBlanc'><u>Commis :</u></h3>
<?php 
foreach ($LesCommissions as $UneCommission) {
    echo '<tr><td>'.$UneCommission['LIBELLE'].' :</td><td>';
    foreach ($Participer as $UnParticipant) 
    {
        if ($UnParticipant['NOCOMMISSION'] == $UneCommission['NOCOMMISSION']) 
        {
            echo $UnParticipant['PRENOM'].' '.$UnParticipant['NOM']."<br>";
        }
    }
    echo '</td><tr>';
}
?>
</table>
</div></div></section>