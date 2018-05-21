<div class='col-sm-5' >
<section>
<div class="section-inner" style="background-color:#FDBA23;padding:20px;"><?php
   echo form_open('Administrateur_Organisation/Gestion_Benevoles'); // j'ouvre mon form
?>
<h2 align='center' class='TextBlanc'><b>Ajouter une commission</b></h2><br>
<p align='center'> 
    <label for="txtCommission"><span class='textBlanc'>Nom de la commission à ajouter: *</span></label>
    <input type="text" name='txtCommission' class='form-control' required><br>
    <input type='submit' name='submitAjout' value='Ajouter' class='btn btn-warning'>
</p>
</form>
</div></div></div></section>