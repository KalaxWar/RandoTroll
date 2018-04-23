<div class="col-sm-3" style="">
</div>
<div class='col-sm-6' style="background-color:#FDBA23;">
<h2 align='center'>Paramètre du compte</h2> <br>
<p align='center'>Vous pouvez changer vos informations personnelle ici</p>
<script>
    function confirmMDPasse()
    {
        var mdp = document.getElementById("txtMdp").value;
        var confirmMdp = document.getElementById("txtMdpConfirm").value;
        if(mdp == confirmMdp)
        {
            return true;
        }
        else{
            alert('Les Champs doivent être identique');
            document.getElementById("txtMdp").value = "";
            document.getElementById("txtMdpConfirm").value = "";
            document.getElementById("txtMdp").focus();
            return false;
        }
    }
</script>
<?php
   //echo form_open('Visiteur/inscription','class="form-horizontal" name="form"'); // j'ouvre mon form
   echo '<form onsubmit="return confirmMDPasse()" action="'.site_url('Responsable/MonCompte/1').'" method="post">';
?>
<label for="txtMdp"><span class='textBlanc'>Mot de passe :</span></label>
    <input type="password" name='txtMdp' id='txtMdp' class='form-control' required>
    <label for="txtMdpConfirm"><span class='textBlanc'>Confirmer le mot de passe : </span></label>
    <input type="password" name='txtMdpConfirm' id='txtMdpConfirm'class='form-control' required><br>
    <p align='center'><input type="submit" name='submit' value='Modifier' class='btn btn-primary'></p>