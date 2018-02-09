<?php
include "../main/header.php";
require_once "../../controller/navigation/message.php";

$vc = new message();
if(!isset($_REQUEST['msg_id'])){
    echo 'Request Not Find';
}
$now = $vc->getMessageById($_REQUEST['msg_id']);
$show_str = 'To:'.$now['to_email'];
if($now['msg_from'] != $_SESSION['userId']){
    $show_str = 'From:'.$now['from_email'];
}
?>
<section class="content">
    <div class="row">
        <div class="col-md-3">
            <a href="message.php" class="btn btn-primary btn-block margin-bottom">Compose</a>

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
                        <li class="active"><a href="message.php"><i class="fa fa-inbox"></i> Inbox
                            </a></li>
                        <li><a href="message_send.php"><i class="fa fa-envelope-o"></i> Sent </a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Read Mail</h3>

                    <div class="box-tools pull-right">
                        <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Previous"><i class="fa fa-chevron-left"></i></a>
                        <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Next"><i class="fa fa-chevron-right"></i></a>
                    </div>
                </div>
                <div class="box-body no-padding">
                    <div class="mailbox-read-info">
                        <h3><?php echo $now['msg_title']; ?></h3>
                        <h5><?php echo $show_str; ?>
                            <span class="mailbox-read-time pull-right"><?php echo $now['msg_date']; ?></span></h5>
                    </div>
                    <div class="mailbox-controls with-border text-center">
                    </div>
                    <div class="mailbox-read-message">
                        <?php echo $now['msg_note']; ?>
                    </div>
                </div>

                <div class="box-footer">
                    <ul class="mailbox-attachments clearfix">
                        <?php if($now['attachment'] != ''){ ?>
                            <div class="form-group" onclick="window.open('<?php echo MSG_PATH.$now['attachment']; ?>')">
                                <div class="btn btn-default btn-file">
                                    <i class="fa fa-paperclip"></i>
                                    <a ><?php echo $now['attachment']; ?></a>
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