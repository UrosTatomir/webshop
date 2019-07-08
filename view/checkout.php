<!DOCTYPE <!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Checkout</title>
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
<body style="background:linear-gradient(to top,#FFFFFF,white) no-repeat fixed center;">
<?php

    session_start();
    $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
    $total = isset($_SESSION['total']) ? $_SESSION['total'] : array();
    $amount = isset($_SESSION['amount']) ? $_SESSION['amount'] : array();
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
                <li class="nav-item active">
                    <a class="nav-link" href="../view/routes.php?page=showindex">Continue shopping<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Sale</a>
                        <a class="dropdown-item" href="#">Discount</a>
                        <a class="dropdown-item" href="#">Newsletter</a>
                    </div>
                </li>
                <?php  if(empty($_SESSION['user'])){ ?>
                <li class="nav-item">
                    <!-- <a class="nav-link" href="routes.php?page=showlogin">Login<span class="sr-only">(current)</span></a> -->
                </li>
                <?php } ?>
                <li class="nav-item">
                    <!-- <a class="nav-link" href="routes.php?page=showregister">Register<span class="sr-only">(current)</span></a> -->
                </li>

            </ul>
            <span class="text-white"><a href="routes.php?page=showcart"><i class='fas fa-cart-arrow-down' style="font-size:25px;color:red"></a></i></span>
            &nbsp; &nbsp;
            <?php if (!empty($_SESSION['cart'])) {
                $counter = count($_SESSION['cart']);
                echo "<span class='badge badge-pill badge-light'>$counter</span>";
            } ?>
            &nbsp; &nbsp;
            <form class="form-inline my-2 my-lg-0">
                <span class="text-white"><?php
                if(!empty($_SESSION['user'])){ //na ovaj nacin resen problem undefind variable
                  echo "User : ". $_SESSION['user']['name'];
                 } ?>&nbsp;&nbsp;</span>
                 <?php if(isset($_SESSION['user'])){ ?>
                <!-- <input class="btn btn-sm btn-outline-warning" type="submit" name="page" value="Logout"> -->
                 <?php } ?>
            </form>
        </div>
</nav>
<div class="container mt-5 mb-5 p-3 text-center">
    <div class="container col-8">
        <h2>Checkout</h2>
        <br>
<form action="routes.php" method="post"> <!--form start-->
            <table class="table table-muted text-center table-sm">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Brand</th>
                        <th>Model</th>
                        <th>Price</th>
                        <th>Total</th>
                        <!-- <th colspan=2>Action</th> -->
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php
                        $i =0;
                        $sumtotal =0;
                        foreach ($cart as $article) {
                            ?>
                            <td><img src="../images/<?php echo $article['image'] ?>" width="90" height="70" /></td>
                            <td><?php echo $article['brand']; ?></td>
                            <td><?php echo $article['model']; ?></td>
                            <td><?php echo $article['price']; ?></td>
                            <td><input type="number" name="amount[]" readonly="readonly" value="<?php
                            if (!empty($amount) && !empty($amount[$i])) { //dodatak da nije prazan $amount[$i] da bi se izbeglo obavestenje undefined offset
                            echo $amount[$i];
                            } else {
                            echo '1';
                            } ?>"></td>
                            <td><?php
                                if (!empty($_SESSION['total']) && !empty($total[$i])) {
                                    // var_dump($total[$i]);

                                    echo $total[$i]; //dodatak @eliminise se upozorenje

                                } else {
                                    echo $article['price'];
                                } ?></td>

                            
                        </tr>
                        <input type="hidden" name="idart[]" value="<?php echo $article['idart']; ?>">
                        <?php
                        if (!empty($_SESSION['total']) && !empty($total[$i])) { //dodatak da nije prazan $amount[$i] da bi se izbeglo obavestenje undefined offset
                            $sumtotal += $total[$i];
                        } else {
                            $sumtotal += $article['price'];
                        }
                        $i++;
                    } ?>
                    <tr>
                        <th colspan="3" scope="row">Total amount of order</th>
                        <th colspan="3" class="text-right"><?php echo $sumtotal . " &#x20ac;"; ?></th>
                    </tr>
                </tbody>
            </table>
            <br>
            
        <?php if (!empty($_GET['msg'])) { //msg preko header location kupimo na ovaj nacin
            $msg = $_GET['msg'];   ?>
            <div class="alert alert-danger col-4" role="alert"><?php echo $msg; ?>
            </div>
        <?php
    } ?>
        
        <!--end row-->
    </div>
    <!--end container col-8-->

<?php 
 $errors=isset($errors)?$errors:array();
?>
<div class="container col-6 mb-5">
 <!-- <form action="routes.php" method="post"> -->
     <input class="form-control" type="text" name="name" value="<?php echo $user['name']; ?>"><br>
     <span class="alert-danger">
    <?php if (array_key_exists('name', $errors)) {
        echo $errors['name'];
    } ?></span>
     <input class="form-control" type="text" name="surname" value="<?php echo $user['surname']; ?>"><br>
     <span class="alert-danger">
    <?php if (array_key_exists('surname', $errors)) {
        echo $errors['surname'];
    } ?> </span>
     <input class="form-control" type="text" name="email" value="<?php echo $user['email']; ?>"><br>
     <span class="alert-danger">
    <?php if (array_key_exists('email', $errors)) {
        echo $errors['email'];
    } ?></span>
     <input class="form-control" type="text" name="phone" value="<?php echo $user['phone']; ?>"><br>
     <span class="alert-danger">
    <?php if (array_key_exists('phone', $errors)) {
        echo $errors['phone'];
    } ?></span>
     <textarea class="form-control" name="adress"><?php echo $user['adress'];?></textarea><br>
     <span class="alert-danger">
    <?php if (array_key_exists('adress', $errors)) {
        echo $errors['adress'];
    } ?></span>
     <input  type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
     <button class="btn btn-success float-right" type="submit" name="page" value="doOrder">Order</button>
 </form>
</div>  
</div><!--end container--> 
<footer class=" bg-dark fixed-bottom">
<div class="container text-center">
<p><a class="text-white" href="#">Copyright by PHP DEVLOPERS 2019</a></p>
</div>
</footer>
</body>

</html>