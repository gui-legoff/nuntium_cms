<?php

/** Config */
include"../config.php";

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Panel d'administration</title>

        <?php 
        // Générateur de CSS
        $scancss=scandir("../assets/css/");
        foreach ($scancss as $css) {
            if($css!="." AND $css!=".."){
                echo '<link rel="stylesheet" href="../assets/css/'.$css.'" />';
            }
        }
        // Fin du générateur de CSS
        ?>

        <!-- Custom CSS -->
        <link rel="stylesheet" href="<?php echo $chemin_admin_css ?>style.css" />
        
        <!-- Custom JS -->
        <script src="../assets/js/jquery-3.3.1.slim.min.js"></script>
        <script src="../assets/js/notify.js"></script>

    </head>

    <body>
        <?php
            /** Template choisi */
            include"view/index.php";
        ?>
    </body>

    <?php 
     // Générateur de script JS
    $scanjs=scandir("../assets/js/");
    foreach ($scanjs as $js) {
        if($js!="." AND $js!=".."){
            echo '<script src="../assets/js/'.$js.'"></script>';
        }
    }
    // Fin du générateur de script JS
    ?>

    <!-- Gestion du CSS -->
    <?php require $chemin_admin_modules."gestion_css.php"; ?>

</html> 
