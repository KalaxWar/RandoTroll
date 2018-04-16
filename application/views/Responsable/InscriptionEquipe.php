
<section>
    <div class="section-inner" style="background-color:#FDBA23;padding:20px;">
<?php 
echo form_open('Responsable/inscriptionEquipe','class="form-inline"');
echo '<h4 align=center><b>Inscrire l\'équipe ('.$NombreDInscrit.' membres)</b></h4>';
echo '<p align=center><select name="Parcours" class="form-control" id="Select-parcours" required>';
echo '<option selected value="">Choisissez un parcours</option>';
foreach ($LesParcours as $UnParcours) {

  echo '<option size="20" value="'.$UnParcours['NOPARCOURS'].'"';
  if ($ParcoursChoisis['NOPARCOURS'] == $UnParcours['NOPARCOURS'])
  {
      echo 'selected';
  }
  echo '>Parcours '.$UnParcours['KILOMETRAGE'].' kms </option>';
}
echo '</select></p>';
if ($ParcoursChoisis) {
    echo '<p align="center"><input type="submit" class="btn btn-info" value="Changer de parcours"></p>';
}
else
{
    echo "<p align='center'><input type='submit' class='btn btn-info' value='Inscrire'></p>";
}
?>

 <br><br>