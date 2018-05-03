<table  class="table table-Info table-hover">
<th>Nom de l'équipe</th><th>Montant payé</th> <th>Montant Remboursé</th> <th>Mode de réglement</th><th></th>

<?php
echo 
form_open('Administrateur_Inscription/GestionPaiement');

echo '<tr><td>'.$NOMEQUIPE.'</td><td>';
echo '<input class="form-control" name=txtPaye size=5 value =';
if ($MONTANTPAYE=="") {
    echo '0€>';
}
else
{
    echo $MONTANTPAYE.'€>';
}
echo '</td><td>';
//------------------
echo '<input class="form-control" name=txtRembourse size=5 value =';
if ($MONTANTREMBOURSE=="") {
    echo '0€>';
}
else
{
    echo $MONTANTREMBOURSE.'€>';
}
echo '</td><td>';
//---------------
echo '<select class="form-control" name=reglement>';
echo '<option value=NULL>Rien de saisie</option>';
echo '<option value="Espèce" ';
if ($MODEREGLEMENT == 'Espèce') {
    echo 'selected>Espèce</option>';
}
else
{
    echo '>Espèce</option>';
}
//------------
echo '<option value="Chèque" ';
if ($MODEREGLEMENT == 'Chèque') {
    echo 'selected>Chèque</option>';
}
else
{
    echo '>Chèque</option>';
}
//-------------
if ($MODEREGLEMENT == 'Sponsort | Gratuit') {
    echo '<option value="Sponsort | Gratuit" selected> Sponsort | Gratuit</option>';
}
?>

<input type="hidden" name="noequipe" value='<?php echo $NOEQUIPE ?>'>
</td>
<td><input type="submit" value='Valider' name='submit2'class="btn"></td>
</tr>
</table>
</form>
<?php
echo form_open('Administrateur_Inscription/GestionPaiement');
?>
<input type="hidden" name="noequipe" value='<?php echo $NOEQUIPE ?>'>
<p align='center'   ><input type="submit" value="Forcer la validation de l'inscription" name='submit3'class="btn btn-success"></p>