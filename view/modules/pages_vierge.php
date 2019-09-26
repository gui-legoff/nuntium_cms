<?php

/** Affichage de la page d'accueil ou l'id et le lien:index/php ne peut etre modifier */
$lien=explode("_",$_GET['url']);
$lien=$lien[1];

$pages_vierge = new pages($db);
$a=$pages_vierge->pages($lien);

?>
<!-- Contenu / Body  -->

<div class="content">
 

  <div class="text-center">
    <h1 class="display-4 font-weight-normal mb-4"><?= $a[0]['titre'] ?></h1>
    <p class="font-italic h5 text-muted"><?= $a[0]['sous_titre'] ?></p>
  </div>

  <img src="images/<?= $a[0]['image'] ?>" class="w-100 banniere mt-5" alt="banniere">

  <div style="padding: 3rem 11rem">
    <h1 class="h3 font-weight-bold mb-4"><?= $a[0]['titre'] ?></h1>
    <p><?= $a[0]['contenu'] ?></p>
  </div>

</div>







    