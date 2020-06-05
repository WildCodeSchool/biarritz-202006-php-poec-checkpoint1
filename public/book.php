<?php

require_once '../connec.php.dist';

try{
    $pdo = new PDO(DSN, USER, PASS);
} catch (Exception $e) {
    echo "No access to database !<br> " .  PHP_EOL . $e->getMessage();
    die();
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['name'])) {
        $error = "Please, enter a name <br>" . PHP_EOL;
    } elseif (strtolower($_POST['name']) === "eliott ness") {
        $error = "This man is untouchable";
    }
    if (empty($_POST['payment']) || $_POST['payment'] <= 0) {
        $error .= "Please, enter a valid payment (at least 1) <br>" . PHP_EOL;
    }

    if ($error === "") {
        try {
            $queryInsert = "INSERT INTO bribe (name, payment) VALUES (:name, :payment)";

            $stm = $pdo->prepare($queryInsert);

            $stm->bindValue(':name', ucfirst($_POST['name']), PDO::PARAM_STR);
            $stm->bindValue(':payment', $_POST['payment'], PDO::PARAM_INT);

            $stm->execute();

            if (isset($_GET['letter'])) {
                header("Location:book.php?letter=" . $_GET['letter']);
            } else {
                header("Location:book.php");
            }
        } catch ( Exception $e ) {
            $error .= "Cannot insert data ! <br> " .  PHP_EOL;
            $debug .= $e->getMessage( ) . "<br> " .  PHP_EOL;
        }
    }
}

if (isset($_GET['letter'])) {
    try {
        $query = "SELECT * FROM bribe WHERE name LIKE '" . $_GET['letter'] . "%' ORDER BY name";
        $stm = $pdo->query($query);
        $bribes = $stm->fetchAll(PDO::FETCH_ASSOC);
    } catch( Exception $e) {
        $error .= "No payment found !  <br> " .  PHP_EOL;
        $debug .= $e->getMessage() . "<br> " .  PHP_EOL;
    }
} else {
    try {
        $query = "SELECT * FROM bribe ORDER BY name";
        $stm = $pdo->query($query);
        $bribes = $stm->fetchAll(PDO::FETCH_ASSOC);
    } catch( Exception $e) {
        $error .= "No payment found !  <br> " .  PHP_EOL;
        $debug .= $e->getMessage() . "<br> " .  PHP_EOL;
    }
}

?>
<!doctype html>
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

    <div class="topnav">
        <?php
            foreach (range("A", "Z") as $letter)
            echo "<a href='./book.php?letter=$letter'>$letter</a>"
        ?>
    </div>

    <section class="desktop">
        <img src="image/whisky.png" alt="a whisky glass" class="whisky"/>
        <img src="image/empty_whisky.png" alt="an empty whisky glass" class="empty-whisky"/>

        <div class="pages">
            <div class="page leftpage">
                Add a bribe
                <form action="" method="post">
                    <span><?php echo $error ?></span>
                    <div>
                        <label for="name">Name</label>
                        <br>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div>
                        <label for="payment">Payment</label>
                        <br>
                        <input type="number" id="payment" name="payment" required>
                    </div>
                    <div>
                        <button type="submit" id="submit">Pay !</button>
                    </div>
                </form>
            </div>
            <div class="page rightpage">
                <?php
                    if (isset($_GET['letter'])) {
                        echo "<div class='centerLetter'>" . $_GET['letter'] . "</div> <hr>";
                    }
                ?>
                <table width="100%">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Payment</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $total = 0;
                        foreach ($bribes as $bribe) {
                            $total += $bribe['payment'];
                            echo "<tr>
                                    <td>" . $bribe['name'] . "</td>
                                    <td>" . $bribe['payment'] . "</td>
                                    </tr>";
                        }
                        echo "<tfoot>
                                <tr>
                                    <td>Total :</td>
                                    <td>$total</td>
                                </tr>
                                </tfoot>";
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
        <img src="image/inkpen.png" alt="an ink pen" class="inkpen"/>
    </section>
</main>
</body>
</html>
