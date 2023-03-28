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

include '_conf.php';
if (isset($_POST['update'])) //recupere données de ccr.php
      { 
        $date=$_POST['date'];
        $note=$_POST['note'];
        $contenu= addslashes($_POST['contenu']);
        $ide=$_SESSION["id"];
        $connexion = mysqli_connect($serveurBDD,$userBDD,$mdpBDD,$nomBDD);
        $requete="INSERT INTO cr (date,datetime,description,note,num_utilisateur) VALUES ('$date',NOW(),'$contenu',$note,$ide);";
        if(!mysqli_query($connexion,$requete)) 
            {
            echo "erreur";
            }
        else //si possibilité de faire la requete :
            {
           echo "nouveau compte-rendu crée";
            }
        }
if (isset($_POST['modif'])) //recupere données de modif.php
      {
if(isset($_GET['id'])) /*verification que la variable est envoyé*/
{
  $nomvar=$_GET['id'];
}

        $contenu= addslashes($_POST['contenu']);
        $id=$_SESSION["id"];
        $connexion = mysqli_connect($serveurBDD,$userBDD,$mdpBDD,$nomBDD);
        $requete="UPDATE cr SET description = '$contenu' WHERE num_utilisateur=$id AND num=$nomvar"; //modif compte rendu avec infos recuperees
        if(!mysqli_query($connexion,$requete))  
            {
            echo "erreur";
            }
        else //si possibilité de faire la requete :
            {
           echo "compte-rendu modifié";
            }
        }
if ($_SESSION["type"] ==1) //si connexion en prof
  {
 ?>
  
    <ul class="nav">
    <li><a href="accueil.php">Accueil</a></li>
    <li><a href="perso.php">Profil</a></li>
    <li><a href="eleve.php">Liste des éleves</a></li>

    <li><a href="cr.php">Compte rendus</a></li>
    </ul> 
    <header>
    <h1><font size=5 align="center" > Liste des comptes rendus :  </font> </div></h1> </header> <br></h1>

<?php 
if($connexion = mysqli_connect($serveurBDD,$userBDD,$mdpBDD,$nomBDD))
      {
        $id=$_SESSION["id"]; 
        $requete="SELECT cr.*,utilisateur.nom FROM cr,utilisateur WHERE cr.num_utilisateur=utilisateur.num ORDER BY date DESC"; //recupere tous les comptes rendus par date decroissante
        $resultat = mysqli_query($connexion, $requete);
        while($donnees = mysqli_fetch_assoc($resultat))
          {
            $num=$donnees['num'];
            $contenu=$donnees['description'];
            $nom = $donnees ['nom'];
            $date = $donnees ['date'];
            $note=$donnees['note'];
            if ($note==0)
            $note = "Non noté"; 
            
            echo "<table border=2><thead> <tr> <th colspan=2> <u><center>Compte rendu n°$num de $nom</center></u> </th> </tr> </thead>
            <tbody> <tr> <td>  $contenu</td> </tr> <tr><td><center>Note données par l'éleve : $note</tr></td></center><tr> <td><center>$date</center> </td> </tr> </tbody> </table> <br>";  //affiche tous les compte rendus du plus recent au plus ancien + lien pour modifier
          }
    }

}
if($_SESSION["type"]==0) //si connexion en eleve
  { 
    ?>
    
    <ul class="nav">
    <li><a href="accueil.php">Accueil</a></li> 
    <li><a href="perso.php">Profil</a></li>
    <li><a href="cr.php">Compte rendus</a></li>
    <li><a href="ccr.php">Nouveau compte-rendu</a></li>
    <li><a href="contact.php">Contact</a></li>

    </ul> 
    <header>
    <h1>
 <font size=5 align="center" > Liste de vos comptes rendus :  </font> </div></h1> </header> <?php

       if($connexion = mysqli_connect($serveurBDD,$userBDD,$mdpBDD,$nomBDD))
      {
        $id=$_SESSION["id"];     
        $requete="SELECT cr.* FROM cr,utilisateur WHERE utilisateur.num = cr.num_utilisateur AND utilisateur.num=$_SESSION[id] ORDER BY date DESC"; //recupere tous les comptes rendus par date decroissante
        
        $resultat = mysqli_query($connexion, $requete);
        while($donnees = mysqli_fetch_assoc($resultat))
          {
            $num=$donnees['num'];
            $contenu=$donnees['description'];
            $note=$donnees['note'];
            if ($note==0)
                $note = "Non noté"; 
            echo "<table border=2><thead> <tr> <th colspan=2> <u>n°$num</u> </th> </tr> </thead>
            <tbody> <tr> <td>  $contenu</td></tr><tr><td><center>Note : $note</tr></td><tr> <td> <center> <a href='modif.php?id=$num'>Modifier</a></center>  </td> </tr> </tbody> </table> <br>";  //affiche tous les compte rendus du plus recent au plus ancien + lien pour modifier
          }
    }

 
    }  
?>
