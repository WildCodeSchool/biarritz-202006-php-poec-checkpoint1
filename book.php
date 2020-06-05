<?php
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=checkpoint1;charset=utf8', 'root', 'bonjourlinux');
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}

$reponse = $bdd->query('SELECT * FROM bribe ORDER BY name ASC');

$sommesql = $bdd->query('SELECT SUM(payment) FROM bribe');
$sommetotal = $sommesql->fetch();

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

    <section class="desktop">
        <div class="pages">
            <img src="image/whisky.png" alt="a whisky glass" class="whisky glass"/>
            <img src="image/empty_whisky.png" alt="a empty whisky glass" class="empty-whisky glass"/>
            <div class="page leftpage">

                <form method="post" action="verificationform.php">
                    <strong>Payment</strong>
                    <section>

                        <p>
                            <label for="name">
                                <span>Name : </span>
                            </label>
                            <input type="text" id="name" name="name" >
                        </p>
                        <p>
                            <label for="Payment">
                                <span>Payment : </span>
                            </label>
                            <input type="number" id=payment" name="payment" >
                        </p>

                    </section>
                    <section>
                        <p> <button type="submit">Submit</button> </p>
                    </section>
                </form>
            </div>

            <div class="page rightpage">
                <table>
                    <tbody>
                        <?php
                          while ($donnees = $reponse->fetch())
                          {
                          echo "<tr>" . "<td>" . $donnees['name'] . "</td>" . "<td>" .  $donnees['payment'] .'</td>' . "</tr>";
                          }
                        ?>

                    </tbody>
                    <tfoot>
                        <tr>
                            <td>
                                <?php

                                    echo "Total payment :  " . $sommetotal['SUM(payment)'];
                                ?>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <img src="image/inkpen.png" alt="an ink pen" class="inkpen"/>
        </div>

    </section>
</main>
</body>
</html>
