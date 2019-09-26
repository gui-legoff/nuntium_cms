<?php

$dossier="../images";

$name=$_FILES['image']['name'];
$tmp_name=$_FILES['image']['tmp_name'];
$error=$_FILES['image']['error'];

if($error==0){
    if(file_exists("$dossier/$name")){
        $message='<script>$.notify("l\'image existe déjà, renommer votre image !", {type:"danger",icon:"times"});</script>';
        $lien="";
    }else{
        move_uploaded_file($tmp_name,"$dossier/$name");//move_uploaded_file déplace le fichier $tmp_name vers
        $image=$name;
    }
}else{
    $message='<script>$.notify("erreur N°'.$error.'", {type:"danger",icon:"times"});</script>';
}

?>
