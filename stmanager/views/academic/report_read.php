<?php
include "../main/header.php";
require_once "../../controller/academic/report.php";

$vc = new report();
if(!isset($_REQUEST['rp_id'])){
    echo 'Request Not Find';
}
$now = $vc->getreportById($_REQUEST['rp_id']);
$show_str = '<b>Reporter:</b>'.$now['student']['stu_name'].' '.$now['student']['stu_surname'].'</br> <b>Course</b>:'.$now['student']['course_name'];


?>
<section class="content">
    <div class="row">
        <div class="col-md-3">
            <a href="report.php" class="btn btn-primary btn-block margin-bottom">Compose</a>

            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Folders</h3>

                    <div class="box-tools">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body no-padding">
                    <ul class="nav nav-pills nav-stacked">
                        <li class="active"><a href="report.php"><i class="fa fa-inbox"></i> Report List</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Report Detail</h3>
                </div>
                <div class="box-body no-padding">
                    <div class="mailbox-read-info">
                        <h3>Title: <?php echo $now['rp_title']; ?></h3>
                    </div>
                    <div class="mailbox-read-info">
                        <h5><?php echo $show_str; ?>
                            <span class="mailbox-read-time pull-right"><?php echo $now['rp_date']; ?></span></h5>
                    </div>
                </div>

                <div class="box-footer">
                    <ul class="mailbox-attachments clearfix">
                        <?php if($now['rp_url'] != ''){ ?>
                            <div class="form-group" onclick="window.open('<?php echo RPT_PATH.$now['rp_url']; ?>')">
                                <div class="btn btn-default btn-file">
                                    <i class="fa fa-paperclip"></i>
                                    <a ><?php echo $now['rp_url']; ?></a>
                                </div>
                            </div>
                        <?php } ?>
                    </ul>
                </div>
                <div class="box-footer">
                </div>
            </div>
        </div>
    </div>
</section>
<?php
include "../main/footer.php";
?>