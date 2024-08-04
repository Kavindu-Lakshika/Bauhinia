<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('includes/styles.php'); ?>
    <title></title>
</head>

<body>
<?php include('includes/navbar.php'); ?>

<div class="container">
    <div class="row mt-5">
        <div class="col-md-12">
            <h4><i class="fa fa-shopping-cart"></i> Today's Orders</h4>
        </div>
    </div>

    <div class="row mt-3 mb-3">
        <div class="col-md-3">
            <button type="button" class="btn btn-primary form-control" id="exp">
                <i class="fa fa-file-export" style="margin-right: 5px;"></i> Export Data to Excel
            </button>
        </div>
    </div>

    <hr>

    <div class="mt-3 mb-5">
        <div class="col-md-12">
            <table class="table table-striped" id="table_orders">
            <?php
            echo '<thead>';
            echo '<tr>';
            echo '<th>Order ID</th>';
            echo '<th>Date</th>';
            echo '<th>Total</th>';
            echo '<th>Customer ID</th>';
            echo '<th>Product ID</th>';
            echo '<th>Product Name</th>';
            echo '<th>Count</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            foreach ($data as $order) {

                foreach ($order['items'] as $item) {
                    echo '<tr>';
                    if ($item === $order['items'][0]) {
                        echo '<td>' . $order['order']['order_id'] . '</td>';
                        echo '<td>' . $order['order']['date'] . '</td>';
                        echo '<td>Rs. ' . $order['order']['total'] . '.00</td>';
                        echo '<td>' . $order['order']['customer_id'] . '</td>';
                    } else {
                        echo '<td></td>';
                        echo '<td></td>';
                        echo '<td></td>';
                        echo '<td></td>';
                    }

                    echo '<td>' . $item['product_id'] . '</td>';
                    echo '<td>' . $item['name'] . '</td>';
                    echo '<td>' . $item['count'] . '</td>';
                    echo '</tr>';
                }
            }

            echo '</tbody>';
            ?>
            </table>
        </div>
    </div>
</div>

<?php include('includes/javascript.php'); ?>
<script src="https://cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>
<script>
    function exportToExcel() {
        $('#exp').click(function () {
            let date = new Date();
            let options = { year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: 'numeric', second: 'numeric', hour12: false };
            let dateString = date.toLocaleString('en-US', options);
            let name = dateString;
            let fileName = dateString + ".xls";

            let table = $("#table_orders").DataTable();

            let data = table.data().toArray();

            let tempTable = $("<table>").append($("<thead>")).append($("<tbody>"));
            $.each(data, function(index, row) {
                let tr = $("<tr>");
                $.each(row, function(index, value) {
                    let td = $("<td>").text(value);
                    tr.append(td);
                });
                tempTable.find("tbody").append(tr);
            });

            tempTable.table2excel({
                name: name,
                filename: fileName,
                preserveColors: false
            });
        });
    }

    $(document).ready(function () {
        $('#table_orders').DataTable({
            ordering: false
        });
        exportToExcel();
    });
</script>
</body>

</html>