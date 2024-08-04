<?php


class Products
{
    public function saveProduct()
    {
        $n = $_POST["n"];
        $p = $_POST["p"];
        $c = $_POST["c"];
        $i = $_FILES["i"];
        $ca = $_POST["ca"];

        $db = new Database();
        session_start();

        $cid = $this->getCategoryId($db, $ca);
        $upload_data = json_decode($this->uploadImage($i));

        if ($upload_data->moved) {
            $imageName = $upload_data->name;

            $result = $db->query("INSERT INTO product (name, price, count, image, category_id) VALUES ('$n', '$p', '$c', '$imageName', '$cid')");
            if ($result) {
                $_SESSION['success'] = "Product successfully saved!";
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit;
            } else {
                echo "Error saving product. Please try again.";
            }
        } else {
            echo "Error uploading image. Please try again.";
        }
    }

    public function getCategoryId($db, $category)
    {
        $cat_id = "";

        $catResult = $db->query("SELECT category_id FROM category WHERE category='$category'");
        $catRow = $db->fetchAll($catResult);
        if (count($catRow) <= 0) {
            $db->query("INSERT INTO category (category) VALUES ('$category')");
            $catResult = $db->query("SELECT category_id FROM category WHERE category='$category'");
            $catRow = $db->fetchAll($catResult);
        }

        return $catRow[0]['category_id'];
    }

    public function uploadImage($i)
    {
        $now = new DateTime('now');
        $result = $now->format('YmdHis');

        $imageName = $result . '.' . pathinfo($i['name'], PATHINFO_EXTENSION);
        $imagePath = './product_images/' . $imageName;

        if (!is_dir('./product_images')) {
            mkdir('./product_images');
        }

        $files_moved = move_uploaded_file($i['tmp_name'], $imagePath);

        $data = array(
            "moved" => $files_moved,
            "name" => $imageName,
        );

        return json_encode($data);
    }

    public function allProducts()
    {
        $db = new Database();
        $result = $db->query("SELECT * FROM product p INNER JOIN category c on p.category_id = c.category_id");
        $data = array();

        if ($result) {
            $data = $db->fetchAll($result);
        } else {
            echo "Error";
        }

        return $data;
    }

    public function updateProduct()
    {
        $id = $_POST["id"];
        $n = $_POST["nu"];
        $p = $_POST["pu"];
        $c = $_POST["cu"];
        $ca = $_POST["cau"];

        $db = new Database();
        session_start();
        $cid = $this->getCategoryId($db, $ca);
        $query = '';
        $result = array();

        if (!($_FILES['iu']['error'] === UPLOAD_ERR_NO_FILE)) {
            $i = $_FILES["iu"];
            $upload_data = json_decode($this->uploadImage($i));

            if ($upload_data->moved) {
                $imageName = $upload_data->name;
                $query = "UPDATE product SET name='$n', price='$p', image='$imageName', count='$c', category_id='$cid' WHERE product_id='$id'";
            } else {
                echo "Error uploading image. Please try again.";
            }
        } else {
            $query = "UPDATE product SET name='$n', price='$p', count='$c', category_id='$cid' WHERE product_id='$id'";
        }

        $result = $db->query($query);
        if ($result) {
            $_SESSION['success'] = "Product successfully updated!";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        } else {
            echo "Error saving product. Please try again.";
        }
    }

    public function getCategories()
    {
        $db = new Database();
        $result = $db->query("SELECT * FROM category");
        return $db->fetchAll($result);
    }

    public function getCategoryProducts($id)
    {
        $db = new Database();
        $result = $db->query("SELECT * FROM product p INNER JOIN category c on p.category_id = c.category_id WHERE p.category_id='$id'");
        $data = array();

        if ($result) {
            $data = $db->fetchAll($result);
        } else {
            echo "Error";
        }

        return $data;
    }

    public function getSingleProd($id)
    {
        $db = new Database();
        $result = $db->query("SELECT * FROM product p INNER JOIN category c on p.category_id = c.category_id WHERE p.product_id='$id'");
        $data = array();

        if ($result) {
            $data = $db->fetchAll($result)[0];
        } else {
            echo "Error";
        }

        return $data;
    }

    public function addToCart()
    {
        session_start();
        $user_id = $_SESSION["user_id"];
        $pid = $_POST["pid"];
        $c = $_POST["c"];
        $cart_id = '';

        $db = new Database();
        $db->query("SET FOREIGN_KEY_CHECKS=0");
        $result = $db->query("SELECT cart_id FROM cart WHERE customer_id='$user_id'");

        $cart = $db->fetchAll($result);

        if (count($cart) > 0) {
            $cart_id = $cart[0]["cart_id"];
        } else {
            $result = $db->query("INSERT INTO cart(customer_id) VALUES ('$user_id')");

            $cart_id = $db->conn->insert_id;
        }

        $result = $db->query("INSERT INTO cart_items(count, cart_id, product_id) VALUES ('$c', '$cart_id', '$pid')");
        $db->query("SET FOREIGN_KEY_CHECKS=1");

        $_SESSION['success'] = "Product successfully updated!";
        header('Location: /cart');
        exit;
    }

    public function getCartData() {
        session_start();
        $user_id = $_SESSION["user_id"];
        $db = new Database();

        $result = $db->query("SELECT ci.count as cart_count, ci.cart_item_id, p.`name`, p.price, p.product_id, p.count as avc, ct.*, c.cart_id FROM cart c
INNER JOIN cart_items ci on c.cart_id=ci.cart_id
INNER JOIN product p on ci.product_id=p.product_id
INNER JOIN category ct on p.category_id=ct.category_id WHERE c.customer_id='$user_id'");

        return $db->fetchAll($result);
    }

    public function placeOrder() {
        session_start();
        $user_id = $_SESSION["user_id"];
        $db = new Database();
        $db->query("SET FOREIGN_KEY_CHECKS=0");

        $tp = $_POST["tp"];
        $now = new DateTime();
        $date = $now->format("Y-m-d");

        $db->query("INSERT INTO `order`(date, total, customer_id) VALUES ('$date', '$tp', '$user_id')");
        $order_id = $db->conn->insert_id;

        $pid = $_POST["pid"];
        $itp = $_POST["itp"];
        $ciid = $_POST["ciid"];
        $c = $_POST["c"];

        for ($i = 0; $i < count($pid); $i++) {
            $db->query("INSERT INTO order_items(count, total_items_price, order_id, product_id) VALUES ('$c[$i]', '$itp[$i]', '$order_id', '$pid[$i]')");
            $db->query("UPDATE product SET count=count-'$c[$i]' WHERE product_id='$pid[$i]'");
            $db->query("DELETE FROM cart_items WHERE cart_id='$ciid[$i]'");
        }

        $db->query("SET FOREIGN_KEY_CHECKS=1");
        header('Location: /orders');
        exit;
    }

    public function getUserOrders() {
        session_start();
        $user_id = $_SESSION["user_id"];
        $db = new Database();

        $orders = array();

        $db_orders = $db->fetchAll($db->query("SELECT * FROM `order` WHERE customer_id='$user_id'"));

        foreach ($db_orders as $db_order) {
            $order_id = $db_order["order_id"];
            $order_items = $db->fetchAll($db->query("SELECT ot.*, p.name, p.price, p.image FROM order_items ot INNER JOIN product p ON ot.product_id=p.product_id WHERE order_id='$order_id'"));
            $data = [
                "order" => $db_order,
                "items" => $order_items
            ];

            array_push($orders, $data);
        }

        return $orders;
    }

    public function getDailyOrders() {
        $now = new DateTime();
        $date = $now->format("Y-m-d");

        $db = new Database();

        $orders = array();

        $db_orders = $db->fetchAll($db->query("SELECT * FROM `order` WHERE date='$date'"));

        foreach ($db_orders as $db_order) {
            $order_id = $db_order["order_id"];
            $order_items = $db->fetchAll($db->query("SELECT ot.*, p.name, p.price, p.image FROM order_items ot INNER JOIN product p ON ot.product_id=p.product_id WHERE order_id='$order_id'"));
            $data = [
                "order" => $db_order,
                "items" => $order_items
            ];

            array_push($orders, $data);
        }

        return $orders;
    }

    public function getIncomeReport() {
        $now = new DateTime();
        $today = $now->format("Y-m-d");
        $sub_month = $now->modify('-1 month');
        $sub_date = $sub_month->format("Y-m-d");

        $db = new Database();

        $total = 0;

        $db_orders = $db->fetchAll($db->query("SELECT * FROM `order` WHERE date BETWEEN '$sub_date' AND '$today'"));

        foreach ($db_orders as $db_order) {
            $total += $db_order["total"];
        }

        return [
            "orders" => $db_orders,
            "today" => $today,
            "sub_date" => $sub_date,
            "total" => $total
        ];
    }
}