<div class='col-sm-5' >
<section>
<div class="section-inner" style="background-color:#FDBA23;padding:20px;"><?php
   echo form_open('Super_Administrateur/Gestion_Droit'); // j'ouvre mon form
?>
<h2 align='center' class='TextBlanc'><b>Gestion de ses droits</b></h2><br>
<p align='center'> 
<input type="hidden" name="nocontributeur" <?php if(isset($NOCONTRIBUTEUR)){echo "value=$NOCONTRIBUTEUR";}?>>
<?php if (!(isset($PROFIL))) {
    $PROFIL= "";
}?>
    <select name="Droit" required class="form-control" id="">
        <option value="">-- Choisir un droit --</option>
        <option value="inscription" <?php if($PROFIL == 'inscription'){echo ' selected';}?>>Administrateur inscription</option>
        <option value="organisation" <?php if($PROFIL == 'organisation'){echo ' selected';}?>>Administrateur organisation</option>
        <option value="super" <?php if($PROFIL == 'super'){echo ' selected';}?>>Super administrateur</option>
    </select>
    <br>
    <input type='submit' name='submitAjout' <?php if($PROFIL <> ""){echo "value='Modifier'";}else{echo "value='Ajouter'";}?> class='btn btn-warning'>
    <?php if(isset($PROFIL)){echo "<a href='".site_url('Super_Administrateur/Retrograder/'.$NOCONTRIBUTEUR)."' class='btn btn-danger'>Supprimer les droits</a>";}?>
    
</p>
</form>
</div></div></div></section>