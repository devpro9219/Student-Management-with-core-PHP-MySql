<?php
include "../main/header.php";
require_once("../../controller/academic/assigntrainer.php");
require_once('../../settings/params.php');

$vc = new assigntrainer();
if(isset($_GET['asstran_id']))
    $vc->deleteAssignTrainer($_GET['asstran_id']);

$list = $vc->getAllAssignTrainers();
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
                            <a href="AssignTrainer_entry.php"> <button type="button" class="btn btn-block btn-primary" style="width:200px">Assign Trainer</button> </a>
                        </div>
                    </div>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>SL</th>
                            <th>Training Name</th>
                            <th>Training Description</th>
                            <th>Trainer</th>
                            <th>Action</th>
                        </tr>
                        <?php $i = 1; foreach($list as $ass_trainer) { ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?PHP echo $ass_trainer[TRAINING_NAME]; ?>
                            <td><?php echo $ass_trainer[TRAINING_DESCRIPTION]; ?></td>
                            <td><?PHP echo $ass_trainer[EMPLOYEE_NAME]; ?>
                            <td>
                                <a href="AssignTrainer_entry.php?asstran_id=<?php echo $ass_trainer[ID];?>"><button type="button" class="btn btn-block btn-info btn-xs" style="width:50px;float:left">Edit</button></a>
                                <a href="AssignTrainer.php?asstran_id=<?php echo $ass_trainer[ID];?>"><button type="button" class="btn btn-block btn-danger btn-xs" style="width:50px;float:left" onclick="return confirmDelete();">Delete</button></a>
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
<script type="text/javascript" src="../../resource/js/assigntrainer.js"></script>

<?php
include "../main/footer.php";
?>