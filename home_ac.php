<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('includes/styles.php'); ?>
    <style>
        svg {
                width: 1em;
                height: 1em;
            }
    </style>
    <title>Bauhinia - Monthly Income</title>
</head>

<body>
<?php include('includes/navbar.php'); ?>

<div class="container" id="data_cont">
    <div class="row mt-5">
        <div class="col-md-12">
            <h4>Monthly Income <small
                        class="text-muted">( <?php echo $data["sub_date"]; ?> to <?php echo $data["today"]; ?> )</small>
            </h4>
        </div>
    </div>

    <div class="row mt-3 mb-3">
        <div class="col-md-3">
            <button type="button" class="btn btn-primary form-control" id="exp">Print Report</button>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <h6>Total Income</h6>
                            <h4>Rs. <?php echo $data["total"]; ?>.00</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <h6>Total # of Orders</h6>
                            <h4><?php echo count($data["orders"]); ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <div class="row mt-3 mb-5">
        <div class="col-md-12">
            <table class="table table-responsive table-striped" id="table_orders">
                <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Date</th>
                    <th>Total</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($data["orders"] as $order) {
                    ?>
                    <tr>
                        <td><?php echo $order["order_id"]; ?></td>
                        <td><?php echo $order["date"]; ?></td>
                        <td>Rs. <?php echo $order["total"]; ?>.00</td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include('includes/javascript.php'); ?>
<script src="/assets/js/printelement.js"></script>
<script>
    $(document).ready(function () {
        $('#table_orders').DataTable();

        $('#exp').click(function () {
            $('#data_cont').show().printElement();
        });
    });
</script>
</body>

</html>