<?php
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=checkpoint1;charset=utf8', 'root', 'bonjourlinux');
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}

$name = $_POST['name'];
$payment = $_POST['payment'];
$error = 0;
if(empty($name)){
    echo "Empty Name <br>";
    $error = 1;
}
if(empty($payment)){
    echo "Empty Payment<br>";
    $error = 1;
}
if($payment < 0){
    echo "Invalid Payment <br>";
    $error = 1;
}
echo $name . " " . $payment . "<br>";
if (error == 0)
    {
        $req = $bdd->prepare('INSERT INTO bribe(name,payment) VALUES (:name ,:payment)');
        $req->execute(array(
            'name' => $name,
            'payment' => $payment
        ));
        echo "Tout est valide, veuillez cliquez sur le bouton retour <br>";
    }
else
    {
        echo "Erreur, veuillez vérifiez votre contenu";
    }

?>

<!doctype html>
<html>
    <a href="book.php">Retour</a>
</html>


