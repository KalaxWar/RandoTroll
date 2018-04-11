<style>
  .selectioné {
      color: #C40000;
  }
  </style>
  <div class="container">
  <nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" <?php echo "href='".site_url('Responsable')."'" ?>>RandoTroll</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="#">Contact admin</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a <?php echo "href='".site_url('Responsable/MonCompte')."'" ?>><span class="glyphicon glyphicon-user"></span> Mon compte</a></li>
      <li><a <?php echo "href='".site_url('Visiteur/seDeConnecter')."'" ?>><span class="glyphicon glyphicon-log-in"></span> Se déconnecter</a></li>
    </ul>
  </div>
</nav>
