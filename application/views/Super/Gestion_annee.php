<div class='container'>
<div class="row">
<div class='col-sm-3' >
</div>
<div class='col-sm-5' >
<section>
<div class="section-inner" style="background-color:#FDBA23;padding:20px;">
<?php
   echo form_open('Super_Administrateur/Gestion_annee'); // j'ouvre mon form
?>
<?php if (isset($ANNEE)) {echo '<h3 align="center"><span class="textBlanc">Modifier la course de cette année</span></h3>';}
else {
    echo "<h3 align='center'><span class='textBlanc'>Ajouter la course de cette année</span></h3>";
}?>
<br>
<p class='TextBlanc'><b>Année de la course : <?php echo date('Y')?></b></p>
<p align='center'> 
    <label for="DateCourse"><span class='textBlanc'>Date de course : *</span></label>
    <input type="date" name='DateCourse' class='form-control' required <?php if (isset($DATECOURSE)) {echo 'value="'.$DATECOURSE.'"';}?>>
    <label for="DateCloture"><span class='textBlanc'>Date de cloture des inscriptions *</span></label>
    <input type="date" name='DateCloture' class='form-control' required <?php if (isset($DATECLOTUREINSCRIPTION)) {echo 'value="'.$DATECLOTUREINSCRIPTION.'"';}?>>
    <label for="txtLimiteAge"><span class='textBlanc'>Limite d'âge : *</span></label>
    <input type="text" name='txtLimiteAge' class='form-control' required placeholder=' EX : 18'  <?php if (isset($LIMITEAGE)) {echo 'value="'.$LIMITEAGE.'"';}?>>
    <label for="txtInscriA"><span class='textBlanc'>Tarif inscription adulte : *</span></label>
    <input type="text" name='txtInscriA' class='form-control' required <?php if (isset($TARIFINSCRIPTIONADULTE)) {echo 'value="'.$TARIFINSCRIPTIONADULTE.'"';}?>>
    <label for="txtInscriE"><span class='textBlanc'>Tarif inscription enfant : *</span></label>
    <input type="text" name='txtInscriE' class='form-control' required <?php if (isset($TARIFINSCRIPTIONENFANT)) {echo 'value="'.$TARIFINSCRIPTIONENFANT.'"';}?>>
    <label for="txtRepasA"><span class='textBlanc'>Tarif repas adulte : *</span></label>
    <input type="text" name='txtRepasA' class='form-control' required <?php if (isset($TARIFREPASENFANT)) {echo 'value="'.$TARIFREPASENFANT.'"';}?>>
    <label for="txtRepasE"><span class='textBlanc'>Tarif repas enfant : *</span></label>
    <input type="text" name='txtRepasE' class='form-control' required <?php if (isset($TARIFREPASADULTE)) {echo 'value="'.$TARIFREPASADULTE.'"';}?>>
    <label for="txtParticipantMax"><span class='textBlanc'>Participant maximum : *</span></label>
    <input type="text" name='txtParticipantMax' class='form-control' required <?php if (isset($MAXPARTICIPANTS)) {echo 'value="'.$MAXPARTICIPANTS.'"';}?>>
    <label for="txtMaxParEquipe"><span class='textBlanc'>Maximum par équipe : *</span></label>
    <input type="text" name='txtMaxParEquipe' class='form-control' required <?php if (isset($MAXPAREQUIPE)) {echo 'value="'.$MAXPAREQUIPE.'"';}?>>
    <label for="txtMail"><span class='textBlanc'>Mail organisation : *</span></label>
    <input type="text" name='txtMail' class='form-control' required pattern='^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]{2,}[.][a-zA-Z]{2,4}$' <?php if (isset($MAILORGANISATION)) {echo 'value="'.$MAILORGANISATION.'"';}?>>
    <label for="txtCheminPdf"><span class='textBlanc'> </span>Chemin pdf livret :</label>
    <input type="text" name='txtCheminPdf' class='form-control'  <?php if (isset($CHEMINPDFLIVRET)) {echo 'value="'.$CHEMINPDFLIVRET.'"';}?>>
    <label for="txtCheminAffiche"><span class='textBlanc'> </span>Chemin image affiche :</label>
    <input type="text" name='txtCheminAffiche' class='form-control'  <?php if (isset($CHEMINIMAGEAFFICHE)) {echo 'value="'.$CHEMINIMAGEAFFICHE.'"';}?>>
    <label for="txtCheminAffichette"><span class='textBlanc'> </span>Chemin image affichette :</label>
    <input type="text" name='txtCheminAffichette' class='form-control'  <?php if (isset($CHEMINIMAGEAFFICHETTE)) {echo 'value="'.$CHEMINIMAGEAFFICHETTE.'"';}?>>
    <br>
    <?php
    if (isset($ANNEE)) {echo "<input type='submit' name='submitModif' value='Modifier' class='btn btn-primary'>";}
    else {echo "<input type='submit' name='submitForm' value='Ajouter' class='btn btn-primary'>";}?>
</p>
</form>