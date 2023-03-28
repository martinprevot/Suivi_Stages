<?php
session_start();
include '_conf.php';

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
if ($_SESSION["type"] ==1) //si connexion en prof
  {
    ?>
    <html>
    <ul class="nav">
    <li><a href="accueil.php">Accueil</a></li>
    <li><a href="perso.php">Profil</a></li>
    <li><a href="eleve.php">Liste des éleves</a></li>

    <li><a href="cr.php">Compte rendus</a></li>
    </ul> </html> <?php
  }
  if($_SESSION["type"]==0)
  {
    ?>
    <html>
    <ul class="nav">
    <li><a href="accueil.php">Accueil</a></li>
    <li><a href="perso.php">Profil</a></li>
    <li><a href="cr.php">Compte rendus</a></li>
    <li><a href="ccr.php">Nouveau compte-rendu</a></li>
    <li><a href="contact.php">Contact</a></li>

    </ul> </html> <?php
  }



            //*********************************************
            // Pour efectuer une modif de l'eleve
            //*********************************************

  if (isset($_POST['modifperso'])) //reçois données rentrée lors de la connexion
  {
     $nom1 = $_POST['nom1'];
     $prenom1 = $_POST['prenom1'];
     $email1 = $_POST['email1'];
     $tel1 = $_POST['tel1'];
     $connexion = mysqli_connect($serveurBDD,$userBDD,$mdpBDD,$nomBDD);
     $requetes="UPDATE `utilisateur` SET `nom` =  '$_POST[nom1]', `prenom` = '$_POST[prenom1]', `email` = '$_POST[email1]', `tel` = '$_POST[tel1]' WHERE `utilisateur`.`num` = $_SESSION[id] ";
    mysqli_query($connexion, $requetes);
      $_SESSION["prenom"]=$prenom1;
      $_SESSION["nom"]=$nom1;
      $_SESSION["email"]=$email1;
      $_SESSION["tel"]=$tel1;
   }

        



?>

<div class="profile">
  <figure>

  </figure>
  <header>
    <h1><center>
      <small>Vos informations personnels :</small></h1>
  </header>
  
  <div class="toggle">


  </div>
  <main>
    <dl><center>
      Nom complet : <?php echo      $_SESSION["prenom"],"  ", $_SESSION["nom"];?><br>
      Email : <?php echo $_SESSION["email"]?><br>
      Télephone :<?php echo $_SESSION["tel"]?><br>
      <?php
      $dateNaissance = $_SESSION["dateN"];
      $aujourdhui = date("Y-m-d");
      $diff = date_diff(date_create($dateNaissance), date_create($aujourdhui));
      echo ' Age : '.$diff->format('%y');
      ?>
    <br>
      Status : 
      <?php if ($_SESSION["type"] ==1){echo "Professeurs";} 
        if($_SESSION["type"]==0){echo "Eleve";?></dd><br><br>
        <a href ="modifperso.php" style="color:#FF0000;">Modifier vos informations</a>
 <br> <br> <br>

 <h1> Information du tuteur :</h1>
 <?php 
$connexion = mysqli_connect($serveurBDD,$userBDD,$mdpBDD,$nomBDD);
$requete="SELECT tuteur.nom,tuteur.prenom,tuteur.tel,tuteur.email FROM utilisateur,stage,tuteur WHERE utilisateur.num_stage=stage.num AND stage.num_tuteur = tuteur.num and utilisateur.num= $_SESSION[id];"; //modif compte rendu avec infos recuperees
$resultat = mysqli_query($connexion, $requete);
while($donnees = mysqli_fetch_assoc($resultat))
  {
$prenom = $donnees['prenom'];
$nom = $donnees['nom'];
$tel = $donnees['tel'];
$email = $donnees['email'];
  }
?>
Nom complet : <?php echo      $prenom. "   ".  $nom;?><br>
Email : <?php echo $email?><br>
Télephone :<?php echo $tel ; }?><br>

    </dl>
  </main>

</div>


</html>



