<?php 

// Variable par default
$message="";
$chemin_dossier_image=$chemin_modules."/images";

// Verif si une image veut etre enregistrer
if(isset($_POST['upload'])){
    if(!empty($_FILES['fichier']['name'])){
        // Sécurisation
        $images = htmlentities(addslashes($_FILES['fichier']['name']));

        // on vérifie maintenant l'extension
        $type_file = $_FILES['fichier']['type'];
        if( !strstr($type_file, 'jpg') && !strstr($type_file, 'jpeg') && !strstr($type_file, 'png') ){
            $message='<script>$.notify("<b>ERREUR : </b> Le fichier n\'est pas une image !", {type:"danger",icon:"times"});</script>';
        }else{
            if(!file_exists($chemin_dossier_image."/".$images)){    
                move_uploaded_file($_FILES['fichier']['tmp_name'],$chemin_dossier_image.'/'.$images);
                $message='<script>$.notify("L\'image a été enregistré dans la galerie d\'images !", {type:"success",icon:"check"});</script>';
            }else{
                $message='<script>$.notify("Renommer votre image et recommencer", {type:"danger",icon:"times"});</script>';
            }
        }
    }else{
        $message='<script>$.notify("Il n\'y aucune images ajouté dans la <b>barre parcourir ...</b> !", {type:"danger",icon:"times"});</script>';
    }
}

// Supprimer une image
if(isset($_POST['delete'])){
    $images=htmlentities(addslashes($_POST['delete']));
    // chemin de l'image
    unlink($chemin_dossier_image.'/'.$images);
    $message='<script>$.notify("L\'image a été supprimé avec succès !", {type:"success",icon:"check"});</script>';
}


// update l'image
if(isset($_POST['update'])){
    if($_POST['nom_image'] !== ''){
        $nom_image=htmlentities(addslashes($_POST['nom_image']));
        $ext_image=htmlentities(addslashes($_POST['ext_image']));
        $update=htmlentities(addslashes($_POST['update']));

        $ancien_nom=$chemin_dossier_image.'/'.$update;
        $nouveau_nom=$chemin_dossier_image.'/'.$nom_image.'.'.$ext_image;

        if(!file_exists($nouveau_nom)){
            rename($ancien_nom,$nouveau_nom);
            $message='<script>$.notify("L\'image a été renommé avec succès !", {type:"success",icon:"check"});</script>';
        }else{
            $message='<script>$.notify("<b>ERREUR : </b>Le nouveau nom est déja réserver ! trouver un autre nom d\'image", {type:"danger",icon:"times"});</script>';
        }
    }else{
        $message='<script>$.notify("Le nom de l\'image est identique a celui d\'origine !", {type:"info",icon:"exclamation"});</script>';        
    }
} 



//Gestion du titre
$scan=scandir($chemin_dossier_image);

if($scan!="." and $scan!=".." and !isset($scan[2]) ){
    $titre="Bibliothèque vide :";
}else{
    $titre="Bibliothèque d'image :";
}

?>