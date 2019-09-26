<?php

require"controller/updatePages.php";

/** Titre de la page ou bouton pour une nouvelle page */
echo $h1_page;

// message d'erreur ou de succès en fonction 
echo $message;

?>

<form method="post" enctype="multipart/form-data">
  <div class="form-group">
    <h4 class="mt-5 mb-2">Titre :</h4>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">www.<?=  $_SESSION['name'] ?>/pages_</span>
        </div>
        <input type="text" class="form-control" name="titre" value="<?php if(isset($_GET['id_pages'])){echo $titre;} ?>">
    </div>
    <div class="mt-3"></div>
    <div class="form-group">
            <?= $lien_span ?> 
            <a href="../pages_<?= $lien ?>"><?= $lien ?></a>
    </div>
    <div class="border-bottom"></div>
  </div>

  <h4 style="margin-bottom: 2rem;">Image bannière:</h4>
	<div class="form-group">
		<div class="input-group input-file" style="margin-top: -22px;">
			<span class="input-group-btn">
        		<button class="btn btn-default btn-choose" type="button"><i class="far fa-image"></i></button>
    		</span>
            <input type="hidden" name="image" value="<?php if(isset($_GET['id_pages'])){echo $image;} ?>"/>
    		<input type="file" class="form-control" name="image"/>
            <button type="reset" class="btn btn-danger"><i class="fas fa-times"></i></button>
		</div>
    </div>  

  <h4>Sous-titre :</h4>
    <div class="input-group">
        <textarea class="form-control textarea_little" name="sous_titre" placeholder="court et simple ..."><?php if(isset($_GET['id_pages'])){echo $sous_titre;} ?></textarea>
    </div>

    <h4 class="mt-3">Contenu de la page :</h4>
    <div class="input-group">
        <textarea class="form-control textarea_big" name="contenu" placeholder="Rédiger votre article ..."><?php if(isset($_GET['id_pages'])){echo $contenu;} ?></textarea>
    </div>

    <?= 
        /* Bouton qui est soit enregistrer ou update en fonction du cas d'utilisation */
        $btn_page; 
    ?>
</form>

<div class="border-bottom"></div>

<h1 class="h2 sous_titre">Pages enregistrées : </h1>
<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <?php                
                    /** Noms des colonnes */
                    foreach ($listing_users->nom_colonne($table,$dbname) as $r) {
                        if( $r['column_name'] !=="lien" ){
                            echo "<th>".$r['column_name'];
                        }
                    } 
                ?>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
        </thead>
        <tbody>
        <?php        /** Liste des membres avec leurs renseignements */
            foreach ($listing_users->listing_users($table,$var) as $r) {
        ?>
            <tr>
                <td><?= $r['titre'] ?></td>
                <td><?= $r['image'] ?></td>
                <td>
                <?php
                        // Ajout de 3 petits points quand le champs exède un certain nombre de caracteres défini
                        $ex=explode(" ",$r['sous_titre']);
                        $nb=count($ex);
                     
                        $nb_max= 20;

                        if($nb > $nb_max){
                            $i=0;
                            while($i <= $nb_max){
                            echo $ex[$i]." ";
                            $i++;
                            }
                            echo" ...";
                        }else{
                            echo $r['sous_titre'];
                        }
                    ?>
                </td>
                <td>
                    <?php
                        // Ajout de 3 petits points quand le champs exède un certain nombre de caracteres défini
                        $ex=explode(" ",$r['contenu']);
                        $nb=count($ex);

                        if($nb > $nb_max){
                            $i=0;
                            while($i <= $nb_max){
                            echo $ex[$i]." ";
                            $i++;
                            }
                            echo" ...";
                        }else{
                            echo $r['contenu'];
                        }
                    ?>
                </td>
                <td>
                    <form method="post" onChange="submit()">
                        <input type="hidden" name="id" value="<?= $r['id'] ?>"/>    
                            <select name="update_actif" class="custom-select select">
                                <option value="oui" name="option"
                                    <?php                                     if($r['actif'] == 'oui' ){
                                            echo " selected='selected' ";
                                        }
                                    ?>
                                >oui</option>
                                <option value="non" name="option"
                                    <?php                                     if($r['actif'] == 'non' ){
                                            echo " selected='selected' ";
                                        }
                                    ?>
                                >non</option>
                            </select>
                    </form>
                </td>
                <td>
                    <a href="?pages=pages&id_pages=<?= $r['id'] ?>">
                        <!-- <input class="btn btn-primary bouton_pages" value="modifier" type="submit"> -->

                        <button type="submit" class="btn btn-primary bouton_pages ml-2" style="padding-left: 0.95rem;"> 
                           <i class="far fa-edit"></i>
                        </button>
                    </a>
                </td>
                <td>
                    <form method="post">
                        <input type="hidden" name="id" value="<?= $r['id'] ?>"/>
                        <button type="submit" class="btn btn-outline-danger bouton_pages ml-3" name="delete">
                            <i class="far fa-trash-alt"></i>
                        </button>
                    </form>
                </td>
            </tr>
            <?php        }
            ?>
        </tbody>
    </table>
</div>