<?php

class login_form extends connexion{
   
    // fonction qui se déclenche automatiquement 
	function __construct($db){
        parent::__construct($db);
    }

    public function login_form($login,$pass){
		
		$requete=$this->_db->query(" SELECT * FROM users WHERE login='$login' AND password='$pass' AND actif='oui' ");
		
        $nb=$requete->rowCount();
        
        if($nb>0){
            $res=$requete->fetchAll();
            foreach($res as $session){
                $_SESSION['admin'] = $session['login'];
                $_SESSION['admin_id'] = $session['id'];
                
                $message="";
            }
        }else{
            $message='<script>$.notify("Aucun utilisateur à été trouvé", {type:"danger",icon:"times"});</script>';
        }
		return($message);
    }    
} 

?>