<?php

class select extends connexion{
   
    // fonction qui se déclenche automatiquement 
	function __construct($db){
        parent::__construct($db);
    }

    public function afficher_page($id){
    
        /* Requete qui actif le template choisi */    
        $req=$this->_db->query(" SELECT * FROM pages WHERE id='$id' ");
        $res=$req->fetchAll();
        return($res);

    } 
    
    public function afficher_accueil_head(){
    
        /* Requete qui recupere le contenu du haut de la page accueil */    
        $req=$this->_db->query(" SELECT * FROM accueil WHERE lien='index.php' AND id='1' ");
        $res=$req->fetchAll();
        return($res);

    }

    public function afficher_accueil_post($id){
    
        /* Requete qui recupere le contenu des post de la page accueil */    
        $req=$this->_db->query(" SELECT * FROM accueil WHERE id='$id' ORDER BY id ");
        $res=$req->fetchAll();
        return($res);

    }

    public function afficher_accueil_all_post(){
    
        /* Requete qui recupere le contenu des post de la page accueil */    
        $req=$this->_db->query(" SELECT * FROM accueil WHERE id!='1' ORDER BY id ");
        $res=$req->fetchAll();
        return($res);

    }
} 

?>