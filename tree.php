<?php 

require 'php-includes/check-login.php';
require 'php-includes/connect.php';
$userid = $_SESSION['userid'];
$search = $userid;

if (isset($_GET['search-id'])) {
    $search_id = strip_tags($_GET['search-id']);
    if (!empty($search_id)) {
        $sql_check = "SELECT * FROM user WHERE email= ?";
        $stmt = $db->prepare($sql_check);
        $stmt->execute(array($search_id));
        $result_check = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($search_id == $result_check['email']) {
             $search = $search_id;
        }else{
        echo "<script>alert('Access Denied');window.location.assign('tree.php');</script>";
    }
        
    }else{
        echo "<script>alert('Access Denied');window.location.assign('tree.php');</script>";
    }
   
}

function tree_data($userid){
    global $db;
    $data= array();
    $sql = "SELECT * FROM tree WHERE userid = ?";
    $stmt = $db->prepare($sql);
   $stmt->execute(array($userid));
   $result = $stmt->fetch(PDO::FETCH_ASSOC);
   $data['left'] = $result['left'];
   $data['right'] = $result['right'];
   $data['leftcount'] = $result['leftcount'];
   $data['rightcount'] = $result['rightcount'];
   return $data;


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

    <title>MLM Website - Tree</title>

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
                        <h1 class="page-header">Tree</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-2">
                        
                    </div>
                    <!-- /.col-lg-2 -->
                    <form>
                        <div class="col-lg-6">
                           <div class="form-group">
                               <input type="text" name="search-id" class="form-control" required autofocus>
                           </div>
                        </div>
                        <!-- /.col-lg-6 -->
                        <div class="col-lg-2">
                           <div class="form-group">
                               <input type="submit" value="Search" class="btn btn-primary">
                           </div>
                        </div>
                        <!-- /.col-lg-6 -->
                    </form>
                    <div class="col-lg-2">
                        
                    </div>
                    <!-- /.col-lg-2 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table" border="0" align="center" style="text-align: center">
                                <tr height="150">
                                    <?php $data = tree_data($search); ?>
                                    <td><?= $data['leftcount']; ?></td>
                                    <td colspan="2"><i class="fa fa-user fa-4x" style="color:orange;"></i><p><?= $search; ?></p></td>
                                    <td><?= $data['rightcount']; ?></td>
                                </tr>
                                <tr height="150">
                                    <?php 
                                    $first_left_user = $data['left'];
                                    $first_right_user = $data['right'];

                                     ?>
                                    <td colspan="2"><a href="?search-id=<?= $first_left_user; ?>"><i class="fa fa-user fa-4x" style="color:red;"></i><p><?= $first_left_user; ?></p></a></td>
                                    <td colspan="2"><a href="?search-id=<?= $first_right_user; ?>"><i class="fa fa-user fa-4x" style="color:red;"></i><p><?= $first_right_user; ?></p></a></td>
                                </tr>
                                <tr height="150">
                                    <?php 
                                    //getting first left user data
                                    $data_left_user = tree_data($first_left_user);
                                    $second_left_user = $data_left_user['left'];
                                    $second_right_user = $data_left_user['right'];

                                    //getting first right user data
                                    $data_right_user = tree_data($first_right_user);
                                    $third_left_user = $data_right_user['left'];
                                    $third_right_user = $data_right_user['right'];

                                     ?>
                                    <td><i class="fa fa-user fa-4x" style="color:green;"></i><p><?= $second_left_user; ?></p></td>
                                    <td><i class="fa fa-user fa-4x" style="color:green;"></i><p><?= $second_right_user; ?></p></td>
                                    <td><i class="fa fa-user fa-4x" style="color:green;"></i><p><?= $third_left_user; ?></p></td>
                                    <td><i class="fa fa-user fa-4x" style="color:green;"></i><p><?= $third_right_user; ?></p></td>
                                </tr>
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
