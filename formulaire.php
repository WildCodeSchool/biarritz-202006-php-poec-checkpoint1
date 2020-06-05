<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Formulaire</title>
    </head>
    <body>
        <form  action="/formulaire.php"  method="post">
            <div>
                <label  for="nom">Nom :</label>
                <input  type="text"  id="nom"  name="user_name">
            </div>
            <div>
                <label  for="payment">Payment :</label>
                <input  type="int"  id="payment"  name="user_payment">
            <div  class="button">
              <button  type="submit">Submitt !</button>
            </div>
            </form>
        <?php
        $serveur = "localhost";
        $dbname = "checkpoint1";
        $user = "root";
        $pass = "root";
         
        $nom = $_POST["nom"];
        $payment = $_POST["payment"];

        try{
            //Je me connecte à la BDD
            $dbco = new PDO("localhost=$serveur;checkpoint1=$dbname",$user,$pass);
            $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
            //J'insère les données reçues
            $sth = $dbco->prepare("INSERT INTO pot_de_vin(nom, payment) VALUES(:nom, :payment)");
            $sth->bindParam(':nom',$nom);
            $sth->bindParam(':payment',$payment);
            $sth->execute();
            
            //Je voulais renvoyer l'utilisateur vers une page de remerciement mais il faut S'il y a des erreurs, affichez-les en haut du formulaire.
            //header("Location:formulaire.php");
        }
        catch(PDOException $e){
            echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
        }
        if(isset($_POST['valider'])){
            $nom=$_POST['nom'];
            $vpayment=$_POST['payment'];
            echo 'Merci pour le pourboire !';
        }
        if($_POST['payment' ===0]){
            echo "Faut Payer !"
        }
        else{
            echo "J'aime quand tu payes!"
        }
        ?>
    </body>
</html>