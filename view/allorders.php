<!DOCTYPE <!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>show all orders</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/bootstrap-grid.css">
    <link rel="stylesheet" href="../css/font-awesome.css">
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="main.js"></script>
    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/scripts.js"></script>
</head>
<body style="background-color:#FFFFF0;">
 <?php session_start();
    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
    }
    ?>
<nav class="navbar fixed-top navbar-expand-lg  navbar-dark bg-dark">
        <a class="navbar-brand" href="../view/routes.php?page=showindex" style="font-family: cursive, sans-serif; font-size:18px; color: #FDE600;">
            COMPUTER WEBSHOP</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
         <ul class="navbar-nav mr-auto">
        </ul>   
            <form class="form-inline my-2 my-lg-0">
                <span class="text-white"><?php
                if(!empty($_SESSION['user'])){ //na ovaj nacin resen problem undefind variable
                  echo "User : ". $_SESSION['user']['name'];
                 } ?>&nbsp;&nbsp;</span>
                 <?php if(isset($_SESSION['user'])){ ?>
                <input class="btn btn-sm btn-outline-warning" type="submit" name="page" value="Logout">
                 <?php } ?>
            </form>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="container mt-5 p-5 text-center">
            <div class="container  col-10">
                <?php
                // $allorders = isset($allorders) ? $allorders : array(); kada includujemo niz iz controllera na ovu stranicu nije potrebno setovanje $allorders
                ?>
                <table class="table table-muted text-center table-sm">
                <thead class="bg-dark text-white">
                    <tr>
                        <th>order number</th>
                        <th>Name</th>
                        <th>Surname</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Adress</th>
                        <th>Brand</th>
                        <th>Model</th>
                        <th>Price</th>
                        <th>Count</th>
                        <th>Total</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
            <!-- obojiti sent kolonu-->
            <?php $order_n=isset($order_n)?$order_n:"";
                  $allorders=isset($allorders)?$allorders:array(); ?>
                    <?php foreach ($allorders as $pom){ 
                       if($pom['order_number'] == $order_n){         
                        ?>
                        <tr class="bg-success">
                     <?php }else{ ?>
                    <tr>
                     <?php } ?>
                        <td><?php echo $pom['order_number']; ?></td>
                        <td><?php echo $pom['name']; ?></td>
                        <td><?php echo $pom['surname']; ?></td>
                        <td><?php echo $pom['email']; ?></td>
                        <td><?php echo $pom['phone']; ?></td>
                        <td><?php echo $pom['adress']; ?></td>
                        <td><?php echo $pom['brand']; ?></td>
                        <td><?php echo $pom['model']; ?></td>
                        <td><?php echo $pom['price']; ?></td>
                        <td><?php echo $pom['count']; ?></td>
                        <td><?php echo $pom['total']; ?></td>
                        
                        <td><a href="routes.php?page=sent&order_number=<?php echo $pom['order_number']; ?>">Sent</td>
                        <td><a href="routes.php?page=cancel&order_number=<?php echo $pom['order_number']; ?>">Cancel</td>
                    </tr>
                    <?php } ?>
                    <?php  $msg=isset($msg)?$msg:"";
                       echo'<h5>'. $msg.'<h5>';
                    ?>
            </div>
            </table>
        </div>
    </div>
    <footer class=" bg-dark fixed-bottom">
    <div class="container text-center">
        <p><a class="text-white" href="#">Copyright by PHP DEVLOPERS 2019</a></p>
    </div>
    </footer>
</body>

</html>