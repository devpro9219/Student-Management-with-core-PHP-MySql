<?php
include "../main/header.php";
require_once "../../controller/setup/Student.php";
$vc = new Student();
$stu_now = array();
if(isset($_GET['stu_id'])){
    $action_status = 'update';
    $stu_id = $_REQUEST['stu_id'];
    if(!$stu_now = $vc->getByStudentId($stu_id)){
        echo 'Server Not Found';
        exit();
    }
}else{
    echo 'Server Not Found';
    exit();
}

?>
<section class="content">

    <div class="row">
        <div class="col-md-3">

            <div class="box box-primary">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="<?php echo RES_PATH.$stu_now['stu_img']; ?>" alt="User profile picture">
                    <h3 class="profile-username text-center"><?php echo $stu_now['stu_name'].' '.$stu_now['stu_surname']; ?></h3>
                    <p class="text-muted text-center"></p>
                </div>
            </div>

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">About</h3>
                </div>
                <div class="box-body">

                    <strong><i class="fa fa-user margin-r-5"></i> <a href="#">student</a> ID</strong>
                    <p class="text-muted"><?php echo $stu_now['user_name']; ?></p>

                    <strong><i class="fa fa-phone margin-r-5"></i> Contact No</strong>
                    <p class="text-muted"><?php echo $stu_now['stu_connum']; ?></p>

                    <strong><i class="fa fa-envelope margin-r-5"></i> Email</strong>
                    <p class="text-muted"><?php echo $stu_now['user_email']; ?></p>

                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#activity" data-toggle="tab">Activity</a></li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                        <div class="post">
                            <p>
                                Birth Date:<?php echo $stu_now['stu_birth']; ?></p>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<?php include "../main/footer.php"; ?>