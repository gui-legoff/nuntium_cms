<?php

    $t = array(
        array('icone' => 'fas fa-desktop fa-fw','lien' => '../','titre' => 'Votre site'),
        array('icone' => 'fas fa-th-large fa-fw','lien' => 'index.php','titre' => 'Administration'),
        array('icone' => 'fas fa-cubes fa-fw','lien' => '?pages=themes','titre' => 'Thèmes' ),
        array('icone' => 'fas fa-home fa-fw','lien' => '?pages=accueil','titre' => 'Accueil'),
        array('icone' => 'far fa-file fa-fw','lien' => '?pages=pages','titre' => 'Pages'),
        array('icone' => 'fas fa-puzzle-piece fa-fw','lien' => '?pages=plugins','titre' => 'Modules'),
        array('icone' => 'far fa-user fa-fw','lien' => '?pages=membres','titre' => 'Membres'),
        array('icone' => 'fas fa-bars fa-fw','lien' => '?pages=navigation','titre' => 'Barre de navigation')
    );

    // Verif pour changer le nom du site
    if(isset($_POST['update_name']) && isset($_POST['nom_site']) ){
        if( !empty($_POST['nom_site']) ){
            $nom = htmlentities(addslashes($_POST['nom_site']));
            $_SESSION['name']=$nom;
            $message='<script>$.notify("le nom de votre site à été modifié !", {type:"success",icon:"check"});</script>';
        }else{
            $message='<script>$.notify("le champs est vide !", {type:"danger",icon:"times"});</script>';
        }
    }

    if(!isset($_SESSION['name'])){
        $_SESSION['name']="Nom";
    }

    echo $message;

?>