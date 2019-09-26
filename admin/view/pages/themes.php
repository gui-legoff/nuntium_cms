<h1 class="h1 border-bottom titre">Bienvenue dans la gestions des thèmes</h1>

<?php
/** Controller */
require "controller/theme_template.php";

// Formulaire pour afficher les dossiers template
require $chemin_admin_modules."theme_template.php";

// Formulaire pour changer les couleurs du template
require $chemin_admin_modules."theme_couleur.php";

// Formulaire pour Modifier le nom ou le logo du site
require $chemin_admin_modules."nom_site.php";

echo $message;
?>

