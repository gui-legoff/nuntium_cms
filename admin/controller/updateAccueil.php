<?php 

    /** Variable par default */
    $message="";  

    if(isset($_POST['update_acceuil']) or isset($_POST['update']) ){
        $titre = htmlentities(addslashes($_POST['titre']));
        $id = htmlentities(addslashes($_POST['id']));
        $sous_titre = addslashes($_POST['sous_titre']);
    }


    /** Fonction qui udpate le header sélectionnée */    
    if(isset($_POST['update_acceuil'])){

        $contenu = htmlentities(addslashes($_POST['contenu']));

        if( !empty($titre) && !empty($sous_titre) && !empty($contenu) && !empty($id) ){

            if(isset($_FILES['image'])){
                if( !empty($_FILES['image']['name']) ){
                    // Controller d'images
                    require"controller/upload_image.php";
                }else{
                    $image = htmlentities(addslashes($_POST['image']));
                }
            }

            $update_accueil = new update($db);
            $message = $update_accueil->update_accueil_head($titre,$sous_titre,$contenu,$image,$id); 

        }else{
            $message='<script>$.notify("Champs vides ou incomplet !", {type:"danger",icon:"times"});</script>';
        }
    }

    /** Fonction qui udpate le post sélectionnée */    
    if(isset($_POST['update'])){
        
        $position = htmlentities(addslashes($_POST['position']));
        
        if( !empty($titre) && !empty($sous_titre) && !empty($id) && !empty($position) ){

            if(isset($_FILES['image'])){
                if( !empty($_FILES['image']['name']) ){
                    // Controller d'images
                    require"controller/upload_image.php";
                }else{
                $image = htmlentities(addslashes($_POST['image']));
                }
            }

            $update_post_accueil = new update($db);
            $message = $update_post_accueil->update_post_accueil($titre,$sous_titre,$image,$id,$position); 
        }else{
            $message='<script>$.notify("Champs vides ou incomplet !", {type:"danger",icon:"times"});</script>';
        }
    }

    /** Fonction qui rempli les champs de la page accueil */    
    if(isset($_GET['pages'])){
        
        // Haut de la page
        $afficher_accueil_head = new select($db);
        $a=$afficher_accueil_head->afficher_accueil_head();

        if(isset($_GET['id'])){
            
            $id = htmlentities(addslashes($_POST['id']));
            // Post de la page
            $afficher_accueil_post = new select($db);
            $p=$afficher_accueil_post->afficher_accueil_post($id);
        }
    }

?>