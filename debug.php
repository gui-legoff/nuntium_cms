<hr>

<?php

/** Fichier de debug */

$debug=0;

if($debug == 1){
    echo"<div class='debug'>";

    echo"<h2>POST :</h2>";
    var_dump($_POST);
    echo"<hr>";
    
    echo"<h2>GET :</h2>";
    var_dump($_GET);
    echo"<hr>";

    echo"<h2>SESSION :</h2>";
    var_dump($_SESSION);
    echo"<hr>";

    echo"<h2>FILES :</h2>";
    var_dump($_FILES);
    echo"<hr>";

    echo"</div>";
}

?>