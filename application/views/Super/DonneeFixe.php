<style>
  .selectioné {
      color: #C40000;
  }
  </style>
  <div class="container">
  <nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
    <?php 
      if ($this->session->profil == 'super') 
      {
        echo '<li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Changer d\'administrateur
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="'.site_url('Super_Administrateur').'">Super Administrateur</a></li>
          <li><a href="'.site_url('Administrateur_Organisation').'">Administrateur Organisation</a></li>
          <li><a href="'.site_url('Administrateur_Inscription').'">Administrateur Inscription</a></li>
        </ul>
      </li>';
      }
      ?>
      <a class="navbar-brand" <?php echo "href='".site_url('Super_Administrateur')."'" ?>>Super Administrateur</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a <?php echo "href='".site_url('Super_Administrateur/Gestion_annee')."'" ?>>Gestion des années</a></li>
      <li><a <?php echo "href='".site_url('Super_Administrateur/Gestion_Droit')."'" ?>>Gestion des droits</a></li>
      <li><a <?php echo "href='".site_url('Super_Administrateur/Mailing')."'" ?>>mailing remerciement sponsor</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a <?php echo "href='".site_url('Visiteur/seDeConnecter')."'" ?>><span class="glyphicon glyphicon-log-in"></span> Se déconnecter</a></li>
    </ul>
  </div>
</nav>
