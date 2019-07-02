<?php 

require 'php-includes/check-login.php';
require 'php-includes/connect.php';


$product_amount = 300;
//Clicked on send button

if (isset($_POST['send'])) {
    $userid = $_POST['userid'];
    $amount = $_POST['amount'];
    $id = $_POST['id'];

    $no_of_pin = $amount/$product_amount;
    $i = 1;
    while ($i <= $no_of_pin) {
        $new_pin = pin_generate();
        $st = $db->prepare("INSERT INTO pin_list(userid, pin) VALUES (?, ?)");
        $st->execute(array($userid, $new_pin));
        $i++;
    }

    //update pin request
    $updateQuery = "UPDATE pin_request SET status='close' WHERE id ='$id' LIMIT 1";
    $stmt = $db->prepare($updateQuery);
    
    if ($stmt->execute()) {
       echo "<script>alert('Pin Send Successfully'); window.location.assign('view-pin-request.php');</script>";
    }
}

function pin_generate(){
    global $db;
    $generated_pin = rand(10000,99999);

    $query = "SELECT *FROM pin_list where pin = '$generated_pin'";
    $stmt = $db->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        pin_generate();
    }else{
        return $generated_pin;
    }
}

 ?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MLM Website - View Pin Request</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include_once 'php-includes/menu.php'; ?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">View Pin Request</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <tr>
                                    <th>S.No</th>
                                    <th>User ID</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Send</th>
                                    <th>Cancel</th>
                                </tr>
                                <?php 
                                    $query = "SELECT * FROM pin_request WHERE status = 'open' ";
                                    $stmt = $db->prepare($query);
                                    $stmt->execute();
                                    
                                    if ($stmt->rowCount() > 0) {
                                        foreach ($stmt->fetchAll() as $row) {
                                            echo "<tr><td>{$row['id']}</td>";
                                            echo "<td>{$row['email']}</td>";
                                            echo "<td>{$row['amount']}</td>";
                                            echo "<td>{$row['date']}</td>";
                                            echo "<form method='post'>
                                            <input type='hidden' name='userid' value='{$row['email']}'>
                                            <input type='hidden' name='amount' value='{$row['amount']}'>
                                            <input type='hidden' name='id' value='{$row['id']}'>
                                            <td><input type='submit' value='Send' name='send' class='btn btn-primary'></td></form>";
                                            echo "<td>Cancel</td></tr>";
                                        }
                                    }else{
                                        ?>
                                        <td colspan="6">You havent any pin request</td>
                                        <?php
                                    }




                                 ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>

</body>

</html>
