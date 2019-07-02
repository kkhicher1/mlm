<?php 

require 'php-includes/check-login.php';
require 'php-includes/connect.php';
$userid = $_SESSION['userid'];

 ?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MLM Website - Pin</title>

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
                        <h1 class="page-header">Pin</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped ">
                                <tr>
                                    <th>S.No.</th>
                                    <th>Pin</th>
                                </tr>
                                    <?php 
                                    $i = 1;
                                    $query = "SELECT * FROM pin_list WHERE userid = ? AND status = ?";
                                    $st = $db->prepare($query);
                                    $st->execute(array($userid, 'open'));
                                    if ($st->rowCount() > 0) {
                                        while ($row = $st->fetch(PDO::FETCH_ASSOC)) {
                                            print "
                                            <tr>
                                                <td>$i</td>
                                                <td>{$row['pin']}</td>
                                            </tr>    
                                            ";
                                            $i++;
                                        }
                                    }else{
                                        print "<tr>
                                            <td colspan='2'>
                                            You haven't received any pin yet. <font color='red'><b>Please Try Again Later!</b></font>
                                            </td>
                                        </tr>";
                                    }

                                     ?>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
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
