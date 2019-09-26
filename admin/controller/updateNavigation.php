<?php 
    
    /** Variable par default */
    $message="";
    $table="navigation";

    $oui='  <button class="toggle btn btn-default" data-toggle="toggle" type="submit" name="u_menu" style="width: 80px; height: 38px;">
                <div class="toggle-group">
                    <input class="btn btn-default toggle-on" name="menu" value="non" style="width: 80px;">
                    <span class="toggle-handle btn btn-default"></span>
                </div>
            </button> ';
    $non='  <button class="toggle btn btn-info off" data-toggle="toggle" type="submit" name="u_menu" style="width: 80px; height: 38px;">
                <div class="toggle-group">
                    <input class="btn btn-info toggle-on" name="menu" value="oui" style="width: 80px;">
                    <span class="toggle-handle btn btn-default"></span>
                </div>
            </button> ';

            
    /** Verif de l'ajout d'une ligne de menu */
    if(isset($_POST['ajouter'])){

        $req=$db->query(" SELECT ordre FROM navigation ");
        $res=$req->fetchAll();

        foreach($res as $r){
            if( $r['ordre'] === null ){
                $var="ok";
            }else{
                $message='<script>$.notify("Tous les liens disponible sont déja affichés !", {type:"danger",icon:"times"});</script>';
                $var="erreur";
            }
        }

        if( $var=="ok" ){
            $ajout_menu = new navigation($db);
            $message = $ajout_menu->ajout_menu();
        }
    }


    /** Verif du update du sous-menu */
    if(isset($_POST['u_menu'])){
         
        if( !empty($_POST['id']) && !empty($_POST['menu']) ){

            $id = htmlentities(addslashes($_POST['id']));
            $menu = htmlentities(addslashes($_POST['menu']));

            $update_sous_menu = new navigation($db);
            $message = $update_sous_menu->update_sous_menu($id,$menu);
        }
    }


    /** Verif du update de l'actif du menu */
    if( isset($_POST['actif_oui']) || isset($_POST['actif_non']) && isset($_POST['id']) ){
        
        if( !empty($_POST['actif_oui']) || !empty($_POST['actif_non']) && !empty($_POST['id']) ){
            
            $id = htmlentities(addslashes($_POST['id']));

            if( isset($_POST['actif_oui']) ){
                $actif = htmlentities(addslashes($_POST['actif_oui']));
            }elseif( isset($_POST['actif_non']) ){
                $actif = htmlentities(addslashes($_POST['actif_non']));
            }

            $update_actif = new navigation($db);
            $message = $update_actif->update_actif($id,$actif);
        }
    }


    /** Verif pour renommer le menu */
    if( isset($_POST['rename']) && isset($_POST['id']) ){
        if( !empty($_POST['rename']) ){

            $rename = htmlentities(addslashes($_POST['rename']));
            $id = htmlentities(addslashes($_POST['id']));

            $re_name = new navigation($db);
            $message = $re_name->rename($rename,$id);

        }else{
            $message='<script>$.notify("Champs vides !", {type:"danger",icon:"times"});</script>';
        }
    }


    /** Choix du select nom */
    if( isset($_POST['ordre_to']) && isset($_POST['ordre_from']) && isset($_POST['id_from']) ){
        if( !empty($_POST['ordre_to']) && !empty($_POST['ordre_from']) && !empty($_POST['id_from']) ){
            
            $ordre_from = htmlentities(addslashes($_POST['ordre_from']));
            $ordre_to = htmlentities(addslashes($_POST['ordre_to']));
            $id_from = htmlentities(addslashes($_POST['id_from']));
            
            $ex=explode("-",$ordre_to);

            if( isset($ex[1]) ){
                $ordre_to=$ex[1];
                $id_to=$ex[0];

                $ordre = new navigation($db);
                $message = $ordre->ordre($ordre_from,$id_from,$ordre_to,$id_to);
            }else{
                $update_ligne_vierge = new navigation($db);
                $message = $update_ligne_vierge->update_ligne_vierge($ordre_from,$id_from,$ordre_to);
            }
        }
    }


    /** Fonction qui récupère les colonnes des onglets */
    $listing_nav = new listing_nav($db); 
    $listing_nav->nom_colonne($table,$dbname);

    /** Fonction pour afficher les pages disponibles dans le menu déroulant */
    $listing_pages = new navigation($db);
    $listing_pages->listing_pages();
    
?>