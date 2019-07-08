<!DOCTYPE  html>
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
<body style="background:linear-gradient(to top,gray,white) no-repeat fixed center;">
<nav class="navbar fixed-top navbar-expand-lg  navbar-dark bg-dark">
        <a class="navbar-brand" href="../view/routes.php?page=showindex" style="font-family: cursive, sans-serif; font-size:18px; color: #FDE600;">
            COMPUTER WEBSHOP</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <!-- <a class="nav-link" href="../view/routes.php?page=showindex">Continue shopping<span class="sr-only">(current)</span></a> -->
                </li>
                
                <?php  if(empty($_SESSION['user'])){ ?>
                <li class="nav-item">
                    <!-- <a class="nav-link" href="routes.php?page=showlogin">Login<span class="sr-only">(current)</span></a> -->
                </li>
                <?php } ?>
            </ul>
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
</body>
<div class="container mt-5 mb-5 p-5">
    <h3>Thanks for the order</h3>
</div>
 <footer class=" bg-dark fixed-bottom">
        <div class="container text-center">
     <!-- skica za bazu  orders  id.order id_user, name,surname,emil,phone,adress,id.art,count,total,time-->
            <p><a class="text-white" href="#">Copyright by PHP DEVLOPERS 2019</a></p>

        </div>
    </footer>
</body>

</html>