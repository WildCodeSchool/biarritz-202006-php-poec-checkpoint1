<?php
$name = $_POST['name'];
$payment = $_POST['payment'];
echo $name . " " . $payment;
if(empty($name)){
    echo "nom vide <br>";
}
if(empty($payment)){
    echo "Payment vide <br>";
}

?>

<!doctype html>
<html>
    <a href="book.php">Retour</a>
</html>


