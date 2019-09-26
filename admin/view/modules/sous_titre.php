
<!-- Sous-menu -->

<style>
    .sous_menu {background-color:#EBF7F9}
    .sous_menu tr {font-weight:bold}

</style>

    <tr class="sous_menu">
        <td style="background-color:white"><i class="fas fa-angle-right"></i></td>
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
        <td>
            <button type="submit" class="btn btn-outline-secondary" name="actif_oui" value="oui" style="padding:0 1rem">
                <i class="fas fa-ban"></i>
            </button>
        </td>
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

