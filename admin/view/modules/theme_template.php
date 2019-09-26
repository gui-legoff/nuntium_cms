<?php

// Resultat des template enregistré dans la BDD
$req=$db->query(" SELECT * FROM settings ");
$res=$req->fetchAll();

?>

<h4 class="mb-4">Choisir un thème :</h4>
<form method="post" onChange="submit()">
  <div class="form-group">
    <select class="form-control" name="dossier">
      <?php
      /** Affichage des templates dans le select */
        foreach($res as $a){?>
          <option <?php 
            if( $a['actif'] == "oui" ){
              echo " selected='selected' ";
              $id_template_actif= $a['id'];
            } ?>><?= $a['theme'] ?></option>
        <?php
        } 
        ?>
    </select>
  </div>
</form>
