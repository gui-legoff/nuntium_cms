<?php

/** Affichage de la page d'accueil ou l'id et le lien:index/php ne peut etre modifier */
$pages_acceuil = new pages($db);
$a=$pages_acceuil->pages_acceuil();

?>

  <main role="main">
    <section class="text-center" style="padding: 10rem 4rem;background: url(images/<?= $a[0]['image'] ?>) no-repeat center center;">
      <div class="container">
        <h1 class="jumbotron-heading display-2 text-light">
          <?= $a[0]['titre'] ?>
        </h1>
        <p class="display-4 text-light" style="font-size: 1.6rem"><?= $a[0]['sous_titre'] ?></p>
      </div>
    </section>


  

  <main role="main" style="padding-bottom:4rem">
    <div class="container marketing">
      <h2 class="h1 text-center pt-5 pb-4">Actualités à la une :</h2>
      <hr class="featurette-divider">

      <?php 
      /** Article :  */
      foreach ($pages_acceuil->pages_acceuil_block() as $r) {
        if( $r['position'] == "droite"){
          $position1 = "order-md-2";
          $position2 = "order-md-1";
        }else{
          $position1="";$position2="";
        }
        ?>

          <div class="row featurette">
            <div class="col-md-7 <?= $position1 ?>">
                <span class="h3"><?= $r['titre'] ?></span>
                <p class="lead text-muted"><?= $r['sous_titre'] ?></p>
            </div>
            <div class="col-md-5 <?= $position2 ?>">
              <img class="featurette-image img-fluid mx-auto" src="images/<?= $r['image'] ?>" alt="Generic placeholder image">
            </div>
          </div>
          <hr class="featurette-divider">

        <?php
      }
      ?>
    </div>
    </main>

    <div class="mt-5 mb-5">
      <h2 class="h1 text-center pt-5 pb-4">Contenu :</h2>
      <div class="container-fluid" style="padding: 0 20%">
        <p style="line-height:32px;font-size:18px"><?= $a[0]['contenu'] ?></p> 
	  </div>
  </main>
  <hr style="width:60%">


    