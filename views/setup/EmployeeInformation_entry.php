<?php
include "../main/header.php";
require_once "../../controller/setup/EmployeeImformation.php";

$vc = new EmployeeInformation();
$action_status = 'normal';
$emp_id = 0;
$emp_now = array('emp_name'=>'','emp_surname'=>'','emp_connum'=>'','emp_gender'=>'Male','emp_birth'=>'','emp_img'=>'','emp_status'=>0,'user_email'=>'','user_password'=>'');
if(isset($_GET['emp_id'])) {
    $action_status = 'update';
    $emp_id = $_REQUEST['emp_id'];
    if(!$emp_now = $vc->getByEmpId($emp_id)){
        echo 'Server Not Found';
        exit();
    }
}

if(isset($_REQUEST['action_status']) && $_REQUEST['action_status'] == 'save') {
    $emp_img = $_FILES['emp_img']['tmp_name'];
    $seedRand = rand(1,500)*rand(1,500);
    $src = RES_PATH.$seedRand.".png";
    if(is_uploaded_file($emp_img))
        move_uploaded_file($_FILES['emp_img']['tmp_name'],$src);
    $emp_img = $seedRand.'.png';
    $emp_status = $gender = 0;

    if(isset($_REQUEST['emp_status']))
        $emp_status = 1;
    if($_REQUEST['emp_gender'] == 'Female')
        $gender = 1;
    $vc->saveEmployee($_REQUEST['emp_name'],$_REQUEST['emp_surname'],$_REQUEST['emp_connum'],$gender,$_REQUEST['emp_birth'],$emp_img,$emp_status,$_REQUEST['emp_name'],$_REQUEST['user_email'],$_REQUEST['user_password']);
}

if(isset($_REQUEST['action_status']) && $_REQUEST['action_status'] == 'update') {

    $emp_id = $_REQUEST['emp_id'];
    if(!$emp_now = $vc->getByEmpId($emp_id)){
        echo 'Server Not Found';
        exit();
    }
    if($_FILES['emp_img'])
        $seedRand = rand(1,500)*rand(1,500);
    $src = RES_PATH.$seedRand.".png";
    $emp_img = $seedRand.'.png';
    if(is_uploaded_file($_FILES['emp_img']['tmp_name']))
        move_uploaded_file($_FILES['emp_img']['tmp_name'],$src);
    else
        $emp_img = $emp_now['emp_img'];

    $emp_status = $gender = 0;

    if(isset($_REQUEST['emp_status']))
        $emp_status = 1;
    if($_REQUEST['emp_gender'] == 'Female')
        $gender = 1;

    $vc->updateEmployee($_REQUEST['emp_id'],$_REQUEST['emp_name'],$_REQUEST['emp_surname'],$_REQUEST['emp_connum'],$gender,$_REQUEST['emp_birth'],$emp_img,$emp_status,$_REQUEST['emp_name'],$_REQUEST['user_email'],$_REQUEST['user_password']);

    echo '<script>location.href="EmployeeInformation.php";</script>';
}
?>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header" style="height:65px">
                    <h3 class="box-title"></h3>

                    <div class="col-xs-12" style="padding-top:10px; padding-bottom:10px">
                        <div class="input-group input-group-sm" style="float:left; margin-left:-20px;">
                            <a href="EmployeeInformation.php"> <button type="button" class="btn btn-block btn-primary" style="width:200px">Employee List</button> </a>
                        </div>
                        <div class="input-group input-group-sm" style="width: 150px; float:right">
                        </div>
                    </div>

                </div>
                <form action="EmployeeInformation_entry.php" id="emp_form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                    <input type="hidden" id="action_status" name="action_status" value="<?php echo $action_status; ?>"/>
                    <input type="hidden" id="emp_id" name="emp_id" value="<?php echo $emp_id;?>" />
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Name<span style="color:#F00"> * </span></label>
                            <div class="col-sm-10">
                                <input type="text" value="<?php echo $emp_now['emp_name']; ?>" autofocus = "autofocus" class="form-control" placeholder="first Name"  name="emp_name" Fd-gp="input" Field="String">
                                <span class="help-block" style="color:#F00"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">SurName<span style="color:#F00"> * </span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Last Name"  name="emp_surname" Fd-gp="input" Field="String" value="<?php echo $emp_now['emp_surname']; ?>">
                                <span class="help-block" style="color:#F00"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Contact Number<span style="color:#F00"> * </span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Contact Number" name="emp_connum" Fd-gp="input" Field="String" value="<?php echo $emp_now['emp_connum']; ?>">
                                <span class="help-block" style="color:#F00"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Gender</label>
                            <div class="col-sm-10" >
                                <select class="form-control" name="emp_gender" value="<?php echo $emp_now['emp_gender']; ?>">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                                <span class="help-block" style="color:#F00"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">BirthDay</label>
                            <div class="col-sm-10" >
                                <input type="date" class="form-control" name="emp_birth"  Fd-gp="input" Field="String" value="<?php echo $emp_now['emp_birth']; ?>"/>
                                <span class="help-block" style="color:#F00"></span>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" placeholder="Email"  name="user_email" Fd-gp="input" Field="String" value="<?php echo $emp_now['user_email']; ?>">
                                <span class="help-block" style="color:#F00"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" placeholder="Password"  name="user_password" Fd-gp="input" Field="String" value="<?php echo $emp_now['user_password']; ?>">
                                <span class="help-block" style="color:#F00"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Image</label>
                            <div class="col-sm-10">
                                <input type="file" name="emp_img" value="<?php echo RES_PATH.$emp_now['emp_img']; ?>">
                                <span class="help-block" style="color:#F00"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Active</label>
                            <div class="col-sm-10">
                                <input type="checkbox" name="emp_status" <?php if($emp_now['emp_status'] == 1) {echo "checked='checked'";} ?>>
                                <span class="help-block" style="color:#F00"></span>
                            </div>
                        </div>
                    </div>

                    <div class="box-footer" style="text-align:center">
                        <button type="button" class="btn btn-info" id="btn_save">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
<script type="text/javascript" src="../../resource/js/EmployeeInformation.js">

</script>
<?php
include "../main/footer.php";
?>