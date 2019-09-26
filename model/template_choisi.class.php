<?php 

class template_choisi extends connexion{
   
    // fonction qui se déclenche automatiquement 
	function __construct($db){
        parent::__construct($db);
    }

    public function template_choisi(){
    
    /* Requete qui selectione le template choisi au démarrage du site */    
    $req=$this->_db->query(" SELECT * FROM settings WHERE actif='oui' ");
    $res=$req->fetchAll();
    return $res;

    }   
   
} 

?>