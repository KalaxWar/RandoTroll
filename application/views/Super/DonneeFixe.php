<style>
  .selectioné {
      color: #C40000;
  }
  </style>
  <div class="container">
  <nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" <?php echo "href='".site_url('Super_Administrateur')."'" ?>>Espace Administrateur</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a <?php echo "href='".site_url('Super_Administrateur/Gestion_annee')."'" ?>>Gestion des années</a></li>
      <li><a <?php echo "href='".site_url('Super_Administrateur/Gestion_Droit')."'" ?>>Gestion des droits</a></li>
      <li><a <?php echo "href='".site_url('Super_Administrateur/Mailing_Remerciements')."'" ?>>mailing remerciement sponsor</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a <?php echo "href='".site_url('Visiteur/seDeConnecter')."'" ?>><span class="glyphicon glyphicon-log-in"></span> Se déconnecter</a></li>
    </ul>
  </div>
</nav>
