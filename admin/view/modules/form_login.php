<?php 
require"controller/form_login.php"; 
if(!isset($_SESSION['admin'])){   
?>

<div class="card">
	<article class="card-body">
		<a href="../index.php">
			<img src="../images/logo.svg" alt="" width="72" height="72" class="milieu icone">
		</a>	
		<h4 class="card-title text-center mb-4 mt-1">Se connecter</h4>
		<hr>
		<p class="text-center text-danger"><?php echo $message ?></p>
		<form method="post">
			<div class="form-group">
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"> <i class="fa fa-user"></i> </span>
					</div>
					<input class="form-control" placeholder="Identifiant" type="text" name="login" >
				</div> 
			</div>
			<div class="form-group">
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"> <i class="fa fa-lock"></i> </span>
					</div>
					<input class="form-control" placeholder="******" type="text" name="pass">
				</div>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary btn-block" name="connect">Connexion</button>
			</div>
			<!--<p class="text-center"><a href="#" class="btn">Forgot password?</a></p>--> 
		</form>
	</article>
</div>

<?php
}
?>

