<div class='col-sm-12' >
<div class="section-inner" style="background-color:#FDBA23;padding:20px;">
<h2 align='center' class='textBlanc'> <b> Envoi d'email</b></h2>
<?php
echo form_open('Super_Administrateur/Mailing');
echo '<p>écriver le contenu du mail ici puis valider :</p>';
echo '<label>Objet du mail: <input type="text" name="txtObject" required></label>';
echo '<textarea name="email"  rows="5" placeholder="Ecriver le contenu de votre mail ici" required class="form-control"></textarea>';
?>
<br>
<label><input type="checkbox" name="sponsor"checked>Envoyer aux sponsors</label><br>
<label><input type="checkbox" name="participant" checked>Envoyer aux participant </label><br>

<label><input type="radio" name="qui" value='2' required ><span class='textBlanc'><b>Tous de toutes les années confondu</b></span><br>
<label><input type="radio" name="qui" value='1' required ><span class='textBlanc'><b>Tous de l'année en cours </b></span><br><br>
<input type='submit' name='submit' class='btn btn-primary' value ="Envoyer">
</table>
