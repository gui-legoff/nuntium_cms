<?php 

    /** Variable par default */
    $table="pages";
    $btn_page='<input class="btn btn-primary bouton_pages" type="submit" value="enregister" name="insert">';
    $h1_page="<h1 class='h2'>Nouvelle page :</h1>";

    $message="";

    $lien="";
    $titre="";
    $image="";
    $sous_titre="";
    $contenu="";

    $lien_span="";


    /** Fonction qui insert dans la BDD la nouvelle page crée */
    if(isset($_POST['insert'])){
        if( !empty($_POST['titre']) && !empty($_POST['contenu']) && !empty($_POST['sous_titre']) ){
            if($_POST['titre'] !== 'index'){

                $titre = trim(htmlentities(addslashes($_POST['titre'])));
                /** Tableaux des caracteres spéciaux non autorisées */
                $t_caracteres_spe= array('!','<','>','=',':','^','.','[',']','$','(',')','*','+','?','|','{','}','\\');
                /** Tableaux de la chaine de caractères du champs titre */
                $t_titre=str_split($titre);
                $lien="";

                foreach($t_titre as $t){
                    // Remplace les espaces " " par un tiret
                    if($t == " "){
                        $t=str_replace(" ","-",$t);
                        $lien.=$t;
                    }else{
                        $lien.=$t;
                    }

                    /** Caractères spéciaux */
                    if(in_array($t,$t_caracteres_spe)){
                        $message='<script>$.notify("Aucun caractère spéciaux ne peut être contenu dans le titre !", {type:"danger",icon:"times"});</script>';
                        $lien="";
                    }
                }

                $sous_titre = addslashes($_POST['sous_titre']);
                $contenu = addslashes($_POST['contenu']);

                if(isset($_FILES['image'])){
                    if( !empty($_FILES['image']['name']) ){
                        // Controller d'images
                        require"controller/upload_image.php";
                    }else{
                        $image = htmlentities(addslashes($_POST['image']));
                    }
                }

                if($message == ""){
                    $insertPage = new update($db);
                    $message = $insertPage->insertPage($lien,$titre,$image,$contenu,$sous_titre);
                    $lien="";
                }
                    
            }else{
                $message='<script>$.notify("Ce titre est déja réservé !", {type:"danger",icon:"times"});</script>';
            }
        }else{
            $message='<script>$.notify("Champs vides ou incomplet !", {type:"danger",icon:"times"});</script>';
        }
    }


    /** Fonction qui supprime la page sélectionnée */    
    if(isset($_POST['delete'])){
        if( !empty($_POST['id']) ){
            $id = htmlentities(addslashes($_POST['id']));

            $supprimerPage = new supprimer($db);
            $message = $supprimerPage->supprimerPage($id);
        }else{
            $message='<script>$.notify("Une erreur avec l\'id est survenue réessayer !", {type:"danger",icon:"times"});</script>';
        }
    }


    /** Fonction qui udpate l'actif de la page sélectionnée */    
    if(isset($_POST['update_actif'])){
        if( !empty($_POST['id']) ){
            /** Securité a améliorer ajouter un bindparam  */
        
            $id = htmlentities(addslashes($_POST['id']));
            $actif = htmlentities(addslashes($_POST['update_actif']));

            $update_actif = new update($db);
            $message = $update_actif->update_actif($id,$actif);
        }else{
            $message='<script>$.notify("Une erreur avec l\'id est survenue réessayer !", {type:"danger",icon:"times"});</script>';
        }
    }

    
    /** Fonction qui update la page sélectionnée */    
    if( isset($_GET['id_pages']) ){

        $btn_page='<input class="btn btn-primary bouton_pages" type="submit" value="mettre a jour" name="update">';

        if(isset($_POST['update'])){
            if( !empty($_POST['titre']) && !empty($_POST['contenu']) && !empty($_POST['sous_titre']) ){
                
                $id = htmlentities(addslashes($_GET['id_pages'])); 

                $titre = trim(htmlentities(addslashes($_POST['titre'])));
                /** Tableaux des caracteres spéciaux non autorisées */
                $t_caracteres_spe= array('!','<','>','=',':','^','.','[',']','$','(',')','*','+','?','|','{','}','\\');

                /** Tableaux de la chaine de caractères du champs titre */
                $t_titre=str_split($titre);
                $lien="";

                foreach($t_titre as $t){
                    // Remplace les espaces " " par un tiret
                    if($t == " "){
                        $t=str_replace(" ","-",$t);
                        $lien.=$t;
                    }else{
                        $lien.=$t;
                    }

                    /** Caractères spéciaux */
                    if(in_array($t,$t_caracteres_spe)){
                        $message='<script>$.notify("Aucun caractère spéciaux ne peut être contenu dans le titre !", {type:"danger",icon:"times"});</script>';
                        $lien="";
                    }
                }

                if(isset($_FILES['image'])){
                    if( !empty($_FILES['image']['name']) ){
                        // Controller d'images
                        require"controller/upload_image.php";
                    }else{
                        $image = htmlentities(addslashes($_POST['image']));
                    }
                }
            
                $contenu = addslashes($_POST['contenu']);
                $sous_titre = addslashes($_POST['sous_titre']);

                if($message == ""){
                    $updatePage = new update($db);
                    $message = $updatePage->updatePage($id,$lien,$titre,$image,$contenu,$sous_titre);
                }

            }else{
                $message='<script>$.notify("Champs vides ou incomplet !", {type:"danger",icon:"times"});</script>';
            }
        }
    

        /** Fonction qui affiche la page sélectionnée */    

        $h1_page="<a class='btn btn-primary' href='?pages=pages' role='button'>Ajouter une nouvelle page</a>";    

        if( !empty($_GET['id_pages']) ){
            /** Securité a améliorer ajouter un bindparam  */
        
            $id = htmlentities(addslashes($_GET['id_pages']));
    
            $afficher_page = new select($db);
            $afficher_page->afficher_page($id);

            foreach ( $afficher_page->afficher_page($id) as $a ) {
                
                $lien = $a['lien'];
                $titre = $a['titre'];
                $image = $a['image'];
                $sous_titre = $a['sous_titre'];
                $contenu = $a['contenu'];
            }

            $lien_span = "<span class='mt-3'>Liens permanant : </span>";
        }
    }

    $listing_users = new listing_users($db);

    /** Fonction qui récupère les colonnes de la table pages */
    $listing_users->nom_colonne($table,$dbname);

    /** Fonction pour afficher les différentes pages */
    $var = "WHERE lien!='index.php'";
    $listing_users->listing_users($table,$var);


?>