<?php 

class pages extends connexion{
   
    // fonction qui se déclenche automatiquement 
	function __construct($db){
        parent::__construct($db);
    }

    public function pages_nav($arg){
    
        /* Requete qui recupere les pages et contenu pour le menu deroullant */    
        $req=$this->_db->query(" SELECT * FROM pages $arg ");
        $res=$req->fetchAll();
        return $res;
        }

    public function pages($lien){
    
    /* Requete qui recupere le contenu de la page grace a la variable lien=nom de la page */    
    $req=$this->_db->query(" SELECT * FROM pages WHERE lien='$lien' ");
    $res=$req->fetchAll();
    return $res;
    }
    
    
    public function pages_acceuil(){
    
        /* Requete qui recupere le contenu de la page grace a la variable lien=nom de la page */    
        $req=$this->_db->query(" SELECT * FROM accueil WHERE id='1' AND lien='index.php' ");
        $res=$req->fetchAll();
        return $res;
    }


    public function pages_acceuil_block(){
    
        /* Requete qui recupere le contenu des 3 blocks d'actualités de la page */    
        $req=$this->_db->query(" SELECT * FROM accueil WHERE id!='1' ORDER BY id ");
        $res=$req->fetchAll();
        return $res;
    }
   
} 

?>