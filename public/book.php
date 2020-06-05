<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/book.css">
    <title>Checkpoint PHP 1</title>
    <?php
                $debug = $error = "";
                require '../connec.php';
                require 'header.php';
                require 'add.php';
    ?>
</head>
<body>



<main class="container">

    <section class="desktop">
        <img src="image/whisky.png" alt="a whisky glass" class="whisky"/>
        <img src="image/empty_whisky.png" alt="an empty whisky glass" class="empty-whisky"/>

        <div class="pages">
            <div class="page leftpage">


                <h1>Compte habileté</h1>
                <form  action=""  method="post">
                    <div>
                        <label  for="name">Name :</label>
                        <input  type="text"  id="name"  name="name" required>
                    </div>

                    <div>
                        <label  for="payment">payment :</label>
                        <input  type="int" id="payment"  name="payment" required></input>
                    </div>
                    <input type="submit">
                </form>
            </div>





            <div class="page rightpage">
               <?php

                $pdo = new \PDO(DSN, USER, PASS);
                //Afficher les erreurs captées par try et catch
                //echo $debug; // only in dev mode for dev
                if (isset($_POST['add.php'])) {
                    if ($error != '') {
                        echo "<div class=\"error\">" . $error . "</div>"; // for user
                    }

                    if (isset($_POST['payment'])) {
                        $payment = trim($_POST['payment']);
                    }

                    $totalCum = "SELECT SUM(payment) FROM bribe;";
                    $pdo->prepare($totalCum);
                    $Total = $totalCum->execute();

                }
                ?>
            </div>
        </div>
    </section>
</main>
</body>
<tfoot>

    <td><?php
        echo  "The total of accountning is reaching $Total €";
        ?>
    </td>
    <img src="image/inkpen.png" alt="an ink pen" class="inkpen"/>
</tfoot>
</html>
