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
require_once '_conf.php';
if (isset($_POST['envoi'])) //reçois données rentrée lors de la connexion
{
   
    $login = $_POST['login'];
    $mdp = md5($_POST['mdp']);
    

    $connexion = mysqli_connect($serveurBDD,$userBDD,$mdpBDD,$nomBDD);
    $requete="Select * from utilisateur WHERE login = '$login' AND motdepasse= '$mdp'"; //recupere données utilisateur 
    $resultat = mysqli_query($connexion, $requete);
    $trouve=0;  
    while($donnees = mysqli_fetch_assoc($resultat))
      {
   
        $trouve=1;
        $type=$donnees['type'];
        $login=$donnees['login'];
        $dateN=$donnees['dateNaissance'];
        $id=$donnees['num'];
        $prenom = $donnees ['prenom'];
        $nom = $donnees ['nom'];
        $tel = $donnees ['tel'];
        $email = $donnees ['email'];
     // echo "je créé mes sessions !!!";
        $_SESSION["id"]=$id; //relie variable avec session
        $_SESSION["login"]=$login;
        $_SESSION["type"]=$type;
        $_SESSION["prenom"]=$prenom;
        $_SESSION["nom"]=$nom;
        $_SESSION["email"]=$email;
        $_SESSION["tel"]=$tel;    
        $_SESSION["dateN"]=$dateN;

      }


}
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
        
        </ul>
 
            <?php
            echo "bienvenue sur le compte élève <br> <br>";
            echo "Vous êtes connecté en tant que ".$_SESSION["login"]."<br> <br>";
            
            //*********************************************
            // Verifie si un mail a était envoyé depuis la page contact.php
            //*********************************************

            if (isset($_POST['contact'])) 
            {
              $email = $_POST['email'];
              $objet = $_POST['objet'];
              $message = $_POST['message'];

              echo "email : $email <br> objet : $objet <br> message :$message<br>";
              if (mail('martin.prevot75@gmail.com',$objet,$message))
              {
                  echo"<br><br> Votre email a bien été envoyé. ";
              }
                      else  
                  {
                          echo "<br><br> Erreur envoie email!!";
                  }
            }

           echo "<FORM method='post' action='index.php'> <button type=submit name='deco'> DECONNEXION </button> </form>";
        }

        if($_SESSION["type"]==1) // Si connexion en prof
        {
?>
              <ul class="nav">
        <li><a href="accueil.php">Accueil</a></li>
        <li><a href="perso.php">Profil</a></li>
        <li><a href="eleve.php">Liste des éleves</a></li>

        <li><a href="cr.php">Compte rendus</a></li>
        </ul></html>
<?php
             echo "Bienvenue sur le compte professeurs <br> <br>";
            echo "Vous êtes connecté en tant que ".$_SESSION["login"]."<br> <br>";
            echo "<FORM method='post' action='index.php'> <button type=submit name='deco'> DECONNEXION </button> </form>";
        }


          //*********************************************
          // Pour connexion en secretaire.
          //*********************************************

        if($_SESSION["type"]==2)
        {
          echo "bienvenue sur le compte secretaire <br> <br>";

          echo "Vous êtes connecté en tant que ".$_SESSION["login"]."<br> <br>";


          
          //*********************************************
          // Compte le nombre de prof
          //*********************************************
          $connexion = mysqli_connect($serveurBDD,$userBDD,$mdpBDD,$nomBDD);
          $requete="Select * from utilisateur where utilisateur.type =1;"; //requete
          $resultat = mysqli_query($connexion, $requete);
          $trouve=0;  
          $test1=0;  
          while($donnees = mysqli_fetch_assoc($resultat)){
            $trouve =1;
            $test1=$test1+1;// Compte le nombre de resultat de requete
          }

          //*********************************************
          // Compte le nombre d'éleve
          //*********************************************
          
          $connexion = mysqli_connect($serveurBDD,$userBDD,$mdpBDD,$nomBDD);
          $requete="Select * from utilisateur where utilisateur.type =0"; //requete
          $resultat = mysqli_query($connexion, $requete);
          $test0=0;  

          while($donnees = mysqli_fetch_assoc($resultat)){
            $trouve =1;
            $test0=$test0+1;// Compte le nombre de resultat de requete
          }

          //*********************************************
          // Compte le nombre de compte rendu
          //*********************************************
          $connexion = mysqli_connect($serveurBDD,$userBDD,$mdpBDD,$nomBDD);
          $requete="Select * from cr"; //requete
          $resultat = mysqli_query($connexion, $requete);
          $testcr=0;  

          while($donnees = mysqli_fetch_assoc($resultat)){
            $trouve =1;
            $testcr=$testcr+1; // Compte le nombre de resultat de requete
          }


          //*********************************************
          // Affichage du tableau 
          //*********************************************
         echo " <table border =1>
          <thead>
              <tr>
                  <th colspan='3'>Résume de stage</th> 
              </tr>
          </thead>
          <tbody>
              <tr>
                  <td>Nombre d'éleve</td>
                  <td>Nombre de professeurs</td>
                  <td>Nombre de Compte rendu </td>

              </tr>
              <tr>
                  <td><center>$test0</td>
                  <td><center>$test1</td>
                  <td><center>$testcr</td>

              </tr>
          </tbody>
          </table><br><br><br>";  


   // bouton déconnexion
   echo "<FORM method='post' action='index.php'> <button type=submit name='deco'> DECONNEXION </button> </form>";
        } 

    
        
     

    }
    else
    {
     
    
          echo "erreur de connexion";
     
    }
 





?>
</html>
