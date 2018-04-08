<div class="container"><br><br><br>
<div class="col-sm-4"></div>
<div class="col-sm-4" style="float:left;background-color:#FDBA23">
<h3 align='center'><span class='textBlanc'>Authentification</span></h3>
<?php
   echo form_open('Visiteur/Connexion');
?>
<input type="hidden" name='valide' value='1'>
<p align='center'><label for="txtLogin"><span class='textBlanc'>Email :</span></label>
<input type="text" name='txtLogin' class='form-control' required> <br>
<label for="txtLogin"><span class='textBlanc'>Mot de passe :</span></label>
<input type="password" name='txtMdp' class='form-control' required>
<br>
<?php echo "<a href=".site_url('Visiteur/inscription')." class='textBlanc'>Toujours pas inscrit ? Cliquez ici</a>"?>
<br><br>
<input type="submit" name="ok" value='Envoi' class='btn btn-primary'></p>
</form>
</div>