<?php 

class connexion {
	protected $_db; // Instance de PDO.
	
	// Constructeur
	protected function __construct($db){
		$this->setDb($db);
		//echo("class chargé");
	}
	
	//Setter
	public function setDb(PDO $db){
		$this->_db= $db;
	}
}

?>
