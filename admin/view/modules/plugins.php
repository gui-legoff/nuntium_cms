<?php

require"controller/plugins.php";

// message d'erreur ou de succès en fonction 
echo $message;
?>

<h3 style="display:inline mb-5">Ajouter un nouveau module :</h3>

<form method="post" enctype="multipart/form-data">
    <input class="btn btn-outline-primary mt-3" type="file" name="fichier"/>
    <input class="btn btn-primary ml-4 mt-3" type="submit" name="upload" value="Enregistrer"/>
</form>

<hr>

<h3><?= $titre1 ?></h3>
<?php if( $nb > 2 ){
    require($chemin_admin_modules.'liste_plugins.php');} 
?>


