<?php 

require"controller/updateAccueil.php";

// message d'erreur ou de succès en fonction 
echo $message;
?>

<!-- <h1 class='h2'>Mettre a jour la page :</h1> -->
<form method="post" enctype="multipart/form-data">
	<div class="form-group">
        <span>Liens permanent : </span>
        <a href="../">Page d'acceuil</a>
    </div>
    <div class="border-bottom"></div>
    <h4 class="mt-5">Titre principale :</h4>
    <div class="input-group mb-3">
		<div class="input-group-prepend">
            <span class="input-group-text">www.<?=  $_SESSION['name'] ?>/</span>
        </div>
        <input type="text" class="form-control" name="titre" value="<?= $a[0]['titre'] ?>">
    </div>

    <h4>Sous-titre :</h4>
    <div class="input-group mb-4">
		<input type="text" class="form-control" name="sous_titre" value="<?= $a[0]['sous_titre'] ?>">
    </div>

	<h4>Contenu :</h4>
    <div class="input-group mb-4">
        <textarea class="form-control textarea_middle" name="contenu"><?= $a[0]['contenu'] ?></textarea>
    </div>

	<h4 style="margin-bottom: 2rem;">Image bannière:</h4>
	<div class="form-group">
		<div class="input-group input-file" style="margin-top: -22px;">
			<span class="input-group-btn">
        		<button class="btn btn-default btn-choose" type="button"><i class="far fa-image"></i></button>
    		</span>
			<input type="hidden" name="image" value="<?= $a[0]['image']; ?>"/>
    		<input type="file" class="form-control" name="image"/>
            <button type="reset" class="btn btn-danger"><i class="fas fa-times"></i></button>
		</div>
	</div>
	<input type="hidden" name="id" value="1">

	<input class="btn btn-primary bouton_pages" type="submit" value="mettre a jour la bannière" name="update_acceuil">
</form>
	
	<?php 

	/** Article :  */
	foreach ($afficher_accueil_head->afficher_accueil_all_post() as $p) {
		?>
			<a href="#drop<?= $p['id']; ?>">
					<div class="dropdown w-100" id="drop<?= $p['id']; ?>">
					<button onclick="myFunction<?= $p['id']; ?>()" class="dropbtn w-100 btn btn-secondary">Elements n°<?= $p['id'] ?></button>
			</a>	
				<div id="myDropdown<?= $p['id']; ?>" class="dropdown-content w-100 p-4">
					<form method="post">
						
						<h4>Titre :</h4>
						<div class="input-group mb-4">
							<input type="text" class="form-control" name="titre" value="<?= $p['titre'] ?>">
						</div>

						<h4>Resumer :</h4>
						<div class="input-group mb-4">
							<textarea class="form-control textarea_little" name="sous_titre"><?= $p['sous_titre'] ?></textarea>
						</div>

						<? $p['image']; ?>

						<h4 style="margin-bottom: 2rem;">Image :</h4>
						<div class="form-group">
							<div class="input-group input-file" style="margin-top: -22px;">
								<span class="input-group-btn">
									<button class="btn btn-default btn-choose" type="button"><i class="far fa-image"></i></button>
								</span>
								<input type="file" class="form-control" name="image"/>
								<input type="hidden" name="image" value="<?= $p['image']; ?>"/>
								<button type="reset" class="btn btn-danger"><i class="fas fa-times"></i></button>
							</div>
						</div>

						<h4>Alignement :</h4>
						<div class="input-group mb-4">
							<div class="input-group-prepend">
								<label class="input-group-text"><i class="fas fa-align-left"></i></label>
							</div>
							<select class="custom-select" name="position">
								<option selected>Choisir ...</option>
								<option name="gauche" value="gauche"
									<?php 
										if($p['position'] == 'gauche' ){
										echo " selected='selected' ";
										}
									?>
								>Gauche</option>
								<option name="droite" value="droite"
								<?php 
										if($p['position'] == 'droite' ){
										echo " selected='selected' ";
										}
									?>
								>Droite</option>
							</select>
						</div>

						<input type="hidden" name="id" value="<?= $p['id']; ?>">
						<input class="btn btn-primary bouton_pages" type="submit" value="mettre a jour le post" name="update">
					</form>
				</div>
			</div>			
		<?php
			}	
	?>



	<script>
		// Script pour le dropdown
		function myFunction2() {
			document.getElementById("myDropdown2").classList.toggle("show");
		}
		
		function myFunction3() {
			document.getElementById("myDropdown3").classList.toggle("show");
		}
		function myFunction4() {
			document.getElementById("myDropdown4").classList.toggle("show");
		}

		
		window.onclick = function(event) {
		if (!event.target.matches('.dropbtn')) {

			var dropdowns = document.getElementsByClassName("dropdown-content");
			var i;
			for (i = 0; i < dropdowns.length; i++) {
			var openDropdown = dropdowns[i];
			if (openDropdown.classList.contains('show')) {
				//openDropdown.classList.remove('show');
			}
			}
		}
		}

		// Script pour le scroll
		$(document).ready(function(){
			$('a[href^="#"]').click(function(){
					var the_id = $(this).attr("href");
				$('html, body').animate({
					scrollTop:$(the_id).offset().top
				}, 'slow');
				return false;
				});
			});	
	</script>