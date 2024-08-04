<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('includes/styles.php'); ?>
    <title>Bauhinia - Staff Registration</title>
</head>

<body>
<?php include('includes/navbar.php'); ?>

<div class="container">
    <div class="row mt-5 justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="text-center">Register</h3>
                        </div>
                    </div>

                    <form action="/staff_reg_action" method="post" id="reg_form">
                        <?php
                        if (isset($_SESSION['error'])) {
                            ?>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="alert alert-danger">
                                        <?php echo $_SESSION['error']; ?>
                                    </div>
                                </div>
                            </div>
                            <?php

                            unset($_SESSION['error']);
                        }
                        ?>

                        <?php
                        if (isset($_SESSION['success'])) {
                            ?>
                            <div class="row mt-3">
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
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label for="n">Enter Name:</label>
                                <input class="form-control" type="text" id="n" name="n" placeholder="John Doe" required>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-md-12">
                                <label for="em">Enter Email:</label>
                                <input class="form-control" type="email" id="em" name="em" placeholder="john@domain.com" required>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-md-12">
                                <label for="pw">Enter Password:</label>
                                <input class="form-control" type="password" id="pw" name="pw" placeholder="Password"
                                       required>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-md-12">
                                <label for="role">Select Staff Role:</label>
                                <select name="role" id="role" class="form-control">
                                    <option>- Select an Option -</option>
                                    <option value="Production Manager">Production Manager</option>
                                    <option value="Inventory Clerk">Inventory Clerk</option>
                                    <option value="Accountant">Accountant</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <input class="btn btn-primary form-control" type="submit" id="login_submit"
                                       name="login_submit" value="Register">
                            </div>
                        </div>
                    </form>

                    <div class="row mt-5 mb-3 justify-content-center">
                        <div class="col-md-12">
                            <p class="text-center">Already have an account? <a href="/">Login</a></p>
                            <p class="text-center">Customers register <a href="/register">here.</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/javascript.php'); ?>
<script>
    $(document).ready(function () {

    });
</script>
</body>

</html>