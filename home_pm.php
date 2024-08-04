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
        <div class="col-md-12">
            <h4><i class="fa fa-boxes"></i> Product Availability</h4>
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

    <div class="row mt-3 mb-5">
        <div class="col-md-12">
            <table class="table table-striped table-responsive" id="table_prod">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Product Image</th>
                    <th>Product Name</th>
                    <th>Available Count</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($data as $item) {
                    ?>
                    <tr>
                        <td><?php echo $item["product_id"] ?></td>
                        <td>
                            <img src="./product_images/<?php echo $item["image"] ?>" alt="<?php echo $item["image"] ?>" style="max-width: 70px;">
                        </td>
                        <td class="name"><?php echo $item["name"] ?></td>
                        <td class="count"><?php echo $item["count"] ?></td>
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
<script src="https://cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>
<script>
    function exportToExcel() {
        $('#exp').click(function () {
            let date = new Date();
            let options = { year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: 'numeric', second: 'numeric', hour12: false };
            let dateString = date.toLocaleString('en-US', options);
            let name = dateString;
            let fileName = dateString + ".xls";

            let table = $("#table_prod").DataTable();

            let data = table.data().toArray();

            $.each(data, function(index, row) {
                $.each(row, function(index, value) {
                    if (typeof value === "object" && value.nodeName === "IMG") {
                        row[index] = $(value).attr("src");
                    }
                });
            });

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
        $('#table_prod').DataTable();
        exportToExcel();
    });
</script>
</body>

</html>