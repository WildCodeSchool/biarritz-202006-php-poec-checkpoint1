<?php

require_once 'connec.php';

try{
    $pdo = new PDO(DSN, USER, PASS);
} catch (Exception $e) {
    echo "No access to database !<br> " .  PHP_EOL . $e->getMessage();
    die();
}

$name = $payment = "";
$nameErr = $paymentErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['name']) || strlen($_POST['name']) > 45) {
        $nameErr = "Please enter a name up to 45 characters long";
    } else {
        $name = $_POST['name'];
    }
    if (empty($_POST['payment']) || strlen($_POST['name']) > 45){
        $paymentErr = "Please enter just a number";
    } else {
        $payment = $_POST['payment'];
    }

    if ($nameErr . $paymentErr === "") {
        try {
            $queryInsert = "INSERT INTO bribe (name, payment) VALUES (:name, :payment)";

            $stm = $pdo->prepare($queryInsert);

            $stm->bindValue(':name', $name, PDO::PARAM_STR);
            $stm->bindValue(':payment', $payment, PDO::PARAM_INT);

            $stm->execute();

        } catch ( Exception $e ) {
            $error .= "Cannot insert data ! <br> " .  PHP_EOL;
            $debug .= $e->getMessage( ) . "<br> " .  PHP_EOL;
        }
    }
}

try {
    $query = "SELECT * FROM bribe";
    $stm = $pdo->query($query);
    $bribes = $stm->fetchAll(PDO::FETCH_ASSOC);
} catch( Exception $e) {
    $error .= "No bribe found !  <br> " .  PHP_EOL;
    $debug .= $e->getMessage() . "<br> " .  PHP_EOL;
}



?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/book.css">
    <title>Checkpoint PHP 1</title>
</head>
<body>

<?php include 'header.php'; ?>

<main class="container">

    <section class="desktop">
        <img src="image/whisky.png" alt="a whisky glass" class="whisky"/>
        <img src="image/empty_whisky.png" alt="an empty whisky glass" class="empty-whisky"/> 
        <img src="image/empty_whisky.png" alt="an empty whisky glass" class="empty-whisky2"/> 
        <div class="pages">
            <div class="page leftpage">
            <form  action="index.php"  method="post">
        <div>
            <label for="name">name :</label>
            <input type="text"  id="name" name="name" required>
        </div>
        <div>
            <label for="payment">payment :</label>
            <input type="integer" id="payment" name="payment" required>
        </div>
        <div >
            <button type="submit" id="submit" name="add">Submit</button>
        </div>
            </div>

            <div class="page rightpage">
                <table>
                <?php
                        foreach( $bribes as $bribes)
                        {
                            echo "<tr>" . $bribes['name'] . " " . $bribes['payment'] . "</tr>";
                        }
                        echo  "sum($payment). "\n";
                ?>
                </table>
            </div>
        </div>
        <div class="pen">   
        <img src="image/inkpen.png" alt="an ink pen" class="inkpen"/>    
        </div>
    </section>
</main>
</body>
</html>
