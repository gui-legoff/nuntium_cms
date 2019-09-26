<?php 

/** Réecriture url */
if(isset($_GET['url'])){
    $url=explode("_",$_GET['url']);

    if( $url[0] == "pages" AND isset($url[1]) ){
        if( in_array($url[1],$pages_autorise) ){
            /** Chargement du template d'une page vierge */
            require $chemin_admin_modules."pages_vierge.php";

        }elseif( in_array($url[1],$pages_non_autorise) ){
            /** Page désactiver redirection vers une page d'erreur */
            $var = "est désactivé";
            require $chemin_admin_modules."page_erreur.php";
        }else{  
            /** Page qui n'existe pas redirection vers une page d'erreur */
            $var="n'existe pas";
            require $chemin_admin_modules."page_erreur.php";
        }
    }else{  
        /** Page qui n'existe pas redirection vers une page d'erreur */
        $var="n'existe pas";
        require $chemin_admin_modules."page_erreur.php";
    }
}else{
    /** Chargement de la page d'acceuil: index.php  */
    require $chemin_admin_modules."accueil.php";
}
/** Fin réecriture url  */

?>

