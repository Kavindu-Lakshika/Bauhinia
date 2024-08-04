<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('includes/styles.php'); ?>
    <title>Bauhinia - Orders</title>
</head>

<body>
<?php include('includes/navbar.php'); ?>

<div class="container">
    <div class="row mt-5 mb-3">
        <div class="col-md-12">
            <h4><i class="fa fa-box" style="margin-right: 7px"></i> My Orders</h4>
        </div>
    </div>

    <hr>

    <div class="row mt-2 mb-5">
        <div class="col-md-12">
            <?php
            foreach ($data as $datum) {
                ?>
                <div class="row mt-5">
                    <div class="col-md-2">
                        <h5><b>Order ID: <?php echo $datum["order"]["order_id"]; ?></b></h5>
                    </div>

                    <div class="col-md-3">
                        <h5><b>Order Date: <?php echo $datum["order"]["date"]; ?></b></h5>
                    </div>

                    <div class="col-md-3">
                        <h5><b>Total: Rs. <?php echo $datum["order"]["total"]; ?>.00</b></h5>
                    </div>
                </div>

                <div class="row mt-1">
                    <div class="col-md-12">
                        <table class="table table-striped table-responsive table-dark">
                            <tbody>
                            <?php
                            foreach ($datum["items"] as $item) {
                                ?>
                                <tr>
                                    <td class="align-middle">
                                        <img src="./product_images/<?php echo $item['image'];?>" alt="" style="max-width: 70px;">
                                    </td>
                                    <td class="align-middle"><?php echo $item['name'];?></td>
                                    <td class="align-middle">Rs. <?php echo $item['price'];?>.00</td>
                                    <td class="align-middle"><?php echo $item['count'];?></td>
                                    <td class="align-middle">Rs. <?php echo $item['total_items_price'];?>.00</td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <hr>
                <?php
            }
            ?>
        </div>
    </div>

<?php include('includes/javascript.php'); ?>
<script>
    $(document).ready(function () {
        let data = JSON.parse(<?php echo json_encode($data);?>);
        console.log(data);
    });
</script>
</body>

</html>