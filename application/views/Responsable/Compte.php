<div class="col-sm-3" style="">
</div>
<div class='col-sm-6' style="background-color:#FDBA23;">
<h2 align='center'>Paramètre du compte</h2> <br>
<p align='center'>Vous pouvez changer vos informations personnelle ici <br>Vous voulez modifier votre mot de passe ? cliquez ici <?php echo "<a href='".site_url('Responsable/MonCompte/1')."'><button type='submit' name='ah' class='btn btn-primary btn-xs'>Modifier le mot de passe</button></a>"?></p>

<?php
   echo form_open('Responsable/MonCompte','class="form-horizontal"'); // j'ouvre mon form
?>
    <label for="txtNom"><span class='textBlanc'>Nom : *</span></label>
    <input type="text" name='txtNom' class='form-control' required value="<?php echo $NOM?>">
    <label for="txtPrenom"><span class='textBlanc'>Prénom : *</span></label>
    <input type="text" name='txtPrenom' class='form-control' required value="<?php echo $PRENOM?>">
    <label for="txtTel"><span class='textBlanc'>Numéro de téléphone : *</span></label>
    <input type="text" name='txtTel' class='form-control' required value="<?php echo $TELPORTABLE?>">
    <label for="txtEquipe"><span class='textBlanc'>Nom de l'équipe : *</span></label>
    <input type="text" name='txtEquipe' class='form-control' required value="<?php echo $NOMEQUIPE?>">
    <label for="txtMail"><span class='textBlanc'>Email : *</span></label>
    <input type="text" name='txtMail' class='form-control' required pattern='^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]{2,}[.][a-zA-Z]{2,4}$' value="<?php echo $MAIL?>">
    <br><br>
    <p align='center'><input type="submit" name="submit" value='Sauvegarder les informations' class='btn btn-primary'></p>
    </form>