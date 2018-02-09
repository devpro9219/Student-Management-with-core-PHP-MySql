<?php
include "../main/header.php";
require_once "../../controller/academic/report.php";

$vc = new report();
if(isset($_REQUEST['send_from'])){
    if($_REQUEST['subject'] != ''){
        $attachment = $_FILES['attachment']['tmp_name'];
        $src = RPT_PATH.$_FILES['attachment']['name'];
        $i = 0;
        $attachment_file = $_FILES['attachment']['name'];
        if(file_exists($src)){
            while(file_exists($src)){
                $i++;
                $src = RPT_PATH.$i.'-'.$_FILES['attachment']['name'];
                $attachment_file = $i.'-'.$_FILES['attachment']['name'];
            }
        }

        if(is_uploaded_file($attachment))
            move_uploaded_file($_FILES['attachment']['tmp_name'],$src);
        $vc->save_report($_REQUEST['send_from'],$_REQUEST['subject'],$attachment_file);
    }
}
?>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-3">
            <a href="report.php" class="btn btn-primary btn-block margin-bottom">Back to List</a>

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
                        <li><a href="report.php"><i class="fa fa-inbox"></i> Report List</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="box box-primary">
                <form action="report_entry.php" enctype="multipart/form-data" method="post" accept-charset="utf-8">

                    <div class="box-header with-border">
                        <h3 class="box-title">Compose New report</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label>From(student):</label>
                            <select class="form-control select2" style="width: 100%;" name="send_from" required>
                            <?php $list = $vc->getStudent();
                                for($i=0;$i<count($list);$i++){
                            ?>
                                <option value="<?php echo $list[$i]['_id']; ?>"><?php echo $list[$i]['stu_name']; ?></option>
                            <?php } ?>
                            </select>
                            <span class="help-block" style="color:#F00"></span>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Subject:" name="subject" required>
                            <span class="help-block" style="color:#F00"></span>
                        </div>
                        <div class="form-group">
                            <div class="btn btn-default btn-file">
                                <i class="fa fa-paperclip"></i> Report File
                                <input type="file" name="attachment">
                            </div>
                            <p class="help-block">Max. 32MB</p>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="pull-right">
                            <button type="submit" class="btn btn-primary" name="submit"><i class="fa fa-envelope-o"></i> Report</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
<script lang="text/javascript" src="../../resource/js/report_entry.js"></script>
<?php
include "../main/footer.php";
?>