<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('includes/styles.php'); ?>
    <title>Bauhinia - Cart</title>
</head>

<body>
<?php include('includes/navbar.php'); ?>

<div class="container">
    <div class="row mt-5 mb-3">
        <div class="col-md-12">
            <h4><i class="fa fa-shopping-cart" style="margin-right: 7px"></i> My Cart</h4>
        </div>
    </div>

    <hr>

    <form action="/place_order" method="post">
        <div class="row mt-3 mb-5">
            <div class="col-md-8">
                <?php
                foreach ($data as $datum) {
                    ?>
                    <div class="row mt-2 cart-item">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <img src="./product_images/20230214081514.jpg" alt=""
                                                 style="max-width: 100%">
                                        </div>
                                        <div class="col-md-2"></div>
                                        <div class="col-md-5 align-middle">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h4><?php echo $datum["name"] ?></h4>
                                                    <h5 class="text-muted"><?php echo $datum["category"] ?></h5>
                                                </div>
                                            </div>

                                            <div class="row mt-1">
                                                <p>Available # of items: <span
                                                            class="avc"><?php echo $datum["avc"] ?></span></p>
                                                <p style="margin-top: -20px">Single item price: Rs. <span
                                                            class="sip"><?php echo $datum["price"] ?>.00</span></p>
                                                <p style="margin-top: -20px">Total: Rs. <span
                                                            class="tot"><?php echo $datum["price"] * $datum["cart_count"] ?></span>.00
                                                    <input type="hidden" name="itp[]" class="itp"
                                                           value="<?php echo $datum["price"] * $datum["cart_count"] ?>">
                                                    <input type="hidden" name="pid[]" class="pid"
                                                           value="<?php echo $datum["product_id"]; ?>">
                                                    <input type="hidden" name="ciid[]" class="ciid"
                                                           value="<?php echo $datum["cart_item_id"]; ?>">
                                                </p>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-md-8">
                                                    <div class="input-group mb-3">
                                                        <button type="button" class="btn btn-primary m"><i
                                                                    class="fa fa-minus"></i></button>
                                                        <input type="text" class="form-control text-center c" name="c[]"
                                                               id="c" value="<?php echo $datum["cart_count"] ?>"
                                                               readonly>
                                                        <button type="button" class="btn btn-primary p"><i
                                                                    class="fa fa-plus"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2" style="max-height: 100%">
                                            <a href="/del_cart_item/<?php echo $datum["cart_item_id"] ?>"
                                               class="btn btn-primary form-control" style="margin-top: 70px"><i
                                                        class="fa fa-trash"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>

            <div class="col-md-4">
                <div class="row mt-2">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p>Name:</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="text-end"><?php echo $_SESSION["name"]; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p>Address:</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="text-end"><?php echo $_SESSION["address"]; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p>Phone Number 01:</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="text-end"><?php echo $_SESSION["p1"]; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p>Phone Number 02:</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="text-end"><?php echo $_SESSION["p2"]; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p># of Items:</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="text-end"><?php echo count($data); ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4><b>Total:</b></h4>
                                    </div>
                                    <div class="col-md-6">
                                        <h4 class="text-end"><b>Rs. <span id="full_total"></span>.00</b></h4>
                                        <input type="hidden" name="tp" id="tp">
                                    </div>
                                </div>

                                <div class="rom mt-1">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                   id="flexCheckDefault" required>
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Confirm Billing Details
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary form-control">
                                            <i class="fa fa-credit-card" style="margin-right: 7px"></i> Checkout
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<?php include('includes/javascript.php'); ?>
<script>
    function minus() {
        $('.m').click(function () {
            let ic = parseInt($(this).closest('.cart-item').find('.c').val());
            let sip = parseInt($(this).closest('.cart-item').find('.sip').text());

            if (ic > 1) {
                ic--;
            }

            let tot = ic * sip;
            $(this).closest('.cart-item').find('.c').val(ic);
            $(this).closest('.cart-item').find('.tot').html(tot);
            $(this).closest('.cart-item').find('.itp').val(tot);

            getFullTotal();
        });
    }

    function plus() {
        $('.p').click(function () {
            let ic = parseInt($(this).closest('.cart-item').find('.c').val());
            let sip = parseInt($(this).closest('.cart-item').find('.sip').text());
            let avc = parseInt($(this).closest('.cart-item').find('.avc').text());

            if (ic < avc) {
                ic++;
            }

            let tot = ic * sip;
            $(this).closest('.cart-item').find('.c').val(ic);
            $(this).closest('.cart-item').find('.tot').html(tot);
            $(this).closest('.cart-item').find('.itp').val(tot);

            getFullTotal();
        });
    }

    function getFullTotal() {
        let total = 0;

        $('.tot').each(function () {
            total += parseInt($(this).text());
        });

        $('#full_total').html(total);
        $('#tp').val(total);
    }

    $(document).ready(function () {
        minus();
        plus();
        getFullTotal();
    });
</script>
</body>

</html>