<?php
  require_once 'connec.php';

  $pdo = new \PDO(DSN, USER, PASS);

  $request = "SELECT * FROM bribe ORDER BY name";
  $statement = $pdo -> query($request);
  $bribes = $statement -> fetchall (PDO::FETCH_ASSOC);

$nameErr = $paymentErr = "";

if ($SERVER['REQUEST_METHOD'] == 'POST')
{
    if (empty($_POST['name']))
    {
        $nameErr = "Name is required !";
        echo $nameErr;
    }

    if (empty($_POST['payment']))
    {
        $paymentErr = "Payment amount is required !";
        echo $paymentErr;
    }

    if ($_POST['payment'] <= 0)
    {
        $paymentErr = "Négative amount is not an option !";
        echo $paymentErr;
    }

    if ($nameErr = $paymentErr === "")
    {
        $name = $_POST['name'];
        $payment = $_POST['payment'];

        $queryInsert = "INSERT INTO bribe (name, payment) VALUES (:name, :payment)";

        $statement = $pdo -> prepare($queryInsert);
        $statement -> bindValue (':name', $name, PDO::PARAM_STR);
        $statement -> bindValue (':payment', $payment, PDO::PARAM_INT);
        $statement -> execute ();

        header('location: book.php');
        exit;
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

    <section class="desktop">
        <img src="image/whisky.png" alt="a whisky glass" class="whisky"/>
        <img src="image/empty_whisky.png" alt="an empty whisky glass" class="empty-whisky"/>

        <div class="pages">
            <div class="page leftpage">
                <h2> Add a bribe </h2>
                <form action="book.php" method="post">
                    <div>
                        <label for="name"> Name: </label><br/>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div>
                        <label for="payment"> Payment: </label><br/>
                        <input type="number" id="payment" name="payment" required>
                    </div>
                    <div>
                        <button type="submit" id="submit" name="add payment"> Add Payment </button>
                    </div>
                </form>
            </div>
            <div class="page rightpage">
                <?php
                  echo "<table>
                    <thead>
                      <tr>
                        <th> Name </th>
                        <th> Payment </th>
                      </tr>
                    </thead>
                    <tbody>";
                    $totalBribes = 0;
                    foreach ($bribes as $bribe)
                    {
                      echo "<tr>
                              <td>" . $bribe['name'] . "</td>
                              <td>" . $bribe['payment'] . "</td>
                            </tr>
                    </tbody>" . PHP_EOL;
                    $totalBribes += $bribe['payment'];
                    }
                    echo "<tfoot>
                            <th> Total Bribes: </th>
                            <td>" . $totalBribes . "</td>
                          </tfoot>
                    </table>" . PHP_EOL;
                  ?>
            </div>
        </div>
        <img src="image/inkpen.png" alt="an ink pen" class="inkpen"/>
    </section>
</main>
</body>
</html>
