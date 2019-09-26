<?php

class supprimer extends connexion{
   
    // fonction qui se déclenche automatiquement 
	function __construct($db){
        parent::__construct($db);
    }

    public function supprimerPage($id){
    
        /* Requete qui supprime la page de l'id selectionner dans la table pages*/    
        $req=$this->_db->exec(" DELETE FROM pages WHERE id='$id' ");
        /* Requete qui supprime la page de l'id selectionner dans la table navigation*/
        $req2=$this->_db->exec(" DELETE FROM navigation WHERE id_pages='$id' ");

        $message='<script>$.notify("La page a été supprimée avec succès !", {type:"success",icon:"check"});</script>';
        return($message);
     }   
} 

?>