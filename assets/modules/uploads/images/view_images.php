<?php 

require"controller_".$_GET['plugins'].".php";

?>

<style>
.thumbnail{position:relative}
.thumbnail:hover .del{;opacity:1}
.del{position:absolute;right:0;top:0;opacity:0;margin:5px}


</style>

<h1 class="h1 border-bottom titre">Bienvenue dans la gestion du plugins <?= $_GET['plugins'] ?></h1>

<?= $message ?>

<h3 style="display:inline mb-5">Ajouter une nouvelle image :</h3>

<form method="post" enctype="multipart/form-data">
    <input class="btn btn-outline-primary mt-3" type="file" name="fichier"/>
    <input class="btn btn-primary ml-4 mt-3" type="submit" name="upload" value="Enregistrer"/>
</form>

<hr>


<h3 style="display:inline mb-5"><?= $titre ?></h3>

<?php 
// Bibliotèques d'images
if(isset($_GET['plugins'])){
    if( $_GET['plugins'] == 'images'){
        require"model_".$_GET['plugins'].".php";
    }
}

?>
<div style="clear:both"></div>

