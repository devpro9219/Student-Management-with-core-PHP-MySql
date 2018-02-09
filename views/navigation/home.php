<?php
include "../main/header.php";
require_once "../../controller/navigation/home.php";

$vc = new home();
$main = $vc->getMainInfo();
$trainSt = $vc->getTrainSt();
?>

<!-- Main content -->
<section class="content">

    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3><?php echo $main['course'] ?></h3>
                    <p>Total Course</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="../../views/setup/Course.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3><?php echo $main['employee']; ?></h3>
                    <p>Total Trainner</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="../../views/setup/EmployeeInformation.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3><?php echo $main['student']; ?></h3>
                    <p>Total Student</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="../../views/setup/Student.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">

            <div class="small-box bg-red">
                <div class="inner">
                    <h3><?php echo $main['report']; ?></h3>
                    <p>Total Report</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="../../views/academic/report.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>

    <!-- Default box -->
    <!-- /.box -->
    <div class="row">
        <div class="col-md-8">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title">Training Status</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Student</th>
                            <th>Course</th>
                            <th>Train</th>
                            <th>Trainer</th>
                            <th>startDate</th>
                            <th>endDate</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php for($i=0;$i<count($trainSt);$i++){$now = $trainSt[$i]; ?>
                        <tr>
                            <td><?php echo $now['stu_name'].' '.$now['stu_surname']; ?></td>
                            <td><?php echo $now['cur_name']; ?></td>
                            <td><?php echo $now['tran_name']; ?></td>
                            <td><?php echo $now['emp_name'].' '.$now['emp_surname']; ?></td>
                            <td><?php echo $now['startDate']; ?></td>
                            <td><?php echo $now['endDate']; ?></td>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <div class="col-md-4">
            <!-- USERS LIST -->
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Trainer</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <ul class="users-list clearfix">
                        <?php for($i=0;$i<count($main['trainer']);$i++){$now = $main['trainer'][$i]; ?>
                        <li>
                            <img src="<?php echo RES_PATH.$now['emp_img']; ?>" alt="Trainer Image">
                            <a class="users-list-name" href="#"><?php echo $now['emp_name']; ?></a>
                            <span class="users-list-date"><?php echo $now['emp_surname']; ?></span>
                        </li>
                        <?php } ?>
                    </ul>
                    <!-- /.users-list -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                    <a href="../../views/setup/EmployeeInformation.php" class="uppercase">View All Trainer</a>
                </div>
                <!-- /.box-footer -->
            </div>
            <!--/.box -->
        </div>
    </div>
</section>
<!-- /.content -->
    <script>
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    </script>
<?php
include "../main/footer.php";
?>