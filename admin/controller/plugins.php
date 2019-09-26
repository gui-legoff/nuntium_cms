<?php

// variable de message
$message="";

// Verif si le dossier existe avant l'upload
if(isset($_POST['upload'])){
    if(empty($_FILES['fichier']['name'])){
        $message='<script>$.notify("Il n\'y aucun modules ajouté dans la <b>barre parcourir ...</b> !", {type:"danger",icon:"times"});</script>';
    }else{
        $dossier = htmlentities(addslashes($_POST['upload']));

        require"model/fonction_dezip.php";

        if(file_exists("../assets/modules/uploads/$dossier")){
            $message='<script>$.notify(" le module : est déja installé !", {type:"danger",icon:"times"});</script>';
        }else{
            if(!empty($_FILES['fichier'])){

                $dossierModules="../assets/modules/archives_modules/";
                $dossierUploads="../assets/modules/uploads/";
                
                $fichier_upload=$dossierModules.$_FILES['fichier']['name'];
                $nom_du_module=explode(".",$_FILES['fichier']['name']);
                if(file_exists($fichier_upload)){
                    $message='<script>$.notify("Le fichier existe déjà !", {type:"danger",icon:"times"});</script>';
                }else{
                    $upload=move_uploaded_file($_FILES['fichier']['tmp_name'],$fichier_upload);
                    dezziperVers($fichier_upload, $dossierUploads.$nom_du_module[0]);
                    $message='<script>$.notify("Module installé avec succès !", {type:"success",icon:"check"});</script>';
                }
            }
        }
    }
}

// Delete d'un dossier
if(isset($_POST['delete'])){
    $dossier = htmlentities(addslashes($_POST['delete']));

    //Delete dans le dossier uploads
    $chemin="../assets/modules/uploads/$dossier";
    $chemin_zip="../assets/modules/archives_modules/".$dossier.".zip";

    $scan=scandir($chemin);
    $nb_del=count($scan);

    if( $nb_del > 2 ){
        // si dossier contient quelque chose ...
        foreach ($scan as $s) {
            if($s!="." and $s!=".."){
                if(is_file($chemin."/".$s)){
                    unlink($chemin."/".$s);
                }else{
                    $message='<script>$.notify("<b>ERREUR</b> le dossier : <b><?= $dossier ?></b> contient d\'autres dossiers !", {type:"danger",icon:"times"});</script>';
                }
            }
        }
    }
    
    $scan_vide=scandir($chemin);
    $nb_vide=count($scan_vide);
    
    // si le dossier est vide ...
    if( $nb_vide <= 2 ){
        // Supprimer le dossier dans uploads (dossier deziper)
        rmdir($chemin);
                
        // Supprimer le zip dans archives_modules (dossier ziper)
        if(is_file($chemin_zip)){
            unlink($chemin_zip);
        }else{
            $message='<script>$.notify("<b>ERREUR</b> le dossier : <b><?= $dossier ?></b> contient d\'autres dossiers !", {type:"danger",icon:"times"});</script>';
        }
        $message='<script>$.notify("Modules : <b><?= $dossier ?></b> supprimé avec succès !", {type:"success",icon:"check"});</script>';
    }    
}


// Scan des modules existants dans le dossier
$scan=scandir("../assets/modules/uploads");


// Gestion du titre
$nb=count($scan);
if( $nb > 2 ){
    $titre1='Liste des modules installés :';
}else{
    $titre1='Aucun modules n\'a encore été installés';
}

?>