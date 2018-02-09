<?php
include "../main/header.php";
require_once "../../controller/setup/Student.php";
require_once("../../settings/params.php");

$vc = new Student();
$action_status = 'normal';
$stu_id = 0;
$student = array(STUDENT_SURNAME=>'', STUDENT_NAME=>'', STUDENT_NAME=>'', STUDENT_CONNUM=>'', STUDENT_GENDER=>'Male', USER_EMAIL=>'', USER_PASSWORD=>'', STUDENT_IMG=>'', STUDENT_CUR_ID=>'',STUDENT_BIRTH=>'2017', STUDENT_STATUS=>0);

$curList = $vc->getCourseList();

if(isset($_GET['stu_id'])) {
    $action_status = 'update';
    $stu_id = $_REQUEST['stu_id'];
    if(!$student = $vc->getByStudentId($stu_id)){
        echo 'Server Not Found';
        exit();
    }
}

if(isset($_REQUEST['action_status']) && $_REQUEST['action_status'] == 'save') {
    $stu_img = $_FILES['stu_img']['tmp_name'];
    $seedRand = rand(1,500)*rand(1,500);
    $src = RES_PATH.$seedRand.".png";
    if(is_uploaded_file($stu_img))
        move_uploaded_file($_FILES['stu_img']['tmp_name'],$src);
    $stu_img = $seedRand.'.png';
    $stu_status = $gender = 0;
    if(isset($_REQUEST['stu_status']))
        $stu_status = 1;
    if($_REQUEST['stu_gender'] == 'Female')
        $gender = 1;
    $vc->saveStudent($_REQUEST['stu_name'], $_REQUEST['stu_surname'], $_REQUEST['contact_number'], $gender, $_REQUEST['email'], $_REQUEST['password'], $stu_img, $_REQUEST['cur_id'], $_REQUEST['birth'], $stu_status);
    $_REQUEST = array();

}

if(isset($_REQUEST['action_status']) && $_REQUEST['action_status'] == 'update') {
    $stu_id = $_REQUEST['stu_id'];
    if(!$student = $vc->getByStudentId($stu_id)){
        echo 'Server Not Found';
        exit();
    }
    if($_FILES['stu_img'])
        $seedRand = rand(1,500)*rand(1,500);
    $src = RES_PATH.$seedRand.".png";
    $stu_img = $seedRand.'.png';
    if(is_uploaded_file($_FILES['stu_img']['tmp_name']))
        move_uploaded_file($_FILES['stu_img']['tmp_name'], $src);
    else
        $stu_img = $student['stu_img'];

    $stu_status = $gender = 0;
    if(isset($_REQUEST['stu_status']))
        $stu_status = 1;
    if($_REQUEST['stu_gender'] == 'Female')
        $gender = 1;

    $vc->updateStudent($_REQUEST['stu_id'], $_REQUEST['stu_name'], $_REQUEST['stu_surname'], $_REQUEST['contact_number'], $gender, $_REQUEST['email'], $_REQUEST['password'], $stu_img, $_REQUEST['cur_id'], $_REQUEST['birth'], $stu_status);
    echo '<script>location.href="Student.php";</script>';
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
                            <a href="Student.php"> <button type="button" class="btn btn-block btn-primary" style="width:200px">Student List</button> </a>
                        </div>
                        <div class="input-group input-group-sm" style="width: 150px; float:right">
                        </div>
                    </div>

                </div>
                <form action="Student_entry.php" id="student_form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                    <input type="hidden" id="action_status" name="action_status" value="<?php echo $action_status; ?>"/>
                    <input type="hidden" id="stu_id" name="stu_id" value="<?php echo $stu_id;?>" />
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">SurName<span style="color:#F00"> * </span></label>
                            <div class="col-sm-10">
                                <input type="text" value="<?php echo $student[STUDENT_SURNAME]; ?>" class="form-control" placeholder="Sur Name"  name="stu_surname" required>
                                <span class="help-block" style="color:#F00"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Name<span style="color:#F00"> * </span></label>
                            <div class="col-sm-10">
                                <input type="text" value="<?php echo $student[STUDENT_NAME]; ?>" class="form-control" placeholder="Name"  name="stu_name" required>
                                <span class="help-block" style="color:#F00"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Contact Number<span style="color:#F00"> * </span></label>
                            <div class="col-sm-10">
                                <input type="text" value="<?php echo $student[STUDENT_CONNUM]; ?>" class="form-control" placeholder="Contact Number" name="contact_number" required>
                                <span class="help-block" style="color:#F00"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Gender<span style="color:#F00"> * </span></label>
                            <div class="col-sm-10" >
                                <select class="form-control" name="stu_gender" value="<?php echo $student[STUDENT_GENDER]; ?>" required>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                                <span class="help-block" style="color:#F00"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Email<span style="color:#F00"> * </span></label>
                            <div class="col-sm-10">
                                <input type="email" value="<?php echo $student[USER_EMAIL]; ?>" class="form-control" placeholder="Email"  name="email" required>
                                <span class="help-block" style="color:#F00"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Password<span style="color:#F00"> * </span></label>
                            <div class="col-sm-10">
                                <input type="password" value="<?php echo $student[USER_PASSWORD]; ?>" class="form-control" placeholder="Password"  name="password" required>
                                <span class="help-block" style="color:#F00"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Image<span style="color:#F00"> * </span></label>
                            <div class="col-sm-10">
                                <input type="file" value="<?php echo RES_PATH.$student[STUDENT_IMG]; ?>" name="stu_img">
                                <span class="help-block" style="color:#F00"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Class<span style="color:#F00"> * </span></label>
                            <div class="col-sm-10">
                                <select class="form-control" name="cur_id" id="cur_id" required>
                                    <option value="">Select</option>
                                    <?php foreach($curList as $cur) { ?>
                                    <option value="<?php echo $cur[ID]; ?>" <?php if($cur[ID] == $student[STUDENT_CUR_ID]) echo "selected ='selected'" ?>><?php echo $cur['cur_name']; ?></option>
                                    <?php } ?>
                                </select>
                                <span class="help-block" style="color:#F00"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Birth<span style="color:#F00"> * </span></label>
                            <div class="col-sm-10" >
                                <input type="date" class="form-control" name="birth" value="<?php echo $student[STUDENT_BIRTH]; ?>" required>
                                <span class="help-block" style="color:#F00"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Active</label>
                            <div class="col-sm-10">
                                <input type="checkbox" name="stu_status" <?php if($student[STUDENT_STATUS] == 1) {echo 'checked';} ?>>
                                <span class="help-block" style="color:#F00"></span>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer" style="text-align:center">
                        <button type="submit" class="btn btn-info" id="btn_save">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
<script type="text/javascript" src="../../resource/js/Student.js"></script>

<?php
include "../main/footer.php";
?>