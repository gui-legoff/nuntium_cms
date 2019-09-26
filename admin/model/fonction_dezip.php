<?php
/**
 * Extrait un zip ($fichierzip) dans le dossier $dossierdestination
 * Créé le dossier $dossierdestination si il n'existe pas.
 * Seuls les fichiers à la racine du zip ou du premier élément du zip si celui-ci est un dossier sont extraits.
**/

function dezziperVers($fichierzip, $dossierdestination){
    $statut = array(); // Enregistre les différents événements (utile pour debug)
    $zip = zip_open($fichierzip);// on ouvre le zip... si on y arrive $zip devient une ressource
 
    if( !is_resource($zip) ){//Une ressource est une variable spéciale, contenant une référence vers une ressource externe
        trigger_error("Impossible d'ouvrir le zip", E_USER_NOTICE);// on affiche une notice
        return false;
    }
 
    // Création du dossier d'extraction ($dossierdestination) si il n'existe pas
    if( !is_dir($dossierdestination) ){
        if( !mkdir($dossierdestination, 0777, true) ){//si on n'arrive pas à créer le dossier
            trigger_error("Impossible de créer le dossier", E_USER_WARNING);//on affiche un warning
        }
        chmod($dossierdestination, 0777);//on chmod 777
    }
 
    // Test du premier élément : si c'est un dossier on extrait uniquement le contenu de ce dossier, si c'est un fichier on on extrait tous les fichiers à la racine du zip
    // Si le premier élément est vide, le zip est vide, et on sort de la fonction
    if( ($fichier_dans_le_zip = zip_read($zip)) === false ){//zip_read parcours ce qu'il y a dans le zip
        trigger_error("Le zip est vide", E_USER_NOTICE);//si vide , on affiche une notice
        return false;//on return false
    }
    // Dossier conteneur (c'est un dossier si son nom se termine par \ ou /
    if( preg_match('#[\\/]$#', zip_entry_name($fichier_dans_le_zip)) ){// zip_entry_name==> nom du dossier
        $zipRoot = zip_entry_name($fichier_dans_le_zip);
    }
    // Fichiers directement à la racine du zip
    else {
        $zipRoot = '';
        file_put_contents($dossierdestination.'/'.zip_entry_name($fichier_dans_le_zip), zip_entry_read($fichier_dans_le_zip, zip_entry_filesize($fichier_dans_le_zip))); // Extraction du premier fichier
		//file_put_contents :Écrit un contenu dans un fichier (Chemin vers le fichier dans lequel on doit écrire les données,Les données à écrire,La valeur du paramètre ici c'est toute la taille du fichier)
    }
 
    $statut[] = 'Dossier racine: '.$zipRoot;
    $statut[] = 'Premier fichier du zip: '.zip_entry_name($fichier_dans_le_zip);
 
    // Parcours du zip (éléments suivants)
    while( ($fichier_dans_le_zip = zip_read($zip)) !== false ){
        $nomDuFichierCourant = zip_entry_name($fichier_dans_le_zip);
 
        // Si l'entrée est un dossier, on l'ignore
        if( preg_match('#[\\/]$#', $nomDuFichierCourant) ){
            $statut[] = $nomDuFichierCourant." ignoré (c'est un dossier)";
            continue;
        }
 
        // Si l'entrée n'est pas dans le dossier qui nous intéresse ($zipRoot), on l'ignore
        if( !preg_match('#^'.$zipRoot.'[^\\/]+$#', $nomDuFichierCourant) ){
            $statut[] = $nomDuFichierCourant." ignoré (Pas dans dossier racine)";
            continue;
        }
 
        $statut[] = "Extraction de ".$nomDuFichierCourant;
        $extractFilenameFullpath = $dossierdestination.'/'.basename($nomDuFichierCourant);
        file_put_contents($extractFilenameFullpath, zip_entry_read($fichier_dans_le_zip, zip_entry_filesize($fichier_dans_le_zip))); // Extraction du premier fichier .... et hop c'est parti !!!
        chmod($extractFilenameFullpath, 0777);
    }
 
    /*pour le débug
	echo"<pre>";
	var_dump($statut);
	echo"</pre>";*/
}
//dezziperVers("test.zip", "dezip");
?>