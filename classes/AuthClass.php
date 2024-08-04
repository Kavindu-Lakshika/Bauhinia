<?php
require 'Database.php';

class Auth
{
    public function loginAction()
    {
        // Create a new database object
        $db = new Database();

        // Retrieve the username and password from the POST request
        $em = $_POST['em'];
        $pw = $_POST['pw'];

        // Construct a query to select a user with the matching username and password
        $query = "SELECT * FROM users INNER JOIN user_types ON users.user_type_id = user_types.user_type_id WHERE email='$em' AND pw='$pw'";

        // Execute the query and retrieve the results
        $result = $db->query($query);
        $users = $db->fetchAll($result);

        session_start();

        // If there are any matching users, set session variables and redirect to the home page
        if (count($users) > 0) {
            session_start();
            $_SESSION['logged_in'] = '1';
            $_SESSION['user_id'] = $users[0]['user_id'];
            $_SESSION['name'] = $users[0]['name'];
            $_SESSION['type'] = $users[0]['type'];

            if ($users[0]['type'] == "Customer") {
                $user_id = $users[0]['user_id'];
                $customer = $db->fetchAll($db->query("SELECT * FROM customers WHERE customer_user_id='$user_id'"));

                $_SESSION['address'] = $customer[0]['address'];
                $_SESSION['p1'] = $customer[0]['phone_1'];
                $_SESSION['p2'] = $customer[0]['phone_2'];
            }
            header('Location: /home');
        } else { // If there are no matching users, set an error message in the session and redirect back to the login page
            $_SESSION['error'] = "Incorrect username or password";
            header('Location: /');
        }
        exit;
    }

    public function logoutAction()
    {
        // Destroy the current session
        session_start();
        session_destroy();
        // Redirect the user to the login
        header('Location: /');
        exit;
    }

    public function register() {
        $n = $_POST["n"];
        $em = $_POST["em"];
        $pw = $_POST["pw"];
        $a = $_POST["a"];
        $p1 = $_POST["p1"];
        $p2 = $_POST["p2"];
        $ut = $this->getUserTypeId("Customer");

        $db = new Database();
        session_start();

        $users = $db->fetchAll($db->query("SELECT * FROM users WHERE email='$em'"));

        if (count($users) > 0) {
            $_SESSION['error'] = "Email already exists";
            header('Location: /');
        } else {
            $result = $db->query("INSERT INTO users(name, email, pw, user_type_id) VALUES ('$n', '$em', '$pw', '$ut')");

            if ($result) {
                $user_id = $db->conn->insert_id;

                $result = $db->query("INSERT INTO customers(address, phone_1, phone_2, customer_user_id) VALUES ('$a', '$p1', '$p2', '$user_id')");

                if ($result) {
                    $_SESSION['success'] = "You have successfully registered. Please log in.";
                    header('Location: /');
                    exit();
                } else {
                    echo "Something went wrong while saving customer details, please try again";
                }
            } else {
                echo "Something went wrong, please try again";
            }
        }
    }

    public function staffRegister() {
        $n = $_POST["n"];
        $em = $_POST["em"];
        $pw = $_POST["pw"];
        $role = $_POST["role"];
        $ut = $this->getUserTypeId($role);

        $db = new Database();
        session_start();

        $users = $db->fetchAll($db->query("SELECT * FROM users WHERE email='$em'"));

        if (count($users) > 0) {
            $_SESSION['error'] = "Email already exists";
            header('Location: /');
        } else {
            $result = $db->query("INSERT INTO users(name, email, pw, user_type_id) VALUES ('$n', '$em', '$pw', '$ut')");

            if ($result) {
                $_SESSION['success'] = "You have successfully registered. Please log in.";
                header('Location: /');
                exit();
            } else {
                echo "Something went wrong, please try again";
            }
        }
    }

    public function getUserTypeId($type) {
        $type_id = "";
        $db = new Database();
        $typeResult = $db->query("SELECT user_type_id FROM user_types WHERE type='$type'");
        $typeRow = $db->fetchAll($typeResult);
        return $typeRow[0]['user_type_id'];
    }
}
