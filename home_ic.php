<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('includes/styles.php'); ?>
    <title>Bauhinia - Add Products</title>
</head>

<body>
    <?php include('includes/navbar.php'); ?>

    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <h4><i class="fa fa-boxes"></i> Add Products</h4>
            </div>
        </div>

        <div class="row mt-3 mb-3">
            <div class="col-md-3">
                <button type="button" class="btn btn-primary form-control" id="pab">
                    <i class="fa fa-plus" style="margin-right: 5px;"></i> Add New Product
                </button>
            </div>
        </div>

        <?php
        if (isset($_SESSION['success'])) {
        ?>
            <div class="row mt-3 mb-3">
                <div class="col-md-12">
                    <div class="alert alert-primary">
                        <?php echo $_SESSION['success']; ?>
                    </div>
                </div>
            </div>
        <?php

            unset($_SESSION['success']);
        }
        ?>

        <hr>

        <div class="row mt-3 mb-5">
            <div class="col-md-12">
                <table class="table table-striped table-responsive" id="table_prod">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Product Image</th>
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>Available Count</th>
                            <th>Price</th>
                            <th>Actions</th>
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
                                <td class="cat"><?php echo $item["category"] ?></td>
                                <td class="count"><?php echo $item["count"] ?></td>
                                <td class="price"><?php echo $item["price"] ?></td>
                                <td>
                                    <button id="<?php echo $item["product_id"] ?>" type="button" class="btn btn-primary btn-sm prod_edit_btn">
                                        <i class="fa fa-pencil-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="pam">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <h4><i class="fa fa-box" style="margin-right: 5px"></i>Add Product</h4>
                        </div>
                    </div>

                    <form action="/save_product" method="post" enctype="multipart/form-data">
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label for="n">Product Name:</label>
                                <input type="text" name="n" id="n" class="form-control" required>
                            </div>

                            <div class="col-md-4">
                                <label for="p">Price:</label>
                                <input type="number" name="p" id="p" class="form-control" required>
                            </div>

                            <div class="col-md-4">
                                <label for="c">Available Count:</label>
                                <input type="number" name="c" id="c" class="form-control" required>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label for="ca">Category:</label>
                                <input type="text" name="ca" id="ca" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label for="i">Product Image:</label>
                                <input type="file" name="i" id="i" class="form-control" accept="image/*" required>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-9"></div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary form-control">
                                    <i class="fa fa-box" style="margin-right: 5px"></i>Add Product
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="pum">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <h4><i class="fa fa-box" style="margin-right: 5px"></i>Update Product</h4>
                        </div>
                    </div>

                    <form action="/update_product" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id" class="form-control" required>
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label for="nu">Product Name:</label>
                                <input type="text" name="nu" id="nu" class="form-control" required>
                            </div>

                            <div class="col-md-4">
                                <label for="pu">Price:</label>
                                <input type="number" name="pu" id="pu" class="form-control" required>
                            </div>

                            <div class="col-md-4">
                                <label for="cu">Available Count:</label>
                                <input type="number" name="cu" id="cu" class="form-control" required>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label for="cau">Category:</label>
                                <input type="text" name="cau" id="cau" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label for="iu">Product Image:</label>
                                <input type="file" name="iu" id="iu" class="form-control" accept="image/*">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-9"></div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary form-control">
                                    <i class="fa fa-box" style="margin-right: 5px"></i>Update Product
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include('includes/javascript.php'); ?>
    <script>
        function openAddModel() {
            $('#pab').click(function() {
                $('#pam').modal('show');
            });
        }

        $(document).on('click', '.prod_edit_btn', function() {
            let id = this.id;
            let name = $(this).closest('tr').find('.name').text();
            let cat = $(this).closest('tr').find('.cat').text();
            let count = $(this).closest('tr').find('.count').text();
            let price = $(this).closest('tr').find('.price').text();

            $('#id').val(id);
            $('#nu').val(name);
            $('#cau').val(cat);
            $('#cu').val(count);
            $('#pu').val(price);

            $('#pum').modal('show');
        });

        $(document).ready(function() {
            $('#table_prod').DataTable();
            openAddModel();
        });
    </script>
</body>

</html>