<?php 
require 'php-includes/check-login.php';
require 'php-includes/connect.php';


if (isset($_GET['pin_request'])) {
    $amount = $_GET['amount'];
    $date = date('y-m-d');
    $email = $_SESSION['userid'];
    if ($amount != " ") {
        $query = "INSERT INTO `pin_request`(`email`, `amount`, `date`) VALUES  (?,?,?)";
        $stmt = $db->prepare($query);
        $result =  $stmt->execute(array($email, $amount, $date));
        if ($result !== false) {
            echo "<script>alert('Pin Request Send Successfully')</script>"; 
            header("Location:pin-request.php");
        }else{
            
        echo "<script>alert('Unknown Error Occur'); window.location.assgin('pin_request.php');</script>";
        }
    }else{
        echo "<script>alert('Please Enter Amount');</script>";
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

    <title>MLM Website - Pin Request</title>

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
                        <h1 class="page-header">Pin Request</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-4">
                        <form method="get">
                            <div class="form-group">
                                <label>Amount</label>
                                <input class="form-control" type="text" name="amount" required>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Pin Request" name="pin_request">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>S.N.</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                            
                                <?php 
                                $getQuery = "SELECT * FROM pin_request WHERE email = ?";
                                $stmt1 = $db->prepare($getQuery);
                                $stmt1->execute(array($_SESSION['userid']));
                                if ($stmt1->rowCount() > 0) {
                                    foreach ($stmt1->fetchAll() as $row) {
                                        $count = $row['id'];
                                        echo "<tr><td>{$count}</td>";
                                        echo "<td>{$row['amount']}</td>";
                                        echo "<td>{$row['status']}</td></tr>";

                                    }
                                }else{
                                    echo "<tr><td colspan='3'>You haven't requested any pin</td></tr>";
                                }

                                 ?>
                            
                            
                        </table>
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
