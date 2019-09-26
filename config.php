<?php 

session_start();

//______________ Back office ______________//

	require"config_install.php";
	$db->exec("SET NAMES UTF8");

//_______________________  AUTOLOAD _____________________________//
	
	function chargerClasse($classe){
    	require 'model/'.$classe.'.class.php';
	}
	spl_autoload_register('chargerClasse');

//____________________  GESTIONNAIRE D'URL ______________________//

	$c= count(explode('/',$_SERVER['QUERY_STRING']));
	$a = "";
	for( $i=1 ;$i < $c; $i++ ){ $a.="../"; }


//____________________  TEMPLATE ACTIF ______________________//

$req=$db->query(" SELECT * FROM settings ");
$res=$req->fetchAll();
foreach($res as $t){
	if( $t['actif'] == "oui" ){
		$id_template_actif=$t['id'];
	}
}
	
// FRONT
$chemin_modules= "view/modules/";
$chemin_css= $a."view/assets/css/";
$chemin_js= "view/assets/js/";

// BACK
$chemin_admin_modules= "view/modules/";
$chemin_admin_css= "view/assets/css/";
$chemin_admin_js= "view/assets/js/";

$_SESSION['name']="Nom de votre site";


?>