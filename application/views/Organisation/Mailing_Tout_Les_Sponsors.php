<div class='col-sm-12' >
<div class="section-inner" style="background-color:#FDBA23;padding:20px;">
<h2 align='center' class='textBlanc'> <b> Envoi d'email à TOUT les sponsors confondu</b></h2>
<?php
echo form_open('Administrateur_Organisation/Mailing_Remerciements');
echo '<p>écriver le contenu du mail ici puis valider :</p>';
echo '<label>Objet du mail: <input type="text" name="txtObject" required></label>';
echo '<textarea name="email"  rows="5" placeholder="Ecriver le contenu de votre mail ici" required class="form-control"></textarea>';
?>
<br>
<input type='submit' name='submit' class='btn btn-primary' value ="Envoyer à TOUT les sponsors">
</table>
