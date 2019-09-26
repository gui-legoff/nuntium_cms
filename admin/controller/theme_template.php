<?php

$message="";

// Verif de l'update du template selectionné
if( isset($_POST['dossier']) ){

    $dossier = htmlentities(addslashes($_POST['dossier']));

    $updateTemplates = new update($db);
    $message = $updateTemplates->updateTemplates($dossier);
}

// Verif de l'update des couleur du thème selectionné
if( isset($_POST['update_couleur']) ){
    if( !empty($_POST['couleur_pri']) && !empty($_POST['couleur_sec']) && !empty($_POST['couleur_txt']) ){
    
        $id = htmlentities(addslashes($_POST['id']));
        $couleur_pri = htmlentities(addslashes($_POST['couleur_pri']));
        $couleur_sec = htmlentities(addslashes($_POST['couleur_sec']));
        $couleur_txt = htmlentities(addslashes($_POST['couleur_txt']));

        $updateCouleurs = new update($db);
        $message = $updateCouleurs->updateCouleurs($couleur_pri,$couleur_sec,$couleur_txt,$id);
    }
}

?>






