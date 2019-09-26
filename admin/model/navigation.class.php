<?php

class navigation extends connexion{
   
    // fonction qui se déclenche automatiquement 
	function __construct($db){
        parent::__construct($db);
    }

    public function ajout_menu(){
		
        /* Requete qui ajoute une ligne ou desactive le sous menu */    

        // Requete pour recuperer la nouvelle valeur de l'ordre
        $req1=$this->_db->query(" SELECT MAX(ordre) as ordre FROM navigation ");
        $res1=$req1->fetchAll();
        foreach($res1 as $r1){
            $ordre=$r1['ordre']+1;
        }

        //faire une insert d'une ligne vierge 
        $req2=$this->_db->exec(" INSERT INTO navigation (nom,renommer,lien,ordre,sous_menu,actif) VALUES ('','','','$ordre','oui','oui') ");

        $message='<script>$.notify("le menu a été crée avec succès !", {type:"success",icon:"check"});</script>';
        return($message); 
    }

    public function update_sous_menu($id,$menu){
		
		/* Requete qui active ou desactive le sous menu */    
        $req=$this->_db->exec(" UPDATE navigation SET sous_menu='$menu' WHERE id='$id' ");

        if( $menu == 'oui' ){
            $message='<script>$.notify("le sous-menu a été supprimé avec succès !", {type:"info",icon:"check"});</script>';
        }else if( $menu == 'non' ){
            $message='<script>$.notify("le sous-menu a été crée avec succès !", {type:"success",icon:"check"});</script>';
        }
        return($message); 
    }

    public function update_actif($id,$actif){
		
		/* Requete qui active ou desactive l'onglet choisi */    
        $req=$this->_db->exec(" UPDATE navigation SET actif='$actif' WHERE id='$id' ");

        if( $actif == 'oui' ){
            $message='<script>$.notify("l\'onglet est maintenant actif !", {type:"success",icon:"check"});</script>';
        }else if( $actif == 'non' ){
            $message='<script>$.notify("l\'onglet est désactivé maintenant !", {type:"info",icon:"check"});</script>';
        }
        return($message); 
    }

    public function supprimer($id){
		
		/* Requete qui supprime le contenu de l'onglet choisi */    
        $req=$this->_db->exec(" UPDATE navigation SET actif='' WHERE id='$id' ");

        if( $actif == 'oui' ){
            $message='<script>$.notify("l\'onglet est maintenant actif !", {type:"info",icon:"check"});</script>';
        }else if( $actif == 'non' ){
            $message='<script>$.notify("l\'onglet est désactivé maintenant !", {type:"success",icon:"check"});</script>';
        }
        return($message); 
    }

    public function rename($rename,$id){
		
		/* Requete qui renome l'onglet choisi */    
        $req=$this->_db->exec(" UPDATE navigation SET renommer='$rename' WHERE id='$id' ");

        $message='<script>$.notify("l\'onglet a été renommer avec succès !", {type:"success",icon:"check"});</script>';
        return($message); 
    }

    public function ordre($ordre_from,$id_from,$ordre_to,$id_to){
		
		/* Requete qui selectionne l'onglet choisi dans le menu déroulant */    
        $req=$this->_db->exec(" UPDATE navigation SET ordre='$ordre_from' WHERE id='$id_to' ");
        $req2=$this->_db->exec(" UPDATE navigation SET ordre='$ordre_to' WHERE id='$id_from' ");

        $message='<script>$.notify("l\'ordre a été modifié avec succès !", {type:"success",icon:"check"});</script>';
        return($message); 
    }


    public function update_ligne_vierge($ordre_from,$id_from,$ordre_to){
		
		// Requete qui udpate la ligne vierge crée
        $req=$this->_db->exec(" UPDATE navigation SET ordre='$ordre_from' WHERE id='$ordre_to' ");
        // Requete qui suprime la ligne vierge
        $req2=$this->_db->exec("  DELETE FROM navigation WHERE id='$id_from' ");

        $message='<script>$.notify("Menu ajouté avec succès !", {type:"success",icon:"check"});</script>';
        return($message); 
    }


    public function listing_pages(){
        /* Requete qui affiche la liste des pages dans le menu déroulant */
		$req=$this->_db->query(" SELECT * FROM navigation ORDER BY `navigation`.`ordre` ASC ");
		$res=$req->fetchAll();
        return $res;
    }
} 

?>