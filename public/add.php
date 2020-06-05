<?php


if (isset($_POST['book.php'])) {

    try {
        $name = $_POST['name'];
        $payment = $_POST['payment'];
        $queryInsert = "INSERT INTO bribe (name , payment) VALUES (:name,  :payment)";

        $stm = $pdo->prepare($queryInsert);

        $stm->bindValue(':name', $name, PDO::PARAM_STR);
        $stm->bindValue(':payment', $payment, PDO::PARAM_INT);

        $stm->execute();
    } catch (Exception $e) {
        $error .= "Cannot insert data ! <br> " . PHP_EOL;
        $debug .= $e->getMessage() . "<br> " . PHP_EOL;
    }
}