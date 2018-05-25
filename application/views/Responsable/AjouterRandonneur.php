</div>
<div class='col-sm-3' >
    <section>
    <div class="section-inner" style="background-color:#FDBA23;padding:20px;">
<?php if (isset($NOM)) 
{
    echo "<h4 align='center'><span class='textBlanc'>Modifier un randonneur</span></h4>";
}
else
{
    echo "<h4 align='center'><span class='textBlanc'>Ajouter un randonneur</span></h4>";
}?>

<br>
</form>
<?php 
if (isset($DATEDENAISSANCE))
{
    $var = $DATEDENAISSANCE;
    $date = str_replace('-', '/', $var);
    $date = date('d-m-Y', strtotime($date));
    $date = str_replace('-', '/', $date);
}

?>
<?php if (isset($NOM)) 
{
    echo '<form class="form-inline" action="'.site_url('Responsable/ModifierRandonneur/'.$NOPARTICIPANT).'" method="post">';
}
else
{
    echo '<form class="form-inline" action="'.site_url('Responsable/AjouterRandoneur').'" method="post">';
}?>
<input type="hidden" name='Valide' value='1'>
    <div class="form-group">
        <label for="txtNom"><span class='textBlanc'>Nom : *</span></label>
        <input type="text" name='txtNom' class='form-control' size='7' required <?php if (isset($NOM)) {echo 'value = '.$NOM;}?>>
    </div>
    <div class="form-group">
        <label for="txtNom"><span class='textBlanc'>Prénom : *</span></label>
        <input type="text" name='txtPrenom' class='form-control' size='7' required <?php if (isset($PRENOM)) {echo 'value = '.$PRENOM;}?>>
    </div>
    <div class="form-group">
        <label for="txtDate"><span class='textBlanc'>Date de naissance : *</span></label>
        
        <input type="text" name='txtDate' id="datepicker" placeholder='16/09/1999' class='form-control' title =" EX : 16/09/1999" required pattern='^([0]?[1-9]|[1|2][0-9]|[3][0|1])[./-]([0]?[1-9]|[1][0-2])[./-]([0-9]{4}|[0-9]{2})$' <?php if (isset($date)) {echo 'value = '.$date;}?>>
    </div>
    <br><br>
    <div class="checkbox">
    <label for="sexe"><span class='textBlanc'><b>Sexe : *</b></span></label>
    <label><input type="radio" name="sexe" required value='H'<?php if (isset($SEXE)) { if($SEXE=='H'){echo 'checked';}}?>><span class='textBlanc'> <b>Homme</b></span></label>
    <label><input type="radio" name="sexe" required value='F'<?php if (isset($SEXE)) { if($SEXE=='F'){echo 'checked';}}?>><span class='textBlanc'><b>Femme </b></span></label>
    </div>
    <br><br>
    <div class="form-group">
        <label for="txtMail"><span class='textBlanc'>Email : </span></label>
        <input type="text" name='txtMail' class='form-control' pattern='^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]{2,}[.][a-zA-Z]{2,4}$' <?php if (isset($MAIL)) {echo 'value = '.$MAIL;}?>>
    </div>
    <div class="form-group">
        <label for="txtTel"><span class='textBlanc'>Numéro de téléphone : </span></label>
        <input type="text" name='txtTel' class='form-control' size='7' <?php if (isset($TELPORTABLE)) {echo 'value = '.$TELPORTABLE;}?>>
    </div>  
   <br><br>
    <div class="checkbox">
    <label for="repas"><span class='textBlanc'><b>Repas sur place ? : *</b></span></label>
    <label><input type="radio" name="repas" value='1' required <?php if (isset($REPASSURPLACE)) { if($REPASSURPLACE==1){echo 'checked';}}?>><span class='textBlanc'><b>Oui</b></span>
    <label><input type="radio" name="repas" value='0' required <?php if (isset($REPASSURPLACE)) { if($REPASSURPLACE==0){echo 'checked';}}?>><span class='textBlanc'><b>Non </b></span>
    </div>
    <br><br>
    <?php if (isset($NOM)) 
{
    echo "<p align='center'><button type='submit' class='btn btn-success'>Modifier</button></p>";
}
else {
    echo "<p align='center'><button type='submit' class='btn btn-primary'>Ajouter à l'équipe</button></p>";
}
?>
  </form>
  </div>
  </section><br>