<?php

require_once ('../connec.php');

$pdo = new \PDO(DSN, USER, PASS);

$query = "SELECT * FROM bribe";
$statement = $pdo->query($query);
$persons = $statement->fetchAll();

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/book.css">

    <style>
        .secret-book {
            display: flex;
            flex-direction: row;
        } 
        .rightpage {
            font-size: 28px;
        }
        .leftpage {
            font-size: 28px;
        }
        .box-flex {
                height: 100px;
                width: 200px;
            }
            .box-flex-center {
                flex-grow: 1;
            }
            img.pen-img {
                height: 300%;            
            }
            .glass{
                margin-left: 20px;
            }
            .pen{
                margin-top:170px;
            }
        
        @media screen and (width > 1200px) {
            .box-flex {
                height: 100px;
                width: 200px;
            }
            .box-flex-center {
                flex-grow: 1;
            }
            img.pen-img {
                height: 300%;            
            }
            .glass{
                margin-left: 20px;
            }
            .pen{
                margin-top:170px;
            }
        }
        @media screen and (min-width: 1100px) and (max-width: 1200px) {
            .pen {
                display:none;
            }
        }

        @media screen and (min-width: 1000px) and (max-width: 1100px) {
            .pen {
                display:none;
            }
        }

        @media screen and (min-width: 800px) and (max-width: 1000px) {
            .pen {
                display:none;
            }
            .glass {
                display:none;
            }            
        }
        @media screen and (min-width: 320px) and (max-width: 800px) {
            .pen {
                display:none;
            }
            .glass {
                display:none;
            }            
        }
    </style>

    <title>Checkpoint PHP 1</title>
</head>
<body>

<?php include 'header.php'; ?>

<main class="container">

    <section class="desktop">
        <div class="secret-book">
            <div class="box-flex glass">
                <!--<img class="glass"src="image/whisky.png" height="200px" width="200px" alt="a whisky glass" class="whisky"/>-->
                <!--<img src="image/empty_whisky.png" alt="an empty whisky glass" class="empty-whisky"/>-->
                <picture>
                    <source srcset="image/whisky.png"
                        media="(min-width: 1000px) and (max-width: 1100px)">
                    <img src="image/empty_whisky.png" />
                </picture>
            </div>
            <div class="box-flex-center">
                <div class="pages">
                    <div class="page leftpage">
                        Add a bribe
                        <!-- TODO : Form -->
                        <form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  method="post">
                            <div>
                                <label  for="namePerson">Nom :</label>
                                <input  type="text"  id="namePerson"  name="namePerson" required>                                    
                            </div>
                            <div>
                                <label  for="payment">Paiement :</label>
                                <input  type="payment"  id="payment"  name="payment" required>
                            </div>                        
                            <div >
                                <button  type="submit" id="submit" name="submit">Envoyer</button>
                            </div>
                        </form>
                        <?php      
                        if(isset($_POST['namePerson'])) { 
                            if ($_POST['payment'] <= 0){
                                $error = '';

                            }    
                            $namePerson = trim($_POST['namePerson']);
                            $payment = $_POST['payment'];
                                                    
                            $query = "INSERT INTO bribe (name, payment) VALUES (:name, :payment)";
                            $stm = $pdo->prepare($query);
                        
                            $stm->bindValue(':name', $namePerson, \PDO::PARAM_STR);
                            $stm->bindValue(':payment', $payment, \PDO::PARAM_INT);
                        
                            $stm->execute();

                            $_POST['namePerson'] = '';
                            $_POST['payment'] = '';

                            //redirect
                            header('location: book.php');
                        }
                        ?>
                    </div>
                    <div class="page rightpage">
                        <!-- TODO : Display bribes and total paiement -->
                        <?php $total = 0; ?>
                        <table>
                            <tbody>
                                <?php foreach($persons as $person) { ?>
                                    <tr>
                                        <td><?php echo $person['name']; ?></td>                                    
                                        <td><?php echo $person['payment']; ?></td>
                                    </tr>
                                    <?php $total += $person['payment']; ?>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>Total</td>                                 
                                    <td><?php echo $total; ?></td>
                                </tr>
                            </tfoot>                        
                        </table>
                    </div>
                </div>
            </div>
            <div class="box-flex pen">
                <img class="pen-img" src="image/inkpen.png" alt="an ink pen" class="inkpen"/>
            </div>
        </div>
    </section>
</main>
</body>
</html>
