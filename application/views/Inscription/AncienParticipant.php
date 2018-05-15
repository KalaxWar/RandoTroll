<div class='col-sm-12' >
<div class="section-inner" style="background-color:#FDBA23;padding:20px;">
<h2 align='center' class='TextBlanc'><b>Relance des anciens participant</b></h2><br>
<?php
echo form_open('Administrateur_Inscription/AncienParticipant');
echo '<p>écriver le contenu du mail ici puis valider :</p>';
$data = array(
     'type'  => 'textarea',
     'name'  => "email",
     'class' => 'form-control',
     'rows' => '5',
     'placeholder' => "Ecriver le contenu de votre mail ici",
   );
echo form_textarea($data);
?>
<input type='submit' name='submit' class='btn btn-primary' value ="Envoyer à tout les anciens participant">
</table>
