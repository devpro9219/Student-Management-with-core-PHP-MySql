<?php
include "../main/header.php";
require_once "../../controller/navigation/message.php";

$vc = new message();
if(isset($_REQUEST['send_to'])){
    if($_REQUEST['subject'] != '' && $_REQUEST['description'] != ''){
        $attachment = $_FILES['attachment']['tmp_name'];
        $src = MSG_PATH.$_FILES['attachment']['name'];
        $i = 0;
        $attachment_file = $_FILES['attachment']['name'];
        if(file_exists($src)){
            while(file_exists($src)){
                $i++;
                $src = MSG_PATH.$i.'-'.$_FILES['attachment']['name'];
                $attachment_file = $i.'-'.$_FILES['attachment']['name'];
            }
        }

        if(is_uploaded_file($attachment))
            move_uploaded_file($_FILES['attachment']['tmp_name'],$src);
        else
            $attachment_file = '';
        $vc->save_message($_REQUEST['send_to'],$_REQUEST['subject'] ,$_REQUEST['description'],$attachment_file);
    }
}
?>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-3">
            <a href="message.php" class="btn btn-primary btn-block margin-bottom">Back to Inbox</a>

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
                        <li><a href="message.php"><i class="fa fa-inbox"></i> Inbox
                            </a></li>
                        <li><a href="message_send.php"><i class="fa fa-envelope-o"></i> Sent </a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="box box-primary">
                <form action="message_entry.php" enctype="multipart/form-data" method="post" accept-charset="utf-8">

                    <div class="box-header with-border">
                        <h3 class="box-title">Compose New Message</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label>To</label>
                            <select class="form-control select2" style="width: 100%;" name="send_to" required>
                            <?php $list = $vc->getUser();
                                for($i=0;$i<count($list);$i++){
                            ?>
                                <option value="<?php echo $list[$i]['_id']; ?>"><?php echo $list[$i]['user_email']; ?></option>
                            <?php } ?>
                            </select>
                            <span class="help-block" style="color:#F00"></span>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Subject:" name="subject" required>
                            <span class="help-block" style="color:#F00"></span>
                        </div>
                        <div class="form-group">
                            <textarea id="mail_info" class="form-control" style="height: 300px" name="description" required></textarea>
                            <span class="help-block" style="color:#F00"></span>
                        </div>
                        <div class="form-group">
                            <div class="btn btn-default btn-file">
                                <i class="fa fa-paperclip"></i> Attachment
                                <input type="file" name="attachment">
                            </div>
                            <p class="help-block">Max. 32MB</p>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="pull-right">
                            <button type="submit" class="btn btn-primary" name="submit"><i class="fa fa-envelope-o"></i> Send</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
<script lang="text/javascript" src="../../resource/js/message_entry.js"></script>
<?php
include "../main/footer.php";
?>