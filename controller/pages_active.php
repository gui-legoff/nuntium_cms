<?php 

$message="";

/** Fonctions qui récupere le contenu de toutes les pages */
$pages_nav = new pages($db);
$arg="WHERE lien!='index.php'";

/** Tableau des pages autorisées / non-autorisées */
$pages_autorise=array();
$pages_non_autorise=array();

foreach ($pages_nav->pages_nav($arg) as $p) {
    if( $p['actif'] == "oui" ){
        array_push($pages_autorise,$p['lien']);   
    }elseif( $p['actif'] == "non" ){
        array_push($pages_non_autorise,$p['lien']);
    }else{
       $message='<script>$.notify("Erreur critique ! on ne sait pas s\'il est actif ou non !", {type:"danger",icon:"times"});</script>';
    }
}
/** Fin des pages autorisées */
echo $message;

// Resultat des lien enregistré
$req=$db->query(" SELECT nom , lien , renommer , ordre FROM navigation WHERE actif='oui' ");
$re=$req->fetchAll();


?>