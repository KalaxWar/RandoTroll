<div class='col-sm-12' >
<div class="section-inner" style="background-color:#FDBA23;padding:20px;">
<h2 align='center' class='TextBlanc'><b>Impayés</b></h2><br>
<?php 
echo form_open('Administrateur_Inscription/Relance');
echo '<p>écriver le contenu du mail ici puis valider :</p>';
$data = array(
     'type'  => 'textarea',
     'name'  => "email",
     'class' => 'form-control',
     'rows' => '5',
     'placeholder' => "Ecriver le contenu de votre mail ici",
   );
echo form_textarea($data);
?>
<pre>il manque la somme de : *** €.
Attention la date de cloture des inscription est le <?php echo $datefin; ?>.
Cordialement, l'équipe RANDOTROLL.</pre>
<input type='submit' name='submit' class='btn btn-primary' value ="Envoyer toutes les relances">
<br><br><table  class="table table-Info table-hover">
<th>Nom de l'équipe</th> <th>adultes</th><th> repas adultes</th> <th>enfants</th><th> repas enfants</th> <th>Prix total</th> <th>Manque a payer</th>
<?php
foreach ($LesEquipes as $UneEquipe) {
    echo '<tr><td>'.$UneEquipe['NomEquipe'].'</td><td>'.$UneEquipe['NBAdultesInscri'].'</td><td>'.$UneEquipe['NBrepasAdulte'].'</td><td>'.$UneEquipe['NBEnfantsInscri'].'</td><td>'.$UneEquipe['NBrepasEnfant'].'</td><td>'.$UneEquipe['PrixTotal'].' €</td><td class=TextBlanc><b>'.$UneEquipe['Manque'].' €</b></td></tr>';
}

?>

</table>