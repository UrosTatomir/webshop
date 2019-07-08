<?php
require_once '../controllers/Controller.php';

$controller= new Controller();

$page=isset($_GET['page'])?$_GET['page']:"";

switch($page){

case 'showinsert':
$controller->showInsert();
break;

case 'addtocart':
$controller->addToCart();
break;

case 'emptycart';
$controller->emptyCart();
break;

case 'showcart':
$controller->showCart();
break;

case 'showindex':
$controller->showIndex();
break;

case 'removearticle':
$controller->removeArticle();
break;

case 'Refresh cart':
$controller->refreshCart();
break;

case 'showregister':
$controller->showRegister();
 break;

case 'showregister_1':
$controller->showRegister_1();
 break;

case 'showlogin':
$controller->login();
break;

case 'showlogin_1':
$controller->login_1();
break;

case 'Logout':
$controller->logout();
break;

case 'showallorders':
$controller->showAllOrders();
break;

case 'sent':
$controller->sentOrder();
break;

case 'cancel':
$controller->cancelOrder();
break;

case 'details':
$controller->showDetails();
break;

case 'delete':
$controller->deleteArticle();
break;
}

if($_SERVER['REQUEST_METHOD']=='POST'){
    $page=isset($_POST['page'])?$_POST['page']:"";

    switch($page){
        case 'showorder':
        $controller->showOrder();
        break;

      case 'Log in':
      $controller->login();
      break;

      case 'Register':
      $controller->registration();
      break;

      case 'login':
      $controller->login_1();
      break;

      case 'register':
      $controller->registration_1();
      break;

      case 'Order':
      $controller->order();
      break;

      case 'doOrder':
      $controller->doOrder();
      break;

      case 'insert article':
      $controller->insertArticle();
      break;
    }

    

     
}


?>