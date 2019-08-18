<?php
require_once '../model/DAO.php';

class Controller{

    public function showIndex(){
        session_start();
        include 'index.php';
        // header('Location:index.php');
    }

    public function showInsert(){

        include 'insertarticle.php';
    }
 
    public function insertArticle(){
        $brand=isset($_POST['brand'])?$_POST['brand']:"";
        $model=isset($_POST['model'])?$_POST['model']:"";
        $description=isset($_POST['description'])?$_POST['description']:"";
        $specifications = isset($_POST['specifications']) ? $_POST['specifications'] : "";
        $price=isset($_POST['price'])?$_POST['price']:"";
        // $upload_image=isset($_POST['upload_image'])?$_POST['upload_image']:"";
  
        $errors=array();

        if(empty($brand)){
           $errors['brand']= "Please enter the brand";
        }
        if(empty($model)){
            $errors['model']= "Please enter the model";
        }
        if(empty($description)){
            $errors['description']= "Please enter a description";
        }
        if(empty($specifications)){
            $errors['specifications']= "Please enter a specifications";
        }
        if(empty($price)){
            $errors['price']="Please enter a price";
        }else{
            if(is_numeric($price)){
                if($price<0){
                    $errors['price']= "The price must be higher than zero";
                }
            }else{
                $errors['price']= "The price must be a numeric value";
            }
        }
        
        $uploaddir ='C:/xampp/htdocs/webshop/images/';
    
    if(isset($_FILES['upload_image']['name'])){ //Mora da se postavi uslov zbog toga sto se prilikom postavljanja forme ne ucitava odmah slika 
    //  var_dump($_FILES);
        $uploadfile = $uploaddir . basename($_FILES['upload_image']['name']);
        $upload_image = strtolower(pathinfo($uploadfile,PATHINFO_EXTENSION));
 
       if(isset($uploadfile)){
         $check = getimagesize($_FILES["upload_image"]['tmp_name']);

            if($check !== false){ 
                echo "File is an image - " . $check["mime"] . ".";            
            }else{
              $errors['upload_image']= "This file is not an image.";
            }
       } 
        if (file_exists($uploadfile)) {  
        $errors['upload_image'] = "The selected file already exists." ;
        }
        if ($_FILES['upload_image']["size"] > 1000000) { 
        $errors['upload_img']= "The max. image size is 1.5 MB";
        }    
    }
        if(count($errors)==0){
            if (isset($uploadfile)) {
                    if ($upload_image != 'jpg' && $upload_image != 'png' && $upload_image != 'jpeg' && $upload_image != 'gif') {

                        $errors['upload_image'] = "The picture must be format .jpg,.jpeg,.png,.gif";
                    }

                    if (move_uploaded_file($_FILES["upload_image"]['tmp_name'], $uploadfile)) {

                        echo "The file ". basename($_FILES['upload_image']['name']) . " has been uploaded.";
                    } else {
                        $errors['upload_image'] = "Sorry, there was an error uploading your file.";
                    }
            }
            if (isset($_FILES['upload_image']['name'])) {
                $image = (array_column($_FILES, 'name'));
            }
            $dao= new DAO();
            $dao->insertArticle($brand,$model,$description,$specifications,$price,$image[0]);
            // $msg= "Successful data entry";
            header( 'Location:index.php?msg=Successful data entry');
            // include 'index.php';
        }else{
            $msg= "Please fill out the form correctly";
            include 'insertarticle.php';
        }

    }//end function insertArticle
    public function addToCart(){

     $idart=isset($_GET['idart'])?$_GET['idart']:"";   
     $dao=new DAO();
     $article=$dao->getArticleById($idart);
    if($article){
            session_start();

        if(!isset($_SESSION['cart'])){
                // $_SESSION['cart'] = array();
                $_SESSION['cart'][] = $article;
                $msg = "Article added to cart";
                include 'index.php'; 
        }else{
            //  foreach ($_SESSION['cart'] as $key => $id) {
            //    $id_art = $id['idart'];
            //   }
            if(in_array($idart,array_column($_SESSION['cart'],'idart'))){ 
            // if($id_art==$idart){
                // header( 'Location:cart.php?msg=Article has already been selected, please set  quantity and refresh cart'); 
                $msg= "Article has already been selected";
                include 'index.php';
            }else{
                
                // $_SESSION['cart']=array();
               $_SESSION['cart'][] = $article; //ako je vec setovana sesija cart odnosno vec postoji artikal u korpi postavi novi artikal u korpu
               $msg = "New article has been added to cart";
                 include 'index.php';    
            }        
        }     
           //startovanje sesije i pakovanje artikala u sesiju.
        //   session_start(); //otvaramo sesiju i dodeljujemo joj vrednost $_SESSION['cart'][]=$article; [] je zbog niza nizova u verodnosti $article;+  
     //session_destroy();           
    }else{
        echo"Error with id article";
        include 'index.php';
       }
     
    }//end addToCart
    public function emptyCart(){
        session_start();
        //upit da li je korpa prazna izmeniti 
        if(!empty($_SESSION['cart'])){
            // session_unset();
            unset($_SESSION['cart']); //unistavamo samo jednu sesiju a ostale nastavljaju sa radom
            // session_destroy();
            // $msg = "Your cart it is empty";
            header( 'Location:cart.php?msg=Your cart it is empty'); //slanje msg preko header location ide na ovaj nacin 
            

            // include 'cart.php';
        }else{  
         include 'index.php';
     }   
        
    }
    public function showCart(){
        include 'cart.php';
    }
    public function removeArticle(){
        $idart=isset($_GET['idart'])?$_GET['idart']:"";
        session_start();
        // var_dump($idart);
        // echo"<br>";
        // var_dump($_SESSION['cart']);
        if(!empty($_SESSION['cart'])){
          foreach($_SESSION['cart'] as $item =>$it){ //posto je korpa niz nizova moramo u foreach petlju ubacimo kljuc i vrednost kako bi rastavili korpu na pojedinacne nizove tj proizvode i kako bi nasli gde se id proizvoda iz korpe slaze  sa brojem id koji je stigao ovde
            //   var_dump($it);
            //   echo"<br>";
            //   var_dump($_SESSION['cart']);
        //    var_dump($item);
        //    echo"<br>";
            if($it['idart']==$idart){
            //brisanje iz sesije korpa samo jednog proizvoda
              unset($_SESSION['cart'][$item]);
            //   $msg= "You've deleted one item";
            header('Location:cart.php?msg=You deleted one item'); //slanje msg preko header location ide na ovaj nacin
                    
             //header location vraca na cart.php i ne vidi session_start gore na ovoj  funkciji  nego vidi session_start u okviru  funkcije addToCart i ne koristi se npr includecart.php;
                // include 'cart.php';
            } //uraditi praznjenje korpe sessije
          }
        }
    }
    public function refreshCart(){

     $idarticle=isset($_GET['idart'])?$_GET['idart']:array();
     $amount=isset($_GET['amount'])?$_GET['amount']:array();

     session_start();

     $total=array();//kreiranje prznog niza za sumu cena 
     $i=0;// brojac u nizu suma krenuo od prvog elementa
     foreach($idarticle as $idart){

        $dao= new DAO();
        $article=$dao->getArticleById($idart);
        $sum=$article['price']*$amount[$i]; //od jednog artikla kojeg je pronasla petlja uzimamo cenu imnozimo sa kolicinom i dobijamo ukupnu cenu za taj jedan artikal
        $total[]=$sum;
        $i++;
     }
        $_SESSION['total']=$total;
        $_SESSION['amount']=$amount;
        header('Location:cart.php');   
                  
    }public function showOrder(){
        session_start();
      if(!empty($_SESSION['user'])){
          header('Location:checkout.php');
      }else{
        include 'login.php';
        }
    }
     public function login(){

     $username=isset($_POST['username'])?$_POST['username']:"";
     $password=isset( $_POST['password'])?$_POST['password']:"";

     if(!empty($username) && !empty($password)){
         $dao= new DAO();
         $user=$dao->login($username,$password);
         if($user){
         //uvek kada koristimo sesiju prvo treba da je startujemo
         session_start();
         $_SESSION['user']=$user;
         include 'checkout.php'; //ovo mora da se promeni kad se vrsi logovanje sa index strane da se vrati na index stranu

         }else{
             $msg= "Incorrect username or password";
             include 'login.php';
         }

     }else{
       $msg= "You must enter username and password";
       include 'login.php';
     }

 }
 public function showRegister(){
     $register=1;
     include 'login.php';
//   include 'register.php';

 }
 public function registration(){
   $name=isset($_POST['name'])?$_POST['name']:"";
   $surname=isset($_POST['surname'])?$_POST['surname']:"";
   $email=isset($_POST['email'])?$_POST['email']:"";
   $adress=isset($_POST['adress'])?$_POST['adress']:"";
   $phone=isset($_POST['phone'])?$_POST['phone']:"";
   $username=isset($_POST['username'])?$_POST['username']:"";
   $password=isset($_POST['password'])?$_POST['password']:"";
   $confirmpassword=isset($_POST['confirmpassword'])?$_POST['confirmpassword']:"";

   $errors=array();

   if(empty($name)){
       $errors['name']= "You need to enter a tname";
   }
   if(empty($surname)){
       $errors['surname']= "You need to enter a surname";
   }
   if(empty($email)){
       $errors['email']= "You need to enter a email";

   }else{

     if(filter_var($email, FILTER_VALIDATE_EMAIL)==false){
         $errors['email']= "You need to enter a valid email";
     }else{
         $dao=new DAO();
         $mail=$dao->getAllUsers();
         foreach($mail as $m){
             if($m['email']==$email){
              $errors['email']= "This email already exists, please enter another email";
             }
         }
     }
   }
   if(empty($adress)){
       $errors['adress']= "You need to enter a adress";
   }
   if(empty($phone)){
       $errors['phone']= "You need to enter a phone";
   }
   if(empty($username)){
      
       $errors['username']="You need to enter username";
   }else{
       $dao=new DAO();
       $usernm=$dao->getAllUsers();
       foreach($usernm as $us){
        
         if($us['username']==$username){
           $errors['username']= "This username already exists, please enter another username";
         }
       }
   }
   if(empty($password)){
       $errors['password']="You need to enter password";
   }
   if(empty($confirmpassword)){

       $errors['confirmpassword']= "You need to confirm the password";

   }else{ 
       if ($password !== $confirmpassword){

                $errors['confirmpassword'] = "Password fields do not match";
            }
        }
   if(count($errors)==0){
       $dao=new DAO();
       $admin=0;
       $dao->register($name,$surname,$email,$adress,$phone,$username,$password,$admin);
       $msg= "You have successfully registered, please log in";
       include 'login.php';
   }else{

      $msg= "You need to enter the data correctly in the form ";
      $register=1;
      include 'login.php';
   }

 }
 public function logout(){
     session_start();
     unset($_SESSION['user']);
    //  session_destroy();
     header('Location:login.php');
    
 }
public function login_1(){

     $username=isset($_POST['username'])?$_POST['username']:"";
     $password=isset( $_POST['password'])?$_POST['password']:"";

     if(!empty($username) && !empty($password)){
         $dao= new DAO();
         $user=$dao->login($username,$password);
         if($user){
         //uvek kada koristimo sesiju prvo treba da je startujemo
         session_start();
         $_SESSION['user']=$user;
         include 'index.php'; //ovo mora da se promeni kad se vrsi logovanje sa index strane da se vrati na index stranu

         }else{
             $msg= "Incorrect username or password";
             include 'login_1.php';
         }

     }else{
       $msg= "You must enter username and password";
       include 'login_1.php';
     }
}
public function showRegister_1(){
     $register=1;
     include 'login_1.php';
//   include 'register.php';
}
public function registration_1(){
   $name=isset($_POST['name'])?$_POST['name']:"";
   $surname=isset($_POST['surname'])?$_POST['surname']:"";
   $email=isset($_POST['email'])?$_POST['email']:"";
   $adress=isset($_POST['adress'])?$_POST['adress']:"";
   $phone=isset($_POST['phone'])?$_POST['phone']:"";
   $username=isset($_POST['username'])?$_POST['username']:"";
   $password=isset($_POST['password'])?$_POST['password']:"";
   $confirmpassword=isset($_POST['confirmpassword'])?$_POST['confirmpassword']:"";

   $errors=array();

   if(empty($name)){
       $errors['name']= "You need to enter a tname";
   }
   if(empty($surname)){
       $errors['surname']= "You need to enter a surname";
   }
   if(empty($email)){
       $errors['email']= "You need to enter a email";

   }else{

     if(filter_var($email, FILTER_VALIDATE_EMAIL)==false){
         $errors['email']= "You need to enter a valid email";
     }else{
         $dao=new DAO();
         $mail=$dao->getAllUsers();
         foreach($mail as $m){
             if($m['email']==$email){
              $errors['email']= "This email already exists, please enter another email";
             }
         }
     }
   }
   if(empty($adress)){
       $errors['adress']= "You need to enter a adress";
   }
   if(empty($phone)){
       $errors['phone']= "You need to enter a phone";
   }
   if(empty($username)){
      
       $errors['username']="You need to enter username";
   }else{
       $dao=new DAO();
       $usernm=$dao->getAllUsers();
       foreach($usernm as $us){
        
         if($us['username']==$username){
           $errors['username']= "This username already exists, please enter another username";
         }
       }
   }
   if(empty($password)){
       $errors['password']="You need to enter password";
   }
   if(empty($confirmpassword)){

       $errors['confirmpassword']= "You need to confirm the password";

   }else{ 
       if ($password !== $confirmpassword){

                $errors['confirmpassword'] = "Password fields do not match";
            }
        }
   if(count($errors)==0){
       $dao=new DAO();
       $admin=0;
       $dao->register($name,$surname,$email,$adress,$phone,$username,$password,$admin);
       $msg= "You have successfully registered, please log in";
       include 'login_1.php';
   }else{

      $msg= "You need to enter the data correctly in the form ";
      $register=1;
      include 'login_1.php';
   }

 }
 public function doOrder(){
     
   $name=isset($_POST['name'])?$_POST['name']:"";
   $surname=isset($_POST['surname'])?$_POST['surname']:"";
   $email=isset($_POST['email'])?$_POST['email']:"";
   $adress=isset($_POST['adress'])?$_POST['adress']:"";
   $phone=isset($_POST['phone'])?$_POST['phone']:"";
   $id_user=isset($_POST['user_id'])?$_POST['user_id']:""; 

    session_start(); 
    $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
    $total = isset($_SESSION['total']) ? $_SESSION['total'] : array();
    $amount = isset($_SESSION['amount']) ? $_SESSION['amount'] : array();

   $errors=array();
   if(empty($name)){
       $errors['name']="Please enter your name";
   }
   if(empty($surname)){
       $errors['surname']="Please enter your surname";
   }
   if(empty($email)){
       $errors['email']="Please enter your email";
   }
   if(empty($adress)){
       $errors['adress']="Please enter your adress";
   }
   if(empty($phone)){
       $errors['phone']="Please enter your phone";
   }
        
   if(count($errors)==0){
    // $count=$amount;
        
       $dao= new DAO();
       //drugi parametrra je broj porudzbine kreiramo ga ovde
    // $order_number=1;
    $last_number=$dao->getLastOrderNumber();
    // var_dump($last_number);
    if(empty($last_number)){ 
        $order_number = 1;
    }else {
      $order_number=MAX($last_number);
      $order_number++;
     }
    $i=0;
    //funkcija MAX(order_number) oslobadjamo se niza i dobijamo samo jedan string PHP - Fatal error: Unsupported operand types

   //dizajn paterni proguglati 
    foreach($cart as $c){
        $id_art=$c['idart'];
        $brand=$c['brand'];
        $model=$c['model'];
        $price=$c['price'];
        if(!empty($amount)){
          $count=$amount[$i];
        }else{
            $count=1;
        }
        if(!empty($total)){
          $total_sum=$total[$i];
        }else{
            $total_sum=$c['price'];
        }
        
        
        // $count=($_SESSION['amount'])[$i];
        // $total=($_SESSION['total'])[$i];
       $dao->insertOrder($id_user,$order_number,$name,$surname,$email,$phone,$adress,$id_art,$brand,$model,$price,$count,$total_sum);
      
      $i++;             
    }
          unset($_SESSION['cart']); //ako drugi put se vratimo u korpu sa stranice thankyou.php javlja se greska undefined ofsset variable zbog toga je postavljen unset $_SESSION['cart'];
            include 'thankyou.php';   
   }else{
       include 'checkout.php';
   }

 }
 public function showAllOrders(){
     $dao= new DAO();
     $allorders=$dao->getAllOrders();

     include 'allorders.php';
 }
 public function sentOrder(){
//    var_dump('saljemo');
        $dao= new DAO();
        $order_n = isset($_GET['order_number']) ? $_GET['order_number'] : "";
        $allorders = $dao->getAllOrders();
     include 'allorders.php';
 }
 public function cancelOrder(){
  $order_number=isset($_GET['order_number'])?$_GET['order_number']:"";
        // var_dump('otkazano');
    $dao= new DAO();
    $dao->deleteOrder($order_number); 
    $allorders=$dao->getAllOrders(); //ponovo ucitavamo podatke u tabelu 
    $msg="Order deleted";   
    include 'allorders.php';
 }
 public function showDetails(){
  $idart=isset($_GET['idart'])?$_GET['idart']:"";
  $dao= new DAO();
  $all_details=$dao-> getArticleView($idart);
  
  include 'view_details.php';  
 }
public function deleteArticle(){
    $idart=isset($_GET['idart'])?$_GET['idart']:"";
    $dao= new DAO();
    $dao->deleteArticle($idart);
    $msg = "Article deleted"; 
    session_start();
    include 'index.php';
}

} 

?>