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

if($_SESSION["type"]==1) 
        {
            
 ?>             <ul class="nav">
        <li><a href="accueil.php">Accueil</a></li>
        <li><a href="perso.php">Profil</a></li>
        <li><a href="eleve.php">Liste des éleves</a></li>
          <li><a href="cr.php">Compte rendus</a></li>
        </ul></html>
        <?php
        
      
          //*********************************************
          // Verifie si le lien supprimer a était cliqué.
          //*********************************************

        if(isset($_GET['id'])) /*verification que la variable est envoyé*/
        {
        $nomvar=$_GET['id'];
        $connexion = mysqli_connect($serveurBDD,$userBDD,$mdpBDD,$nomBDD);
        $requete2="DELETE FROM cr WHERE cr.num_utilisateur = $nomvar";
        mysqli_query($connexion, $requete2);
        $requete="DELETE FROM utilisateur WHERE utilisateur.num = $nomvar";
        mysqli_query($connexion, $requete);
        echo "Eleve supprimer !";
        }




          //*********************************************
          // Affichage tableau eleve + tuteur
          //*********************************************

        $connexion = mysqli_connect($serveurBDD,$userBDD,$mdpBDD,$nomBDD);
        $requete="SELECT * from utilisateur where type =0"; //recupere tous les éleves
        $resultat = mysqli_query($connexion, $requete);
        while($donnees = mysqli_fetch_assoc($resultat))
          {
            $id=$donnees['num'];
            $prenom = $donnees ['prenom'];
            $nom = $donnees ['nom'];
            $tel = $donnees ['tel'];
            $email = $donnees ['email'];
            $requete="SELECT tuteur.nom,tuteur.prenom,tuteur.tel,tuteur.email FROM utilisateur,stage,tuteur WHERE utilisateur.num_stage=stage.num AND stage.num_tuteur = tuteur.num and utilisateur.num= $id;"; //modif compte rendu avec infos recuperees
            $resultats = mysqli_query($connexion, $requete);
            while($donnees = mysqli_fetch_assoc($resultats))
            {
                $Tprenom = $donnees['prenom'];
                $Tnom = $donnees['nom'];
                $Ttel = $donnees['tel'];
                $Temail = $donnees['email'];
            }
           
            echo "<table border =2>
            <thead>
                <tr>
                <th colspan='4'>Eleve n°$id</th>  
                <th colspan='4'>Tuteur</th>  
                </tr>
                <tr>
                <th colspan='1'>Nom</th> <th colspan='1'> Prenom</th>
                <th colspan='1'>Email</th> <th colspan='1'> tel</th>
                <th colspan='1'>Nom</th> <th colspan='1'> Prenom</th>
                <th colspan='1'>Email</th> <th colspan='1'> Tel</th>
            </tr>
            </thead>
            <tbody>
            <tr> 
                  <td><center>$prenom</td>
                  <td><center>$nom</td>
                  <td><center>$email</td>
                  <td><center>$tel</td>
                  <td><center>$Tprenom</td>
                  <td><center>$Tnom</td>
                  <td><center>$Temail</td>
                  <td><center>$Ttel</td>
            </tr>
              <th colspan='4'><a href='eleve.php?id=$id'>Supprimer</a></th> 
          </tbody>
          </table><br>";  
          }
      }

?>

