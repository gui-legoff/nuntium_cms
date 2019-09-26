<?php
/** Gestions du contenu en fonctions de la page séléctioné */
require "controller/pages_active.php";
?>

<!-- HEADER -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
    <a class="navbar-brand" href="http://<?= $_SERVER['HTTP_HOST'].dirname($_SERVER['SCRIPT_NAME'])?>"><?= $_SESSION['name'] ?></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
        
          <?php
          // Menu
          foreach($re as $m){
            if( $m['ordre'] !== null ){
            ?>
            <li class="nav-item">
              <a class="nav-link" href="pages_<?= $m['lien'] ?>"><?= $m['renommer'] ?></a>
            </li>
            <?php
            }
          }
          ?>

          <!-- <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Menu deroullant
            </a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="#">lien 1</a>
              <a class="dropdown-item" href="#">lien 2</a>
            </div>
          </li>
          -->
          <li>
            <a href="admin">
              <button class="btn btn-secondary btn-block ml-4">
              <i class="fas fa-cog"></i>
              </button>
            </a>
          </li> 
        </ul>
      </div>
    </div>
  </nav>
  

<!-- BODY -->

<?php
  /** Contenu de la page */
  require "controller/content_page.php" 
?>

<!-- FOOTER -->
<footer class="container">
      <p class="float-right">
        <a href="#">Revenir en haut</a>
      </p>
      <p>&copy; 2017-2018 Nuntium, Inc. &middot;
        <a href="#">Mentions légales</a> &middot;
        <a href="#">Contact</a>
      </p>
    </footer>
    
    