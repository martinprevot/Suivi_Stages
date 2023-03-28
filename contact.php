<?php
session_start(); 
?>
<html>
<head> <link href="style.css" media="all" rel="stylesheet" type="text/css"/> </head>
<body>
<div id="hey"><div id="layer-up"></div></div>
<div id="layer-0">
	
	<div id="layer-1">
		<div id="layer-2">
			<div id="lines">
				<div id="layer-corner"></div>
			</div>
		</div>
	</div>
</div>

<div id="mtnZZZ"></div>
<?php
if (isset($_SESSION["login"]))
 
    {
        if($_SESSION["type"]==0) // si connexion d'eleve
        {
          ?>
         <ul class="nav">
        <li><a href="accueil.php">Accueil</a></li>
        <li><a href="perso.php">Profil</a></li>
        <li><a href="cr.php">Compte rendus</a></li>
        <li><a href="ccr.php">Nouveau compte-rendu</a></li>
        <li><a href="contact.php">Contact</a></li>
        
        </ul><br><br>
        <header>
    <h1><center>
      <small>Nous contacter !</small></h1>
  </header>
  </center>
  <br><br><br><br>
  <?php echo"
  <form method = 'post' action ='accueil.php'><center>
    <p>Votre email : <input name='email' value = '$_SESSION[email]'<br></p>
    <p> Objet de l'email :  <input name='objet'><br></p>
    Votre message : <textarea name ='message' rows =10 cols = 40></textarea>
<br>
<input name ='contact' type ='submit' value ='Envoyer'></center>
</form>";
        }
    




    
    
    }

    
        
        ?>