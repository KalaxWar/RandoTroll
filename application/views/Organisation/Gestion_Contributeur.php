<div class='container'>
<div class='col-sm-5' >
<section>
<div class="section-inner" style="background-color:#FDBA23;padding:20px;">
<?php if (isset($NOM)) {echo '<h3 align="center"><span class="textBlanc">Modifier un contributeur</span></h3>';}
else {
    echo "<h3 align='center'><span class='textBlanc'>Créer un contributeur</span></h3>";
}?>
<p class='textBlanc' align='center'>* = mention obligatoire</p>
<?php
   echo form_open('Administrateur_Organisation/Gestion_Contributeur'); // j'ouvre mon form
?>
<br>
<p align='center'> 
<input type="hidden" name="nocontributeur" <?php if (isset($NOCONTRIBUTEUR)) {echo 'value="'.$NOCONTRIBUTEUR.'"';}?>>
    <label for="txtNom"><span class='textBlanc'>Nom : *</span></label>
    <input type="text" name='txtNom' class='form-control' required <?php if (isset($NOM)) {echo 'value="'.$NOM.'"';}?>>
    <label for="txtPrenom"><span class='textBlanc'>Prénom : *</span></label>
    <input type="text" name='txtPrenom' class='form-control' required <?php if (isset($PRENOM)) {echo 'value="'.$PRENOM.'"';}?>>
    <label for="txtMail"><span class='textBlanc'>Email : *</span></label>
    <input type="text" name='txtMail' class='form-control' required pattern='^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]{2,}[.][a-zA-Z]{2,4}$' <?php if (isset($EMAIL)) {echo 'value="'.$EMAIL.'"';}?>>
    <label for="txtTelPortable"><span class='textBlanc'>Numéro de téléphone Portable : </span></label>
    <input type="text" name='txtTelPortable' class='form-control'  <?php if (isset($TELPORTABLE)) {echo 'value="'.$TELPORTABLE.'"';}?>>
    <label for="txtTelFixe"><span class='textBlanc'>Numéro de téléphone fixe: </span></label>
    <input type="text" name='txtTelFixe' class='form-control'  <?php if (isset($TELFIXE)) {echo 'value="'.$TELFIXE.'"';}?>>
    <label for="txtAdresse"><span class='textBlanc'>Adresse : </span></label>
    <input type="text" name='txtAdresse' class='form-control'  <?php if (isset($ADRESSE)) {echo 'value="'.$ADRESSE.'"';}?>>
    <label for="txtCP"><span class='textBlanc'>Code postal : </span></label>
    <input type="text" name='txtCP' class='form-control'  <?php if (isset($CODEPOSTAL)) {echo 'value="'.$CODEPOSTAL.'"';}?>>
    <label for="txtVille"><span class='textBlanc'>Ville : </span></label>
    <input type="text" name='txtVille' class='form-control'  <?php if (isset($VILLE)) {echo 'value="'.$VILLE.'"';}?>>
    <br><span class='textBlanc'><b>Type : *</b></span></label>
    <label><input type="checkbox" name="Bene"  value='B'<?php if (isset($bene['NOCONTRIBUTEUR'])) {echo 'disabled checked';}?>><span class='textBlanc'> <b>Bénévole</b></span></label>
    <label><input type="checkbox" name="Sponso"  value='S'<?php if (isset($sponso['NOCONTRIBUTEUR'])) {echo 'disabled checked';}?>><span class='textBlanc'><b>Sponsor </b></span></label>
    <br><br>
    <?php
    if (isset($NOM)) {echo "<input type='submit' name='submitModif' value='Envoi' class='btn btn-primary'>";}
else {echo "<input type='submit' name='submitForm' value='Envoi' class='btn btn-primary'>";}?>
</p>
</form>
</div></div></section>