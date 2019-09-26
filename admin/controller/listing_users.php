<?php 
    
    /** Variable par default */
    $message="";

    $listing_users = new listing_users($db);

    /** Fonction qui active/désactive un membres */
    if(isset($_POST['env'])){
         
        if( !empty($_POST['env']) && !empty($_POST['id']) ){

            $id = htmlentities(addslashes($_POST['id']));
            $actif = htmlentities(addslashes($_POST['env']));

            $listing_users->update_users($id,$actif);
            $message = $listing_users->update_users($id,$actif);
        }
    }


    /** Fonction qui récupère les colonnes de la table users */
    $listing_users->nom_colonne($table,$dbname);

    /** Fonction pour afficher la liste des users */
    $var="";
    $listing_users->listing_users($table,$var);
    
?>