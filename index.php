<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link href="style1.css" media="all" rel="stylesheet" type="text/css"/>
        <title>SioReport</title>
    </head>
     <body>
		





<div class="container">
	<div class="screen">
		<div class="screen__content">
			<form class="login" method="POST" action="accueil.php">
				<div class="login__field">
					<i class="login__icon fas fa-user"></i>
					<input type="text" class="login__input" placeholder="login" name="login">
				</div>
				<div class="login__field">
					<i class="login__icon fas fa-lock"></i>
					<input type="password" class="login__input" placeholder="Mot de passe" name="mdp">
				</div>
					<span class="button__text"><input  class="button login__submit" type="submit" name="envoi" value="OK"></span>
			</form>			
		</div>
		<div class="screen__background">
			<span class="screen__background__shape screen__background__shape4"></span>
			<span class="screen__background__shape screen__background__shape3"></span>		
			<span class="screen__background__shape screen__background__shape2"></span>
			<span class="screen__background__shape screen__background__shape1"></span>
		</div>		
	</div>
</div>

</body>
</html>




<?php
//BOUTON DECO PHP
      if (isset($_POST['deco']))
            {
              session_destroy();
              //détruit la session après clique sur bouton deconnexion
              echo "deconnectée";
            } 
?>