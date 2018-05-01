<div class="container"><br><br><br>
<div class="col-sm-4"></div>
<div class="col-sm-4" style="float:left;background-color:#FDBA23">
<h3 align='center'><span class='textBlanc'>Créer un compte équipe</span></h3>
<p class='textBlanc' align='center'>* = mention obligatoire</p>
<?php
   echo form_open('Visiteur/inscription'); // j'ouvre mon form
?> <!-- Fonction de Jquery -->
  <script> 
  $( function() {
    $( "#datepicker" ).datepicker({ 
      showOn: "button",
      dateFormat: 'dd/mm/yy',
      buttonImageOnly: false,
      buttonText: "Calendrier",
      changeMonth: true,
      changeYear: true,
      monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
      monthNamesShort: ['Janv.', 'Févr.', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil.', 'Août', 'Sept.', 'Oct.', 'Nov.', 'Déc.'],
      dayNamesMin: ['Dim.', 'Lu.', 'Ma.', 'Me.', 'Je.', 'Ve.', 'Sa.'],
      
    });
  } );
  </script> <!-- J'écris ensuite mon formulaire avec les contrôles de saisies -->
<br>
<p align='center'> 
    <input type="hidden" name='valide' value='1'>
    <label for="txtNom"><span class='textBlanc'>Nom : *</span></label>
    <input type="text" name='txtNom' class='form-control' required>
    <label for="txtPrenom"><span class='textBlanc'>Prénom : *</span></label>
    <input type="text" name='txtPrenom' class='form-control' required>
    <label for="txtTel"><span class='textBlanc'>Numéro de téléphone : *</span></label>
    <input type="text" name='txtTel' class='form-control' required>
    <label for="txtDate"><span class='textBlanc'>Date de naissance : *</span></label>
    <input type="text" name='txtDate' id="datepicker" placeholder='16/09/1999' class='form-control' title =" EX : 16/09/1999" required pattern='^([0]?[1-9]|[1|2][0-9]|[3][0|1])[./-]([0]?[1-9]|[1][0-2])[./-]([0-9]{4}|[0-9]{2})$'>
    <br><br><span class='textBlanc'><b>Sexe : *</b></span></label>
    <input type="radio" name='sexe' value ='H' required><span class='textBlanc'>Homme</span> |
    <span class='textBlanc'>Femme</span><input type="radio" name='sexe' value ='F' required><br><br>
    <label for="txtEquipe"><span class='textBlanc'>Nom de l'équipe : *</span></label>
    <input type="text" name='txtEquipe' class='form-control' required>
    <label for="txtMail"><span class='textBlanc'>Email : *</span></label>
    <input type="text" name='txtMail' class='form-control' required pattern='^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]{2,}[.][a-zA-Z]{2,4}$'>
    <label for="txtMdp"><span class='textBlanc'>Mot de passe : *</span></label>
    <input type="password" name='txtMdp' class='form-control' required>
    <br><br>
    <input type="submit" name="ok" value='Envoi' class='btn btn-primary'>
</p>
</form>
</div></div>