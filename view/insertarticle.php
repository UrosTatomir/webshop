<!DOCTYPE <!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Insert article</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/bootstrap-grid.css">
    <link rel="stylesheet" href="../css/font-awesome.css">
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

<body style="background:linear-gradient(to top,#FFFFF0,white)no-repeat fixed center;">
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
                <!-- <?php if (empty($user)) {  ?>
                            
                <?php } ?> -->
                
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <span class="text-white"><?php
                if (!empty($_SESSION['user'])) {
                    echo "Logged in : " . $_SESSION['user']['name'];
                } ?>&nbsp;&nbsp;</span>

                <input class="btn btn-sm btn-outline-warning my-2 my-sm-0" type="submit" name="page" value="Logout">
            </form>

        </div>
    </nav>
    <div class="container-fluid mt-5 p-4">
        <div class="container mt-5 mb-5 p-4 text-center  text-dark col-6">
            <h4>Insert new articles</h4>
            <?php
            $msg = isset($msg) ? $msg : "";
            $errors = isset($errors) ? $errors : array();
            //provera da li postoji niz sa greskama
            ?>
            <!-- za upload slika mora ici enctype="multipart/form-data" -->
            <form enctype="multipart/form-data" action="routes.php" method="post">
                <div class="form-group">
                    <div class="row">
                       <div class="col">
                        <input type="text" name="brand" placeholder="Brand">
                        <br>
                        <span class="alert-danger">
                            <?php if (array_key_exists('brand', $errors)) {
                                echo $errors['brand'];
                            }
                            ?>
                        </span>
                        </div>
                        <div class="col">
                        <input type="text" name="model" placeholder="Model">
                        <br>
                        <span class="alert-danger">
                            <?php if (array_key_exists('model', $errors)) {
                                echo $errors['model'];
                            }
                            ?>
                        </span>
                        </div>
                </div>
                    <br>
                    <textarea type="text" maxlength="35" name="description" rows="3" cols="68" placeholder="Description"></textarea>
                    <br>
                   
                    <span class="alert-danger">
                        <?php if (array_key_exists('description', $errors)) {
                            echo $errors['description'];
                        }
                        ?>
                    </span>
                    <br>
                    <textarea type="text" name="specifications" rows="5" cols="68" placeholder="Specifications"></textarea>
                    <br>
                    <span class="alert-danger">
                        <?php if (array_key_exists('specifications', $errors)) {
                            echo $errors['specifications'];
                        }
                        ?>
                    </span>
                    <br>
                <div class="row">
                    <div class="col">
                    
                    <input type="number" name="price" placeholder="Price">
                    <br>
                    <span class="alert-danger">
                        <?php if (array_key_exists('price', $errors)) {
                            echo $errors['price'];
                        }
                        ?>
                    </span>
                    </div>
                    <div class="col">
                    <input type="file" name="upload_image">
                    <br>
                    <span class="alert-danger">
                        <?php if (array_key_exists('upload_image', $errors)) {
                            echo $errors['upload_image'];
                        }
                        ?>
                    </span>
                    </div>
                </div>
                    <br><br>
                    <button class="btn btn-success" type="submit" name="page" value="insert article">Insert article</button>
                </div>
                <!--end form-group-->
            </form>

            <?php
            if (!empty($msg)) {
                ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $msg; ?>
                </div>
            <?php } ?>
            <br><br>
            <form action="routes.php" method="get">
                <button class="btn btn-primary" type="submit" name="page" value="showindex">Home</button>
            </form>
        </div>
        <!--end container-->
    </div>
    <!--end container-fluid-->

    <footer class=" bg-dark fixed-bottom">
        <div class="container text-center">

            <p><a class="text-white" href="#">Copyright by PHP DEVLOPERS 2019</a></p>

        </div>
    </footer>
</body>

</html>