<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>installation de votre site</title>

        <style>
            html, body {font-family: Tahoma}
            p{text-align:center}

            .db_register {width: 30%;margin: 10vh 35%}
            .db_register h2 {text-align: center}
            .db_register h3 {text-align: center;font-size: 15px;font-weight: normal;color:#5757f1}
            .db_register input[type="text"],.db_register input[type="password"]
                {width: 100%;display: block;margin: 10px 0;height: 5vh;background: #F4F4F4;border-radius: 3px;border: solid 2px #EFEFEF;padding-left: 5px}
            .db_register input[type="submit"] 
                {width: auto;margin: 10px auto;padding: 10px;display: block;border-radius: 3px;border: none;background: #252525;color: #FFF;cursor:pointer}

            .red{color:red}
            .green{color:green}    

        </style>	

    </head>
<body>

<?php

	/////////////////////////////
	////////Controller///////////
	/////////////////////////////
	
    $message="";
	
	$fichier_config = "config_install.php";

	/** 1er formulaire */
	if(isset($_POST['etape_1'])){
        if( !empty($_POST['dbname']) and !empty($_POST['host']) and !empty($_POST['login']) ){

			$dbname = htmlentities(addslashes($_POST['dbname']));
			$host = htmlentities(addslashes($_POST['host']));
			$login = htmlentities(addslashes($_POST['login']));
			$mdp = htmlentities(addslashes($_POST['mdp']));

			try {
				$db = new PDO("mysql:host=$host;dbname=$dbname", "$login", "$mdp");
			} catch (Exception $e) {}
			
			if( empty($e) ){
				$contenu_config = '
					<?php
						$host="'.$host.'";
						$dbname="'.$dbname.'";
						$login="'.$login.'";
						$mdp="'.$mdp.'";

						$db = new PDO("mysql:host='.$host.';dbname='.$dbname.'","'.$login.'","'.$mdp.'"); 
					?>
				';
				
				// On ouvre le fichier pour écrire, (premier parametre = le nom du fichier | 2ème paramètre = le mode d'écriture (w = créer le fichier s'il n'est pas fait sinon il l'écrase))
				$cree_fichier_config = fopen($fichier_config, 'w');
				fputs($cree_fichier_config, $contenu_config);
			}else{
				$message="<p class='red'>Impossible de se connecter a la base données</p>";
			}	
        }else{
            $message="<p class='red'>Champs vides ou incomplet !</p>";
		}
	}

	/** 2ème formulaire */
	if(isset($_POST['admin_create'])){
		if( !empty($_POST['log']) AND !empty($_POST['pass']) AND !empty($_POST['pseudo']) ){
			
			$login = htmlentities(addslashes($_POST['log']));
			$password = htmlentities(addslashes($_POST['pass']));
			$pseudo = htmlentities(addslashes($_POST['pseudo']));

			require $fichier_config;

			// importation de la base de donnée
			$db->query(file_get_contents("mysql.sql"));
			// importation du compte admin 
			$db->exec("INSERT INTO `users`(`login`,`password`,`nom`,`actif`) VALUES ('$login','$password','$pseudo','oui')");
			
			$move = fopen("tmp/install.php", 'w');
			fputs( $move,file_get_contents("install.php") );
			unlink('install.php');

			$lien="http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['SCRIPT_NAME']);
			?> <script>location.href='<?= $lien."/admin" ?>';</script> <?php
		}else{
			$message="<p class='red'>Champs vides ou incomplet !</p>";
		}
	}

/////////////////////////////
/////////// View ////////////
/////////////////////////////


/** 1er formulaire */
if(file_exists('index.php')){
	if(!file_exists($fichier_config)){
?>		
	<div class="db_register">
		<h2>Installer votre site (1/2)</h2>
		<hr>
		<h3>Vous devez au préalable avoir une base de donnée déja crée, par votre hébergeur.</h3>
		<h3>Renseigner les informations de la base de donnée fournit par votre serveur : ovh, amen, hosting...</h3>
		<hr>
		<form method="post">
			<label for="dbname">Nom base</label>
			<input type="text" name="dbname"/>

			<label for="host">Hôte de la base : ex : localhost</label>
			<input type="text" name="host"/>

			<label for="login">Utilisateur</label>
			<input type="text" name="login"/>

			<label for="mdp">Mot de passe</label>
			<input type="text" name="mdp"/>
			
			<input class="btn" type="submit" name="etape_1" value="Créer la structure"/>
		</form>
	</div>	
		
<?php	
	}else{
		require $fichier_config;
		$voir_table = $db -> query("SHOW TABLES") ;
		$res_count = $voir_table -> rowCount();

		if ($res_count == 0){
			/** 2eme formulaire */
			?>
			<div class="db_register">
				<h2>Installer votre site (2/2)</h2>
				<h3>Créer un compte administrateur sur votre site</h3>
				<form method="post">
					<label for="pseudo">Pseudo</label>
					<input type="text" name="pseudo"/>

					<label for="log">Identifiant</label>
					<input type="text" name="log"/>

					<label for="pass">Mot de passe</label>
					<input type="text" name="pass"/>

					<input type="submit" name="admin_create" value="Créer">
				</form>
			</div>	
			<?php
		}
	}
}else{
	$message="<p style:'color:red'>Erreur : Le fichier index.php est manquant !</p>";
}

	// Message d'erreur
	echo $message;
?>

	
</body>
</html>