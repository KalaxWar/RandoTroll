<style>
  .selectioné {
      color: #C40000;
  }
  </style>
  <div class="container">
  <nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" <?php echo "href='".site_url('Administrateur_Inscription')."'" ?>>Espace Administrateur</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a <?php echo "href='".site_url('Administrateur_Inscription/EquipePasPayer')."'" ?>>Relance paiement</a></li>
      <li><a <?php echo "href='".site_url('Administrateur_Inscription/GestionPaiement')."'" ?>>Gestion paiement</a></li>
      <li><a <?php echo "href='".site_url('Administrateur_Inscription/ticket')."'" ?>>Génération des tickets</a></li>
      <li><a <?php echo "href='".site_url('Administrateur_Inscription/AncienParticipant')."'" ?>>Relance anciens participant</a></li>
      <li><a <?php echo "href='".site_url('Recapitulatif/TableauDeBord')."'" ?>>Tableau de bord</a></li>
      <li><a <?php echo "href='".site_url('Recapitulatif/AffectationVague')."'" ?>>Affecter les équipes à des vagues de départ</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a <?php echo "href='".site_url('Visiteur/seDeConnecter')."'" ?>><span class="glyphicon glyphicon-log-in"></span> Se déconnecter</a></li>
    </ul>
  </div>
</nav>
