<?php

class update extends connexion{
   
    // fonction qui se déclenche automatiquement 
	function __construct($db){
        parent::__construct($db);
    }

    public function updateTemplates($dossier){
    
        /* Requete qui actif le template choisi */    
        $req1=$this->_db->exec(" UPDATE settings SET actif='oui' WHERE theme='$dossier' ");
        
        /* Requete qui désactive les autres templates */    
        $req2=$this->_db->exec(" UPDATE settings SET actif='non' WHERE theme!='$dossier' ");

        $message='<script>$.notify("Le thème a été sélectionner avec succès !", {type:"success",icon:"check"});</script>';

        return($message);

    } 
    
    public function updateCouleurs($couleur_pri,$couleur_sec,$couleur_txt,$id){
    
        /* Requete qui update les couleurs du template choisi */    
        $req=$this->_db->exec(" UPDATE settings SET couleur_pri ='$couleur_pri', couleur_sec ='$couleur_sec', couleur_txt ='$couleur_txt' WHERE id='$id' ");

        $message='<script>$.notify("Les couleurs on été enregistré !", {type:"success",icon:"check"});</script>';
    
        return($message);
    
    }

    public function insertPage($lien,$titre,$image,$contenu,$sous_titre){

        /* Requete qui insert dans la table pages, la nouvelle page */    
        $req=$this->_db->exec(" INSERT INTO pages(lien,titre,image,contenu,sous_titre,actif) VALUE('$lien','$titre','$image','$contenu','$sous_titre','oui') ");

        /** Requete qui recupere le nouvel id de l'insert de la ligne du dessus */
        $req2=$this->_db->query("SELECT id from pages WHERE lien='$lien' AND titre='$titre'");
        $res=$req2->fetchAll();
        foreach($res as $r){
            $id=$r['id'];
        }

        $req3=$this->_db->exec(" INSERT INTO navigation(id_pages,nom,renommer,lien,sous_menu,actif) VALUE('$id','$titre','$titre','$lien','oui','oui') ");

        $message='<script>$.notify("Votre page a été enregistré avec succès !", {type:"success",icon:"check"});</script>';
    
        return($message);
    }

    public function updatePage($id,$lien,$titre,$image,$contenu,$sous_titre){
    
        /* Requete qui update la page affiché */    
        $req=$this->_db->exec(" UPDATE pages SET lien ='$lien', titre ='$titre', image ='$image', contenu ='$contenu', sous_titre ='$sous_titre' WHERE id='$id' ");

        /* Requete qui update la page dans la table navigation */ 
        $req2=$this->_db->exec(" UPDATE navigation SET nom ='$titre', renommer ='$titre', lien ='$lien' WHERE id_pages='$id' ");

        $message='<script>$.notify("La page a été modifié avec succès !", {type:"success",icon:"check"});</script>';

        return($message);
    
    }

    public function update_actif($id,$actif){
    
        /* Requete qui active ou desactive la page choisi */    
        $req=$this->_db->exec(" UPDATE pages SET actif='$actif' WHERE id='$id' ");
        
        if( $actif == 'non' ){
            $message='<script>$.notify("la page a été désactivé avec succès !", {type:"success",icon:"check"});</script>';
        }else if( $actif == 'oui' ){
            $message='<script>$.notify("la page a été activé avec succès !", {type:"success",icon:"check"});</script>';
        }

        return($message);

    }

    public function update_accueil_head($titre,$sous_titre,$contenu,$image,$id){
    
        /* Requete qui update la page affiché */    
        $req=$this->_db->exec(" UPDATE accueil SET titre ='$titre', sous_titre ='$sous_titre', contenu ='$contenu', image='$image' WHERE lien='index.php' AND id='$id' ");

        $message='<script>$.notify("La page a été modifié avec succès !", {type:"success",icon:"check"});</script>';
       
        return($message);
    
    }

    public function update_post_accueil($titre,$sous_titre,$image,$id,$position){
    
        /* Requete qui update la page affiché */    
        $req=$this->_db->exec(" UPDATE accueil SET titre ='$titre', sous_titre ='$sous_titre', image='$image', position='$position' WHERE id='$id' ");

        $message='<script>$.notify("Le post a été modifié avec succès !", {type:"success",icon:"check"});</script>';
       
        return($message);
    
    }


   
} 

?>