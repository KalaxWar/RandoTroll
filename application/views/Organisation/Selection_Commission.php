<div class='col-sm-4' >
<section>
<div class="section-inner" style="background-color:#FDBA23;padding:20px;">
<h3 align='center' class='textBlanc'>Bénévole SELECTIONNÉ : <b><?php echo $personne['PRENOM'].' '.$personne['NOM'];?></b> </h3>
<table class="table table-Info table-hover">
<h3 align='center' class='textBlanc'><u>Commission :</u></h3>
<?php 
if (empty($LesCommissionsPasInscrit)) {
    echo '<p align="center">Aucune autre commission à attribuer</p>';
}
foreach ($LesCommissionsPasInscrit as $UneCommission) {
    echo '<tr><td>'.$UneCommission['LIBELLE'].'</td>';
    echo "<td><a href='".site_url('Administrateur_Organisation/Ajout_Participer_Commission/'.$UneCommission['NOCOMMISSION'].'/'.$personne['NOCONTRIBUTEUR'])."'> <button class='btn btn-success'>ATTRIBUER</button></a>
    </td></tr>";
}
foreach ($LesCommissionsInscrit as $UneCommission) {
    echo '<tr><td>'.$UneCommission['LIBELLE'].'</td>';
    echo "<td><a href='".site_url('Administrateur_Organisation/Supprimer_Participer_Commission/'.$UneCommission['NOCOMMISSION'].'/'.$personne['NOCONTRIBUTEUR'])."'> <button class='btn btn-danger'>RETIRER</button></a>
    </td></tr>";
}
?>
</table>

</div></div></section>