<?php
include "../main/header.php";
require_once("../../controller/academic/enrolltraining.php");

$vc = new enrolltraining();
$action_status = 'normal';
$enrotran_id = 0;
$enro_training = array(COURSE_ID=>'', STUDENT_ID=>'', TRAINING_ID=>'');

$courseList = $vc->getCourseList();
$studentList = $vc->getStudentList();
$trainingList = $vc->getTrainingList();

if(isset($_GET['enrotran_id'])) {
    $action_status = 'update';
    $enrotran_id = $_REQUEST['enrotran_id'];
    if(!$enro_training = $vc->getByEnrollTrainingId($enrotran_id)){
        echo 'Server Not Found';
        exit();
    }
}

if(isset($_REQUEST['action_status']) && $_REQUEST['action_status'] == 'save') {
    $vc->saveEnrollTraining($_REQUEST['student_id'], $_REQUEST['training_id']);
    $_REQUEST = array();
}

if(isset($_REQUEST['action_status']) && $_REQUEST['action_status'] == 'update') {
    $vc->updateEnrollTraining($_REQUEST['enrotran_id'], $_REQUEST['student_id'], $_REQUEST['training_id']);
    echo '<script>location.href="EnrollTraining.php";</script>';
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
                                <a href="EnrollTraining.php"> <button type="button" class="btn btn-block btn-primary" style="width:200px">Enroll Training List</button> </a>
                            </div>
                            <div class="input-group input-group-sm" style="width: 150px; float:right">
                            </div>
                        </div>

                    </div>
                    <form action="EnrollTraining_entry.php" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                        <input type="hidden" id="action_status" name="action_status" value="<?php echo $action_status; ?>">
                        <input type="hidden" id="enrotran_id" name="enrotran_id" value="<?php echo $enrotran_id;?>" />
                        <div class="box-body">

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Course <span style="color:#F00"> * </span></label>
                                <div class="col-sm-10">
                                    <select main-select class="form-control" name="course_id" id="course_id" <?php if($action_status == 'update') echo 'readonly="readonly"'; ?>>
                                        <option value="">Select</option>
                                        <?php foreach($courseList as $course) { ?>
                                        <option value="<?php echo $course[ID] ?>" <?php if($course[ID] == $enro_training[COURSE_ID]) echo 'selected="selected"'; ?>><?php echo $course[COURSE_NAME] ?></option>
                                        <?php } ?>
                                    </select>
                                    <span class="help-block" style="color:#F00"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Student <span style="color:#F00"> * </span></label>
                                <div class="col-sm-10">
                                    <select main-select class="form-control" name="student_id" id="student_id" <?php if($action_status == 'update') echo 'readonly="readonly"'; ?>>
                                        <option value="">Select</option>
                                        <?php foreach($studentList as $student) { ?>
                                        <option value="<?php echo $student[ID]; ?>" <?php if($student[ID] == $enro_training[STUDENT_ID]) echo 'selected ="selected"'; ?>><?php echo $student[STUDENT_NAME]; ?></option>
                                        <?php } ?>
                                    </select>
                                    <span class="help-block" style="color:#F00"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Training <span style="color:#F00"> * </span></label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="training_id" id="training_id">
                                        <option value="">Select</option>
                                        <?php foreach($trainingList as $training) { ?>
                                        <option value="<?php echo $training[ID] ?>" <?php if($training[ID] == $enro_training[TRAINING_ID]) echo 'selected="true"'; ?>><?php echo $training[TRAINING_NAME] ?></option>
                                        <?php } ?>
                                    </select>
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
<script src="../../resource/js/enrolltraining.js"></script>

<?php
include "../main/footer.php";
?>