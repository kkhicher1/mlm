<?php 

require 'php-includes/check-login.php';
require 'php-includes/connect.php';

if (isset($_GET['userid']) && !empty($_GET['userid'])) {
    $db_userid = strip_tags($_GET['userid']);
    $db_amount = strip_tags($_GET['amount']);
    $date = date("Y-m-d");

    $sql_query = "INSERT INTO income_received(`userid`, `amount`, `date`) VALUES(?,?,?)";
    $db->prepare($sql_query)->execute(array($db_userid, $db_amount, $date));
    $db->prepare("UPDATE income SET current_bal = ? WHERE userid =?")->execute(array(0, $db_userid));
    echo "<script>alert('Paymenet Send Successfully');window.location.assign('income.php')</script>";
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

    <title>MLM Website - Income</title>

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
                        <h1 class="page-header">Income</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <tr>
                                    <td>S.No</td>
                                    <td>User ID</td>
                                    <td>Amount</td>
                                    <td>Account</td>
                                    <td>Send</td>
                                </tr>
                                <?php 

                                    $sql = "SELECT * FROM income WHERE current_bal >= 100";
                                    $stmt = $db->prepare($sql);
                                    $stmt->execute();
                                    if ($stmt->rowCount() > 0) {
                                        $count = 1;
                                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                            $query_user = "SELECT account FROM user WHERE email = ?";
                                            $stmt_user = $db->prepare($query_user);
                                            $stmt_user->execute(array($row['userid']));
                                            $rlt = $stmt_user->fetch(PDO::FETCH_ASSOC);
                                            $account = $rlt['account'];
                                            
                                            print "<tr>";
                                            print "<td>$count</td>";
                                            print "<td>".$row['userid']."</td>";
                                            print "<td>".$row['total_bal']."</td>";
                                            print "<td>".$account."</td>";?>
                                             <td>
                                                 <a class="btn btn-success" href="income.php?userid=<?= $row['userid']; ?>&amount=<?= $row['total_bal']; ?>">Send</a>
                                             </td>
                                            <?php
                                            print "</tr>";
                                            $count++;
                                        }
                                    }else{
                                        echo "<tr>
                                            <td colspan='5'>No Income </td>
                                            <tr>";
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
