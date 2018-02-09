<?php
include "../main/header.php";
require_once "../../controller/setup/EmployeeImformation.php";

$vc = new EmployeeInformation();

if(isset($_GET['emp_id'])){
    $emp_id = $_GET['emp_id'];
    if(!$vc->deleteEmp($emp_id))
        echo "<div class='alert alert-danger'>You can not <b>Delete</b> this Employee Because he is assigned as a trainer</div>";
}
$employeeList = $vc->getAllEmployee();
?>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header" style="height:65px">
                    <h3 class="box-title"></h3>

                    <div class="col-xs-12" style="padding-top:10px; padding-bottom:10px">
                        <div class="input-group input-group-sm" style="float:left; margin-left:-20px;">
                            <a href="EmployeeInformation_entry.php"> <button type="button" class="btn btn-block btn-primary" style="width:200px">New Employee</button> </a>
                        </div>

                    </div>

                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody><tr>
                            <th>ID</th>
                            <th>Full Name</th>
                            <th>Employee ID</th>
                            <th>Contact Number</th>
                            <th>Gender</th>
                            <th>Email</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        <?php for($i=0;$i<count($employeeList);$i++){  $now = $employeeList[$i];?>
                        <tr>
                            <td><?php echo $i+1; ?></td>
                            <td><?php echo $now['emp_name'].' '.$now['emp_name']; ?></td>
                            <td><?php echo $now['user_id']; ?></td>
                            <td><?php echo $now['emp_connum']; ?></td>
                            <td><?php if($now['emp_gender'] == 0) echo "MALE"; else echo "FEMALE"; ?></td>
                            <td><?php echo $now['user_email']; ?></td>
                            <td><img class="img-responsive" src="<?php echo RES_PATH.$now['emp_img'];?>" alt="Image" style="width:60px; height:60px"></td>
                            <td><?php if($now['emp_status'] == 1) echo "<span class='label label-success'>Approved</span>"; else echo "<span class='label label-danger'>banned</span>"; ?></td>
                            <td>
                                <a href="EmployeeInformation_detail.php?emp_id=<?php echo $now['_id'];?>"><button type="button" class="btn btn-block btn-info btn-xs" style="width:50px;float:left">Detail</button></a>
                                <a href="EmployeeInformation_entry.php?emp_id=<?php echo $now['_id'];?>"><button type="button" class="btn btn-block btn-info btn-xs" style="width:50px;float:left">Edit</button></a>
                                <a href="EmployeeInformation.php?emp_id=<?php echo $now['_id'];?>"><button btn_delete type="button" class="btn btn-block btn-danger btn-xs" style="width:50px;float:left" >Delete</button></a>
                            </td>
                        </tr>
                        <?php } ?>
                        </tbody></table>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
<script type="text/javascript" src="../../resource/js/EmployeeInformation.js"></script>
<?php
include "../main/footer.php";
?>
