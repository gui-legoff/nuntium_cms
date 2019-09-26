<style>
    /* CSS des boutons on/off */
    .btn-default {
        color: #333;
        background-color: #fff;
        border-color: #ccc;
    }
    .btn-default:hover, .btn-default:focus, .btn-default:active, .btn-default.active, .open > .dropdown-toggle.btn-default {
        color: #333;
        background-color: #e6e6e6;
        border-color: #adadad;
    }
    .btn-default{box-shadow: inset 0 3px 5px rgba(0,0,0,.125);}
</style>

<?php 

require"controller/updateNavigation.php";

// message d'erreur ou de succès en fonction 
echo $message;
?>

    <a href="../" class="btn btn-primary mb-5">Revenir au site</a>
    <h1 class="h2">Onglets principaux :</h1>
        <?php echo $message ?>
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th><i class="fas fa-align-justify"></i></i></th>
                        <?php
                            /** Noms des colonnes */
                            foreach ($listing_nav->nom_colonne($table,$dbname) as $r) {
                                if($r['column_name'] !== 'lien' && $r['column_name'] !== 'id_pages' && $r['column_name'] !== 'ordre' && $r['column_name'] !== 'sous_menu' ){
                                    echo "<th>".$r['column_name'];
                                }
                            } 
                        ?>
                        <!-- <th>Supprimer</th> -->
                </tr>
                </thead>
                <tbody> 
                        <?php
                        /** Contenu des onglets */
                        foreach ($listing_pages->listing_pages() as $r) {
                            if( !empty($r['ordre']) ){
                            ?>
                                <tr>
                                    <td><?= $r['ordre'] ?></td>
                                    <td>
                                        <form method="post" onChange="submit()">
                                            <input type="hidden" name="ordre_from" value="<?= $r['ordre'] ?>"/>
                                            <input type="hidden" name="id_from" value="<?= $r['id'] ?>"/>
                                            <!-- Listing des pages déja existantes -->
                                            <select name="ordre_to" class="custom-select">
                                                <optgroup label="Pages enregistrées :">
                                                    <?php
                                                        if( empty($r['nom']) ){
                                                            echo'<option>Ajouter ...</option>';                                                            
                                                            foreach ($listing_pages->listing_pages() as $p){
                                                                if( !empty($p['nom']) && empty($p['ordre']) ){
                                                                    ?>
                                                                        <option value="<?= $p['id']; ?>"><?= $p['nom']; ?></option>
                                                                    <?php
                                                                }
                                                            }
                                                        }else{
                                                            foreach ($listing_pages->listing_pages() as $p){
                                                                if( !empty($p['nom']) && $p['ordre'] !== null  ){
                                                                ?>
                                                                <option value="<?php echo $p['id']."-".$p['ordre']; ?>"<?php
                                                                    if( $p['nom'] == $r['nom'] ){
                                                                        echo " selected='selected' ";
                                                                    }
                                                                ?>><?= $p['nom']; ?></option>
                                                            <?php
                                                                }   
                                                            }
                                                        }
                                                    ?>
                                                </optgroup>
                                            </select>
                                        </form> 
                                    </td>
                                    <td>
                                        <!-- Renommer -->
                                        <form method="post">      
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="rename" placeholder="<?= $r['renommer'] ?>">
                                                <input type="hidden" name="id" value="<?= $r['id'] ?>"/>
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-info" type="submit"><i class="fas fa-check"></i></button>
                                                </div>
                                            </div>
                                        </form>        
                                    </td>
                                    <!-- <td>
                                        <!~~ Sous-menu ~~>
                                        <form method="post">
                                            <input type="hidden" name="id" value="<?php //echo $r['id'] ?>"/>
                                            <?php //if($r['sous_menu'] =='oui'){echo $oui;}else{echo $non;} ?>
                                        </form>
                                    </td> -->
                                    <td>
                                         <!-- actif -->
                                        <form method="post">
                                            <input type="hidden" name="id" value="<?php echo $r['id'] ?>"/>
                                            <?php 
                                                if($r['actif'] =='oui'){?>
                                                    <button type="submit" class="btn btn-info" name="actif_non" value="non">
                                                        <i class="far fa-check-circle"></i>
                                                    </button>
                                            <?php }else{ ?>
                                                    <button type="submit" class="btn btn-outline-secondary" name="actif_oui" value="oui">
                                                        <i class="fas fa-ban"></i>
                                                    </button> 
                                            <?php } ?>
                                        </form>
                                    </td>
                                </tr>
                                <?php
                                if($r['sous_menu'] !== "oui"){
                                    /** Sous-menu */
                                    require $chemin_admin_modules."sous_titre.php";
                                }
                            }
                        }
                        ?>
                </tbody>
            </table>
        </div>

        <?php
        // Bouton ajouter
        $req=$db->query(" SELECT ordre FROM navigation ");
        $res=$req->fetchAll();

        foreach($res as $r){
            if( $r['ordre'] == null ){
                $btn="true";
            }else{ 
                $btn="false";
            }
        }

        if($btn == "true"){
            ?>
                <form method="post">
                    <button type="submit" class="btn btn-primary" name="ajouter">
                        <span>Ajouter</span>
                    </button>   
                </form>
            <?php
        }
        ?>
                        
       