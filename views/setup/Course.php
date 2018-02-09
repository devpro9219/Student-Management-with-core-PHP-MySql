<?php
include "../main/header.php";
require_once "../../controller/setup/Course.php";

$vc = new Course();

if(isset($_GET['cur_id']))
    if(!$vc->deleteCourse($_GET['cur_id']))
        echo "<div class='alert alert-danger'>You can not <b>Delete</b> this course Because it had students or trainings</div>";

$courseList = $vc->getAllCourses();
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
                            <a href="Course_entry.php"> <button type="button" class="btn btn-block btn-primary" style="width:200px">New Course</button> </a>
                        </div>
                    </div>
                </div>

                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>SL</th>
                                <th>Course Name</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                            <?php for($i=0; $i<count($courseList); $i++){ $course = $courseList[$i];?>
                                <tr>
                                    <td><?php echo $i+1; ?></td>
                                    <td><?php echo $course[COURSE_NAME]; ?></td>
                                    <td><?php echo $course[COURSE_DESCRIPTION]; ?></td>
                                    <td>
                                        <a href="Course_entry.php?cur_id=<?php echo $course[ID];?>"><button type="button" class="btn btn-block btn-info btn-xs" style="width:50px;float:left">Edit</button></a>
                                        <a href="Course.php?cur_id=<?php echo $course[ID];?>"><button btn_delete type="button" class="btn btn-block btn-danger btn-xs" style="width:50px;float:left" >Delete</button></a>
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
<script type="text/javascript" src="../../resource/js/course.js"></script>

<?php
include "../main/footer.php";
?>
