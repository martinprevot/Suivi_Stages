<?php
session_start();
include '_conf.php';
if(isset($_GET['id'])) /*verification que la variable est envoyé*/
{
  $nomvar=$_GET['id'];
}

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
 if($_SESSION["type"]==0) // si connexion d'eleve
        {
          ?>
         <ul class="nav">
        <li><a href="accueil.php">Accueil</a></li>
        <li><a href="perso.php">Profil</a></li>
        <li><a href="cr.php">Compte rendus</a></li>
        <li><a href="ccr.php">Nouveau compte-rendu</a></li>
        </ul>
 
            <?php
        if($connexion = mysqli_connect($serveurBDD,$userBDD,$mdpBDD,$nomBDD))
            {
             $id=$_SESSION["id"];
             $requete="SELECT cr.description FROM cr WHERE cr.num=$nomvar"; //recupere tous les comptes rendus par date decroissante
             $resultat = mysqli_query($connexion, $requete);
             while($donnees = mysqli_fetch_assoc($resultat))
             {
              $description=$donnees['description'];
                }
            echo "Modification de votre CR n°$nomvar<br><br>";
            echo"<FORM method='post' action='cr.php?id=$nomvar'><div>  <textarea name='contenu' rows=10 cols=40> $description  </textarea><br><br>";
            echo"<button type='submit' name='modif'> Confirmer </button><br><br>";
           echo " <button type=submit name='deco'> DECONNEXION </button> </form>";


        }
        if($_SESSION["type"]==1)
        {
?>
              <ul class="nav">
        <li><a href="accueil.php">Accueil</a></li>
        <li><a href="perso.php">Profil</a></li>
        <li><a href="cr.php">Compte rendus</a></li>
        </ul></html><?php   }}?>
