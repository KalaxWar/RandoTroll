<div class='container'>
<div class='col-sm-12' >
<div class="section-inner" style="background-color:#FDBA23;padding:20px;">
<table class="table table-Info table-hover">
<?php echo 
form_open('Recapitulatif/AffectationVague');
 ?>
<th>Nom</th><th>Parcours</th><th>Nombre de membre</th><th>Numéro de vague</th>
<?php
$noequipe = 0;
foreach ($LesEquipes as $UneEquipe) 
{
    if ($UneEquipe['NOEQUIPE'] <> $noequipe) {
        //------------- VAGUE
        if ($UneEquipe['VAGUE'] <> null)
        {
            $numVague = $UneEquipe['VAGUE'];
            $vague[$numVague] = 0;
        }
        //-------------
    }
}
foreach ($LesEquipes as $UneEquipe) 
{
    if ($UneEquipe['NOEQUIPE'] <> $noequipe) {
        $noequipe = $UneEquipe['NOEQUIPE'];
        //------------- VAGUE
        $numVague = $UneEquipe['VAGUE'];
        if ($UneEquipe['VAGUE'] <> null)
        {
            $nbMembre = $this->ModeleUtilisateur->GetNombreParticipantParEquipe($arrayName = array('NOEQUIPE' =>$noequipe));
            $vague[$numVague] += $nbMembre;
        }
        //-------------
    }
}
if (isset($vague)) {
    ksort($vague);
    echo '<p> Les effectifs par vagues sont : </p> <br>';
    foreach ($vague as $key => $value) 
    {
        if ($key > 0) {
            echo 'Vague n°'.$key.' : '.$value.'<br>';
        }
        
    }
    echo '<br><br>';
}
foreach ($LesEquipes as $UneEquipe) 
{
    if ($UneEquipe['NOEQUIPE'] <> $noequipe) {
        $noequipe = $UneEquipe['NOEQUIPE'];
        $nbMembre = $this->ModeleUtilisateur->GetNombreParticipantParEquipe($arrayName = array('NOEQUIPE' =>$noequipe)); //MAL FACON A NE PAS REPRODUIRE!!!
        echo '<tr><td>'.$UneEquipe['NOMEQUIPE'].'</td><td>'.$UneEquipe['KILOMETRAGE'].'</td><td>'.$nbMembre.'</td><td><input type="text" id="'.$nbMembre.'" name="'.$UneEquipe['NOEQUIPE'];
        if ($UneEquipe['VAGUE'] <> null)
        {
            echo '" value="'.$UneEquipe['VAGUE'].'"';
        }
        echo '"></tr>';
        
    }
}
echo '<tr><td><input type="submit" name="submit" class="btn"></td></tr>';
?>
</form>
</table>