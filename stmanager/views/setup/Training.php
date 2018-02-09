<?php
include "../main/header.php";
include "../../controller/setup/Training.php";
require_once('../../settings/params.php');

$vc = new Training();

if(isset($_GET['train_id'])) {
    if(!$vc->deleteTraining($_GET['train_id']))
        echo "<div class='alert alert-danger'>You can not <b>Delete</b> this training Because it had been enrolled or assigned by students and employees</div>";
}

$courseList = $vc->getCourseList();
$trainingList = $vc->getAllTrainings();
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
                            <a href="Training_entry.php"> <button type="button" class="btn btn-block btn-primary" style="width:200px">New Training</button> </a>
                        </div>
                    </div>

                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>SL</th>
                            <th>Training Name</th>
                            <th>Course Name</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                        <?php $i = 1; foreach ($trainingList as $training) { ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $training[TRAINING_NAME]; ?></td>
                            <td><?php echo $training[COURSE_NAME]; ?></td>
                            <td><?php echo $training[TRAINING_STARTDATE]; ?></td>
                            <td><?php echo $training[TRAINING_ENDDATE]; ?></td>
                            <td><?php echo $training[TRAINING_DESCRIPTION]; ?></td>
                            <td>
                                <a href="Training_entry.php?train_id=<?php echo $training[ID]; ?>"><button type="button" class="btn btn-block btn-info btn-xs" style="width:50px;float:left">Edit</button></a>
                                <a href="Training.php?train_id=<?php echo $training[ID]; ?>"><button btn_delete type="button" class="btn btn-block btn-danger btn-xs" style="width:50px;float:left">Delete</button></a>
                            </td>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
<script type="text/javascript" src="../../resource/js/training.js"></script>

<?php
include "../main/footer.php";
?>
