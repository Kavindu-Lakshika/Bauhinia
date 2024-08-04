<?php
require 'classes/AuthClass.php';
require 'classes/RouterClass.php';
require 'classes/ProductsClass.php';

$url = $_SERVER['REQUEST_URI'];
$authClass = new Auth();
$routerClass = new Router();
$prodClass = new Products();

$urlComponents = explode('/', $url);

switch ($urlComponents[1]) {
    case '':
        $routerClass->displayLogin();
        break;
    case 'register':
        $routerClass->displayRegister();
        break;
    case 'staff_reg_view':
        $routerClass->displayStaffRegister();
        break;
    case 'home':
        $routerClass->displayHome();
        break;
    case 'category':
        $routerClass->displayCatProd($urlComponents[2]);
        break;
    case 'product':
        $routerClass->displaySingleProd($urlComponents[2]); 
        break;
    case 'cart':
        $routerClass->displayCart();
        break;
    case 'orders':
        $routerClass->displayOrders();
        break;
    case 'daily_orders':
        $routerClass->displayDailyOrders();
        break;
    case 'login_action':
        $authClass->loginAction();
        break;
    case 'logout':
        $authClass->logoutAction();
        break;
    case 'reg_action':
        $authClass->register();
        break;
    case 'staff_reg_action':
        $authClass->staffRegister();
        break;
    case 'save_product':
        $prodClass->saveProduct();
        break;
    case 'update_product':
        $prodClass->updateProduct();
        break;
    case 'add_to_cart':
        $prodClass->addToCart();
        break;
    case 'place_order':
        $prodClass->placeOrder();
        break;
}