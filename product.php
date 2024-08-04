<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('includes/styles.php'); ?>
    <title>Bauhinia - Product</title>
</head>

<body>
<?php include('includes/navbar.php'); ?>

<div class="container">
    <div class="row mt-5 justify-content-center">
        <div class="col-md-4" style="margin-right: 30px">
            <img src="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/'; ?>product_images/<?php echo $data["image"]; ?>"
                 alt="" style="max-width: 100%">
        </div>
        <div class="col-md-4">
            <h2><?php echo $data["name"]; ?></h2>
            <h5 class="text-muted"><?php echo $data["category"]; ?></h5>

            <div class="row mt-5">
                <div class="col-md-12">
                    <p class="text-muted">Available # of items: <span id="count"><?php echo $data["count"]; ?></span>
                    </p>
                    <h4>Rs. <span><?php echo $data["price"]; ?></span>.00</h4>
                </div>
            </div>

            <form action="/add_to_cart" method="post">
                <input type="hidden" name="pid" value="<?php echo $data["product_id"]; ?>">
                <div class="row mt-5">
                    <div class="col-md-8">
                        <div class="input-group mb-3">
                            <button type="button" class="btn btn-primary" id="m"><i class="fa fa-minus"></i></button>
                            <input type="text" class="form-control text-center" name="c" id="c" value="1" readonly>
                            <button type="button" class="btn btn-primary" id="p"><i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-8">
                        <button type="submit" class="btn btn-primary form-control">
                            <i class="fa fa-cart-plus" style="margin-right: 7px"></i> Add to cart
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include('includes/javascript.php'); ?>
<script>
    let avc = parseInt($('#count').html());

    function plus() {
        $('#p').click(function () {
            let count = parseInt($('#c').val());

            if (count < avc) {
                count++;
            }

            $('#c').val(count);
        });
    }

    function minus() {
        $('#m').click(function () {
            let count = parseInt($('#c').val());

            if (count > 1) {
                count--;
            }

            $('#c').val(count);
        });
    }

    $(document).ready(function () {
        plus();
        minus();
    });
</script>
</body>

</html>