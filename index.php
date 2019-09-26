<?php

if(file_exists("install.php")){
    require"install.php";
}else{

/** Config */
include"config.php";

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Bienvenue sur la page d'accueil</title>
        
        <!-- Custom CSS -->
        <link rel="stylesheet" href="<?php echo $chemin_css ?>style.css" />

        <!-- Custom JS -->
        <script src="assets/js/jquery-3.3.1.slim.min.js"></script>

        <?php 
        // Générateur de CSS
        $scancss=scandir("assets/css/");
        foreach ($scancss as $css) {
            if($css!="." AND $css!=".."){
                echo '<link rel="stylesheet" href="'.$a.'assets/css/'.$css.'" />';
            }
        }
        // Fin du générateur de CSS
        ?>

        

    </head>

    <body>
        <?php
            /** Template choisi */
            include"view/index.php";
            ?>
    </body>

    <?php 
     // Générateur de script JS
    $scanjs=scandir("assets/js/");
    foreach ($scanjs as $js) {
        if($js!="." AND $js!=".."){
            echo '<script src="assets/js/'.$js.'"></script>';
        }
    }
    // Fin du générateur de script JS
    ?>

    <!-- Gestion du CSS -->
    <?php require "admin/".$chemin_admin_modules."gestion_css.php"; ?>
  
</html> 

<?php

/** Fichier de debug */
include"debug.php";
}

?>	