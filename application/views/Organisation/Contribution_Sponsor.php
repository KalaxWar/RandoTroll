<br><section>
<div class="section-inner" style="background-color:#FDBA23;padding:20px;"><?php
   echo form_open('Administrateur_Organisation/Gestion_Sponsor'); // j'ouvre mon form
?>
<h2 align='center' class='TextBlanc'><b>Montant apporté</b></h2><br>
<p align='center'> 
    <input type="hidden" name="nosponsor" <?php if (isset($LeSponso['NOSPONSOR'])) {echo 'value="'.$LeSponso['NOSPONSOR'].'"';}?>>
    <label for="txtCommission"><span class='textBlanc'>Montant de cette année:</span></label>
    <input type="text" name='txtMontant' class='form-control' required <?php if (isset($Contribution['MONTANT'])) {echo 'value="'.$Contribution['MONTANT'].' €"';}?>><br>
    <input type='submit' name='SubmitContribution' value='Enregistrer' class='btn btn-warning'>
</p>
</form>
</div></div></section>