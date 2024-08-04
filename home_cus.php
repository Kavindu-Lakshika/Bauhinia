<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('includes/styles.php'); ?>
    <title>Bauhinia - Home</title>
</head>

<body>
<?php include('includes/navbar.php'); ?>

<div class="container">
    <div class="row mt-5">
        <div class="col-md-2">
            <div class="row">
                <div class="col-md-12">
                    <div class="btn-group-vertical" style="width: 100%">
                        <a href="/home" class="btn btn-outline-primary"
                           style="width: 100%">All</a>
                        <?php
                        foreach ($cats as $cat) {
                            ?>
                            <a href="/category/<?php echo $cat["category_id"] ?>" class="btn btn-outline-primary"
                               style="width: 100%"><?php echo $cat["category"] ?></a>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-10">
            <div class="row mb-5">
                <?php
                foreach ($data as $datum) {
                    ?>
                    <div class="col-md-3" style="margin-bottom: 30px">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <img src="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/'; ?>product_images/<?php echo $datum["image"]; ?>"
                                             alt="" style="max-width: 100%">
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <h4 class="text-center"><?php echo $datum["name"]; ?></h4>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="text-muted text-center"><?php echo $datum["category"]; ?></p>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <h4 class="text-center">Rs. <?php echo $datum["price"]; ?>.00</h4>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <a target="_blank" class="btn btn-primary form-control"
                                           href="/product/<?php echo $datum["product_id"]; ?>">
                                            <i class="fa fa-eye" style="margin-right: 7px"></i> View
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php include('includes/javascript.php'); ?>
</body>

</html>