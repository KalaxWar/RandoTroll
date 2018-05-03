<br><h2 align='center' class='TextBlanc'><b>Récapitulatif</b></h2>
<br><br><table  class="table table-Info table-hover">
<th>Nom de l'équipe</th> <th>adultes</th><th> repas adultes</th> <th>enfants</th><th> repas enfants</th> <th>Prix total</th> <th>Manque a payer</th>
<?php
foreach ($LesEquipes as $UneEquipe) {
    echo '<tr><td>'.$UneEquipe['NomEquipe'].'</td><td>'.$UneEquipe['NBAdultesInscri'].'</td><td>'.$UneEquipe['NBrepasAdulte'].'</td><td>'.$UneEquipe['NBEnfantsInscri'].'</td><td>'.$UneEquipe['NBrepasEnfant'].'</td><td>'.$UneEquipe['PrixTotal'].' €</td><td class=TextBlanc><b>'.$UneEquipe['Manque'].' €</b></td></tr>';
}

?>

</table>