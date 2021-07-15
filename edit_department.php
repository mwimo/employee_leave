<?php
session_start();
if(!isset($_SESSION["type"]))
{
	header("location:login");
} 
if (empty($_SESSION['token'])) { 
    $length = 32;
    $_SESSION['token'] = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $length); 
}
include('include/header.php'); 
?>
<head>
    <style>
        .input{
            border-top: none;
        }
    </style>
</head>

            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h4 class="page-header">Departments</h4>
                        </div>
                        <!-- /.col-lg-12 -->
                        <?php
                                    include ('include/config.php');
                                    $department_ID = $_GET['code'];
                                    if(isset($_POST['submit'])){
                                    $department_name = mysqli_real_escape_string($con, $_POST['department_name']);
                                    $department_short_name = mysqli_real_escape_string($con, $_POST['department_short_name']);
                                    $HOD = mysqli_real_escape_string($con, $_POST['HOD']);
                                    $description = mysqli_real_escape_string($con, $_POST['description']);
                                    $update = "UPDATE department SET department_name = '$department_name', department_short_name= '$department_short_name', 
                                    department_HOD_name = '$HOD', description = '$description' WHERE department_ID='$department_ID'";
                                    $update_query = mysqli_query($con, $update);
                                    if($update_query){
                                        echo "<div class='col-md-12'><div class='alert alert-info alert-dismissible'>
                                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                        Updated Successful
                                        </div></div>";
                                    }else{
                                        echo "<div class='col-md-12'><div class='alert alert-info alert-dismissible'>
                                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                        Failed!, Please try again.
                                        </div></div>";
                                    }
                                }
                                    ?>
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Edit Department
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="row">
                                        <!-- /.col-lg-6 (nested) -->
                                        <div class="col-lg-12">
                                        <?php
                                          include('include/config.php');
                                          $department_ID = $_GET['code'];
                                          $search = "SELECT * FROM department WHERE department_ID='$department_ID'";
                                          $run_query = mysqli_query($con, $search);
                                          while($row = mysqli_fetch_array($run_query)){
                                          ?>                                            
                                            <form role="form" method="post" action="">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="col-md-12">
                                                            <div class="row form-group">
                                                                <input type="text" value="<?php echo $row['department_name'] ?>" name="department_name" class="form-control" placeholder="Department Name" required>
                                                            </div>
                                                            <div class="row form-group">
                                                                <input type="text" value="<?php echo $row['department_short_name'] ?>" name="department_short_name" class="form-control" placeholder="Department Short Name" required>
                                                            </div>
                                                            <div class="row form-group">
                                                                <input type="text" value="<?php echo $row['department_HOD_name'] ?>" name="HOD" class="form-control" placeholder="Head of Department" required>
                                                            </div>
                                                            <div class="row form-group">
                                                                <textarea name="description" class="form-control" placeholder="Description"><?php echo $row['description'] ?></textarea>
                                                            </div>
                                                            <input type="text" name="token" value="<?=$_SESSION['token'] ?>" hidden>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit" name="submit" class="btn btn-sm btn-primary"><span class="fa fa-save"></span> Save</button>
                                            </form>
                                          <?php } ?>
                                        </div>
                                        <!-- /.col-lg-6 (nested) -->
                                    </div>
                                    <!-- /.row (nested) -->
                                </div>
                                <!-- /.panel-body -->
                            </div>
                            <!-- /.panel -->
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->

        <?php include('include/footer.php') ?>