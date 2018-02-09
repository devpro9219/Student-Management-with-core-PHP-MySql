<?php
include "../main/header.php";
require_once('../../controller/setup/Course.php');

$vc = new Course();
$action_status = 'normal';
$cur_id = 0;
$course = array(COURSE_NAME=>'', COURSE_DESCRIPTION=>'');

if(isset($_GET['cur_id'])) {
    $action_status = 'update';
    $cur_id = $_REQUEST['cur_id'];
    if(!$course = $vc->getByCourseId($cur_id)){
        echo 'Server Not Found';
        exit();
    }
}

if(isset($_REQUEST['action_status']) && $_REQUEST['action_status'] == 'save') {
    $vc->saveCourse($_REQUEST['course_name'], $_REQUEST['course_description']);
    $_REQUEST = array();
}

if(isset($_REQUEST['action_status']) && $_REQUEST['action_status'] == 'update') {
    $vc->updateCourse($_REQUEST['cur_id'], $_REQUEST['course_name'], $_REQUEST['course_description']);
    echo '<script>location.href="Course.php";</script>';
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
                            <a href="Course.php"> <button type="button" class="btn btn-block btn-primary" style="width:200px">Course List</button> </a>
                        </div>
                        <div class="input-group input-group-sm" style="width: 150px; float:right">
                        </div>
                    </div>
                </div>
                <form action="Course_entry.php" id="course_form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                    <input type="hidden" id="action_status" name="action_status" value="<?php echo $action_status; ?>">
                    <input type="hidden" id="cur_id" name="cur_id" value="<?php echo $cur_id;?>" />
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Course Name<span style="color:#F00"> * </span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="<?php echo $course[COURSE_NAME]?>" placeholder="Course Name" name="course_name" autofocus required>
                                <span class="help-block" style="color:#F00"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="<?php echo $course[COURSE_DESCRIPTION]?>" placeholder="Description"  name="course_description">
                                <span class="help-block" style="color:#F00"></span>
                            </div>
                        </div>
                    </div>

                    <div class="box-footer" style="text-align:center">
                        <button type="submit" id="btn_save" class="btn btn-info">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
<script type="text/javascript" src="../../resource/js/course.js"></script>

<?php
include "../main/footer.php";
?>