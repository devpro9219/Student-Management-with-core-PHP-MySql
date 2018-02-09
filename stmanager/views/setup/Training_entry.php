<?php
include "../main/header.php";
require_once("../../controller/setup/Training.php");
require_once("../../settings/params.php");

$vc = new Training();
$action_status = 'normal';
$train_id = 0;
$train_now = array(COURSE_ID=>'', TRAINING_NAME=>'', TRAINING_STARTDATE=>'', TRAINING_ENDDATE=>'', TRAINING_DESCRIPTION=>'');
$courseList = $vc->getCourseList();
if(isset($_GET['train_id'])){
    $action_status = 'update';
    $train_id = $_REQUEST['train_id'];
    if(!$train_now = $vc->getByTrainId($train_id)){
        echo 'Server Not Found';
        exit();
    }
}

if(isset($_REQUEST['action_status']) && $_REQUEST['action_status'] == 'save') {
    $vc->addTraining($_REQUEST['course_id'], $_REQUEST['train_name'], $_REQUEST['train_startdate'], $_REQUEST['train_enddate'], $_REQUEST['train_descr']);
    $_REQUEST = array();
}

if(isset($_REQUEST['action_status']) && $_REQUEST['action_status'] == 'update'){
    $train_id = $_REQUEST['train_id'];
    if(!$train_now = $vc->getByTrainId($train_id)){
        echo 'Server Not Found';
        exit();
    }

    $vc->updateTraining($_REQUEST['train_id'], $_REQUEST['course_id'], $_REQUEST['train_name'], $_REQUEST['train_startdate'], $_REQUEST['train_enddate'], $_REQUEST['train_descr']);
    echo '<script>location.href="Training.php";</script>';
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
                            <a href="Training.php"> <button type="button" class="btn btn-block btn-primary" style="width:200px">Training List</button> </a>
                        </div>
                    </div>

                </div>
                <form action="Training_entry.php" id="training_form" method="post" accept-charset="utf-8">
                    <input type="hidden" id="action_status" name="action_status" value="<?php echo $action_status; ?>" />
                    <input type="hidden" id="train_id" name="train_id" value="<?php echo $train_id;?>" />
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Course<span style="color:#F00"> * </span></label>
                            <div class="col-sm-10">
                                <select main-select class="form-control" name="course_id" id="course_id" <?php if($action_status == 'update') echo 'disabled="disabled"'; ?>>
                                    <option value="">Select</option>
                                    <?php foreach($courseList as $course) { ?>
                                    <option value="<?php echo $course[ID]; ?>" <?php if($course[ID] == $train_now[COURSE_ID]) echo 'selected="true"'; ?>><?php echo $course[COURSE_NAME]; ?></option>
                                    <?php } ?>
                                </select>
                                <span class="help-block" style="color:#F00"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Training Name<span style="color:#F00"> * </span></label>
                            <div class="col-sm-10">
                                <input type="text" value="<?php echo $train_now[TRAINING_NAME]?>" class="form-control" placeholder="Training Name"  name="train_name" required>
                                <span class="help-block" style="color:#F00"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">StartDate<span style="color:#F00"> * </span></label>
                            <div class="col-sm-10" >
                                <input type="date" class="form-control" name="train_startdate" value="<?php echo $train_now[TRAINING_STARTDATE]; ?>" required/>
                                <span class="help-block" style="color:#F00"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">EndDate<span style="color:#F00"> * </span></label>
                            <div class="col-sm-10">
                                <input type="date" name="train_enddate" class="form-control" value="<?php echo $train_now[TRAINING_ENDDATE]; ?>" required>
                                <span class="help-block" style="color:#F00"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-10">
                                <input type="text" value="<?php echo $train_now[TRAINING_DESCRIPTION]?>" class="form-control" placeholder="Description"  name="train_descr">
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
<script type="text/javascript" src="../../resource/js/training.js"></script>

<?php
include "../main/footer.php";
?>