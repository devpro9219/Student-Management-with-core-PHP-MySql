<?php
include "../main/header.php";
require_once "../../controller/navigation/message.php";

$vc = new message();
$list = $vc->getReceiverMessage();
?>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-3">
            <a href="message_entry.php" class="btn btn-primary btn-block margin-bottom">Compose</a>

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
                    <h3 class="box-title">Inbox</h3>


                </div>
                <div class="box-body no-padding">
                    <div class="mailbox-controls">
                        <div class="btn-group">
                        </div>
                        <a href="message.php"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button></a>
                        <div class="pull-right">
                        </div>
                    </div>
                    <div class="table-responsive mailbox-messages">
                        <table class="table table-hover table-striped">
                            <tbody>
                            <?php for($i=0;$i<count($list);$i++){ $now = $list[$i]; ?>
                            <tr>
                                <td class="mailbox-star"><a href="message_read.php?msg_id=<?php echo $now['_id']; ?>"><i class="fa  fa-comments"></i> </a></td>
                                <td class="mailbox-name"><a href="message_read.php?msg_id=<?php echo $now['_id']; ?>"><?php echo $now['ps_name']; ?></a></td>
                                <td width="50%" class="mailbox-subject"><?php echo substr($now['msg_title'],0,15).'...'; ?>
                                </td>
                                <td class="mailbox-attachment"><?php if($now['attachment'] != '') echo '<i class="fa fa-paperclip"></i>'; ?></td>
                                <td class="mailbox-attachment"><?php echo $now['msg_date']; ?></td>
                            </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->

<?php
include "../main/footer.php";
?>