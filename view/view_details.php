<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>View article</title>
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
            <a class="nav-link" href="../view/routes.php?page=showindex">Articles<span class="sr-only">(current)</span></a>
        </li>
        <?php  if(empty($_SESSION['user'])){ ?>
        <li class="nav-item">
            <a class="nav-link" href="routes.php?page=showlogin_1">Login<span class="sr-only">(current)</span></a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link" href="routes.php?page=showregister_1">Register<span class="sr-only">(current)</span></a>
        </li>
            <?php } ?>
    </ul>
    <?php $msg = isset($msg) ? $msg : "";  ?> <?php echo "<span class='text-white'>$msg</span>"; ?> &nbsp; <span class="text-white"><a href="routes.php?page=showcart"><i class='fas fa-cart-arrow-down' style="font-size:25px;color:red"></i></a></span>
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
        <input class="btn btn-sm btn-outline-warning" type="submit" name="page" value="Logout">
            <?php } ?>
    </form>
    </div>
</nav>
<div class="container-fluid">
<div class="container mt-5 mb-5 p-4">
   <?php foreach($all_details as $article){ ?>
    <div class="col-8">
        <h1 class="text-info"><?php echo $article['brand']. ' - '. $article['model']; ?></h1>
    </div>
    <div  class="row">
    <div class="col-3">
        <br>
        <img src="../images/<?php echo $article['image'] ?>" width="300" height="260" />
    </div>
    <div class="col-3 text-center">
        <h2 class="text-info"><?php echo $article['model']; ?></h2>
        <br>
        <h4><?php echo $article['description']; ?></h4>
    </div>
    
    <div class="col-3">
        <br><br>
        <h6><?php echo $article['full_description']; ?></h6>
    </div>
    <div class="col-3 text-center">
        <h3 class="text-danger"><?php echo $article['price']; ?> &#8364;</h3>
        <br>
        <a href="routes.php?page=addtocart&idart=<?php echo $article['idart']; ?>"><i class='fas fa-cart-arrow-down' style="font-size:40px;color:green"></i></a>
    </div>
    </div>  
    <?php } ?>
</div>
</div>
</div>
<footer class=" bg-dark fixed-bottom">
<div class="container text-center">
    <p><a class="text-white" href="#">Copyright by PHP DEVLOPERS 2019</a></p>
</div>
</footer>
</body>
</html>