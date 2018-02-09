<?php
include "../main/header.php";
require_once "../../controller/academic/assigntrainer.php";

$vc = new assigntrainer();
$action_status = 'normal';
$asstran_id = 0;
$ass_trainer = array(TRAINING_ID=>'', EMPLOYEE_ID=>'');

$trainList = $vc->getTrainingList();
$employeeList = $vc->getEmployeeList();

if(isset($_GET['asstran_id'])) {
    $action_status = 'update';
    $asstran_id = $_REQUEST['asstran_id'];
    if(!$ass_trainer = $vc->getByAssignTrainerId($asstran_id)){
        echo 'Server Not Found';
        exit();
    }
}

if(isset($_REQUEST['action_status']) && $_REQUEST['action_status'] == 'save') {
    $vc->saveAssignTrainer($_REQUEST['training_id'], $_REQUEST['employee_id']);
    $_REQUEST = array();
}

if(isset($_REQUEST['action_status']) && $_REQUEST['action_status'] == 'update') {
    $vc->updateAssignTrainer($_REQUEST['asstran_id'], $_REQUEST['training_id'], $_REQUEST['employee_id']);
    echo '<script>location.href="AssignTrainer.php";</script>';
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
                            <a href="AssignTrainer.php"> <button type="button" class="btn btn-block btn-primary" style="width:200px">Assign Trainer</button> </a>
                        </div>
                    </div>

                </div>
                <form action="AssignTrainer_entry.php" id="asstrainer_form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                    <input type="hidden" id="action_status" name="action_status" value="<?php echo $action_status; ?>">
                    <input type="hidden" id="asstran_id" name="asstran_id" value="<?php echo $asstran_id;?>" />
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Training<span style="color:#F00"> * </span></label>
                            <div class="col-sm-10">
                                <select class="form-control" name="training_id" id="training_id" required>
                                    <option value="">Select</option>
                                    <?php foreach($trainList as $training) { ?>
                                    <option value="<?php echo $training[ID] ?>" <?php if($training[ID] == $ass_trainer[TRAINING_ID]) echo 'selected="true"'; ?>><?php echo $training[TRAINING_NAME] ?></option>
                                    <?php } ?>
                                </select>
                                <span class="help-block" style="color:#F00"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Employee<span style="color:#F00"> * </span></label>
                            <div class="col-sm-10">
                                <div  id="divSection">
                                    <select class="form-control" name="employee_id" id="employee_id" required>
                                        <option value="">Select</option>
                                        <?php foreach($employeeList as $employee) { ?>
                                        <option value="<?php echo $employee[ID] ?>" <?php if($employee[ID] == $ass_trainer[EMPLOYEE_ID]) echo 'selected="true"'; ?>><?php echo $employee[EMPLOYEE_NAME] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
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
<script src="../../resource/js/assigntrainer.js"></script>

<?php
include "../main/footer.php";
?>