<style>
  .selectioné {
      color: #C40000;
  }
  </style>
  <div class="container">
  <nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" <?php echo "href='".site_url('Administrateur_Organisation')."'" ?>>Espace Administrateur</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a <?php echo "href='".site_url('Administrateur_Organisation/Gestion_Contributeur')."'" ?>>Gestion des contributeur</a></li>
      <li><a <?php echo "href='".site_url('Administrateur_Organisation/Gestion_Sponsor')."'" ?>>Gestion des sponsor</a></li>
      <li><a <?php echo "href='".site_url('Administrateur_Organisation/Gestion_Benevoles')."'" ?>>Gestion des bénévoles</a></li>
      <li><a <?php echo "href='".site_url('Administrateur_Organisation/Mailing_Remerciements')."'" ?>>mailing remerciement sponsor</a></li>
      <li><a <?php echo "href='".site_url('Administrateur_Organisation/Mailing_Tout_Les_Sponsors')."'" ?>>mailing relance sponsor</a></li>
      <li><a <?php echo "href='".site_url('Recapitulatif/TableauDeBord')."'" ?>>Tableau de bord</a></li>
      <li><a <?php echo "href='".site_url('Recapitulatif/AffectationVague')."'" ?>>Affecter les équipes à des vagues de départ</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a <?php echo "href='".site_url('Visiteur/seDeConnecter')."'" ?>><span class="glyphicon glyphicon-log-in"></span> Se déconnecter</a></li>
    </ul>
  </div>
</nav>
