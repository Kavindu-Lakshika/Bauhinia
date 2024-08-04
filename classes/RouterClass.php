<?php

class Router
{
    function isLoggedIn() {
        $loggedIn = false;

        session_start();

        if (isset($_SESSION['logged_in'])) {
            $loggedIn = true;
        }

        return $loggedIn;
    }

    function displayLogin() {
        if ($this->isLoggedIn()) {
            header('Location: /home');
            exit();
        } else {
            include 'login.php';
        }
    }

    function displayRegister() {
        if ($this->isLoggedIn()) {
            header('Location: /home');
            exit();
        } else {
            include 'register.php';
        }
    }

    function displayStaffRegister() {
        if ($this->isLoggedIn()) {
            header('Location: /home');
            exit();
        } else {
            include 'staff_reg.php';
        }
    }

    function displayCart() {
        $prodClass = new Products();
        $data = $prodClass->getCartData();
        include 'cart.php';
    }

    function displayOrders() {
        $prodClass = new Products();
        $data = $prodClass->getUserOrders();
        include 'orders.php';
    }

    function displayHome() {
        $prodClass = new Products();

        if ($this->isLoggedIn()) {
            if ($_SESSION['type'] == "Inventory Clerk") {
                $data = $prodClass->allProducts();
                include 'home_ic.php';
            } else if ($_SESSION['type'] == "Customer") {
                $data = $prodClass->allProducts();
                $cats = $prodClass->getCategories();
                include 'home_cus.php';
            } else if ($_SESSION['type'] == "Production Manager") {
                $data = $prodClass->allProducts();
                include 'home_pm.php';
            } else if ($_SESSION['type'] == "Accountant") {
                $data = $prodClass->getIncomeReport();
                include 'home_ac.php';
            }
        } else {
            header('Location: /');
            exit();
        }
    }

    public function displayDailyOrders() {
        $prodClass = new Products();
        $data = $prodClass->getDailyOrders();
        include 'daily_orders.php';
    }

    public function displayCatProd($id) {
        $prodClass = new Products();
        $data = $prodClass->getCategoryProducts($id);
        $cats = $prodClass->getCategories();
        include 'home_cus.php';
    }

    public function displaySingleProd($id) {
        $prodClass = new Products();
        $data = $prodClass->getSingleProd($id);
        include 'product.php';
    }
}