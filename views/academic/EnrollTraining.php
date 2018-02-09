<?php
include "../main/header.php";
require_once "../../controller/academic/enrolltraining.php";
require_once('../../settings/params.php');

$vc = new enrolltraining();

if(isset($_GET['enrotran_id']))
    $vc->deleteEnrollTraining($_GET['enrotran_id']);

$courseList = $vc->getCourseList();
$studentList = $vc->getStudentList();
$trainingList = $vc->getTrainingList();
$enrotrainList = $vc->getAllEnrollTrainings();
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
                            <a href="EnrollTraining_entry.php"> <button type="button" class="btn btn-block btn-primary" style="width:200px">Enroll Training</button> </a>
                        </div>
                    </div>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>SL</th>
                            <th>Course</th>
                            <th>Student</th>
                            <th>Training</th>
                            <th>Action</th>
                        </tr>
                        <?php $i = 1; foreach ($enrotrainList as $enroll_training) { ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $enroll_training[COURSE_NAME]; ?></td>
                            <td><?php echo $enroll_training[STUDENT_NAME]; ?></td>
                            <td><?php echo $enroll_training[TRAINING_NAME]; ?></td>
                            <td>
                                <a href="EnrollTraining_entry.php?enrotran_id=<?php echo $enroll_training[ID]; ?>"><button type="button" class="btn btn-block btn-info btn-xs" style="width:50px;float:left">Edit</button></a>
                                <a href="EnrollTraining.php?enrotran_id=<?php echo $enroll_training[ID]; ?>"><button type="button" class="btn btn-block btn-danger btn-xs" style="width:50px;float:left" onclick="return confirmDelete();">Delete</button></a>
                            </td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->

<?php
include "../main/footer.php";
?>