<?php
include "../main/header.php";
require_once "../../controller/setup/Student.php";

$vc = new Student();

if(isset($_GET['stu_id'])){
    $stu_id = $_GET['stu_id'];
    if(!$vc->deleteStudent($stu_id))
        echo "<div class='alert alert-danger'>You can not <b>Delete</b> this Student Because he had enrolled in training</div>";
}
$studentList = $vc->getAllStudent();
?>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">

            <div class="box">
                <div class="box-header">
                    <div class="input-group input-group-sm" style="float:left; margin-left:-4px;">
                        <a href="Student_entry.php"> <button type="button" class="btn btn-block btn-primary" style="width:200px">New Student</button> </a>
                    </div>
                </div>
                <div class="box-body">
                    <table id="student_list" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>SL</th>
                            <th>Course</th>
                            <th>Full Name</th>
                            <th>Contact Number</th>
                            <th>Gender</th>
                            <th>Email</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; foreach($studentList as $student) { ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $student['course_name']; ?></td>
                                <td><?php echo $student[STUDENT_NAME]; ?></td>
                                <td><?php echo $student[STUDENT_CONNUM]; ?></td>
                                <td><?php if($student[STUDENT_GENDER] == 0) echo "MALE"; else echo "FEMALE"; ?></td>
                                <td><?php echo $student[USER_EMAIL]; ?></td>
                                <td><img class="img-responsive" src="<?php echo RES_PATH.$student[STUDENT_IMG];?>" alt="Image" style="width:60px; height:60px"></td>
                                <?php if($student[STUDENT_STATUS] == 1) {
                                    echo '<td><span class="label label-success">Approved</span></td>';
                                } else {
                                    echo '<td><span class="label label-danger">Banned</span></td>';
                                }
                                ?>
                                <td>
                                    <a href="Student_detail.php?stu_id=<?php echo $student[ID];?>"><button type="button" class="btn btn-block btn-info btn-xs" style="width:50px;float:left">Detail</button></a>
                                    <a href="Student_entry.php?stu_id=<?php echo $student[ID];?>"><button type="button" class="btn btn-block btn-info btn-xs" style="width:50px;float:left">Edit</button></a>
                                    <a href="Student.php?stu_id=<?php echo $student[ID];?>"><button btn_delete type="button" class="btn btn-block btn-danger btn-xs" style="width:50px;float:left" >Delete</button></a>
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
<script type="text/javascript" src="../../resource/js/Student.js"></script>

<?php
include "../main/footer.php";
?>