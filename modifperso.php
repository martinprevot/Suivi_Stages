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
<ul class="nav">
        <li><a href="accueil.php">Accueil</a></li>
        <li><a href="perso.php">Profil</a></li>
        <li><a href="cr.php">Compte rendus</a></li>
        <li><a href="ccr.php">Nouveau compte-rendu</a></li>
        <li><a href="contact.php">Contact</a></li>
        
        </ul>
<center>
<form method="POST" action="perso.php">
    <label>Nom : </label>
    <input type="text" name="nom1" value ='<?php echo $_SESSION["nom"]  ?>' /><br>
    <label>Prenom :</label>
    <input type="text" name="prenom1" value ='<?php echo $_SESSION["prenom"]  ?>' /><br>
    <label>email :</label>
    <input type="text" name="email1" value ='<?php echo $_SESSION["email"]  ?>' /><br>
    <label>tel :</label>
    <input type="text" name="tel1" value ='<?php echo $_SESSION["tel"]  ?>' /><br>
<br>
  <button type="submit" name="modifperso">Modifier !</button>
</form>
</center>