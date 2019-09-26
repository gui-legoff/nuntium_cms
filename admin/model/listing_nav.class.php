<?php

class listing_nav extends connexion{
   
    // fonction qui se déclenche automatiquement 
	function __construct($db){
        parent::__construct($db);
    }

    public function nom_colonne($table,$dbname){
        $req=$this->_db->query(" SELECT column_name FROM information_schema.columns WHERE table_name = '$table' AND column_name!='id' AND table_schema='$dbname';");
        $res=$req->fetchAll();
        return $res;
    }
    
    public function update_users($id,$actif){
		
        $req=$this->_db->exec(" UPDATE users SET actif='$actif' WHERE id='$id' ");
        
        if( $actif == 'non' ){
            $message='<script>$.notify("l\'utilisateur est désactivé !", {type:"info",icon:"check"});</script>';
        }else if( $actif == 'oui' ){
            $message='<script>$.notify("l\'utilisateur est activé !", {type:"success",icon:"check"});</script>';
        }

        return($message);
    }
} 

?>