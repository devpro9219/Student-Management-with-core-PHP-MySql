<?php
include "../main/header.php";
require_once "../../controller/setup/SchoolInformation.php";
$vc = new SchoolInformation();
$school = $vc->getSchool();
?>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-3">
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <a href="SchoolInformation_entry.php"><button type="button" class="btn btn-block btn-primary" style="width:200px;float:left">Edit School Information</button></a>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="<?php echo RES_PATH.$school[ORGANIZATION_LOGO]; ?>" alt="Logo" width="100px" height="100px">
                    <h3 class="profile-username text-center">Ecole Management System</h3>
                    <p class="text-muted text-center"><?php echo $school[ORGANIZATION_NAME]; ?></p>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Contact Information</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <strong><i class="fa fa-phone margin-r-5"></i> Contact No</strong>
                    <p class="text-muted"><?php echo $school[ORGANIZATION_CONNUM]; ?></p>
                    <strong><i class="fa fa-envelope margin-r-5"></i> Email</strong>
                    <p class="text-muted"><?php echo $school[ORGANIZATION_EMAIL]; ?></p>
                    <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>
                    <p class="text-muted"><?php echo $school[ORGANIZATION_ADDRESS]; ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#activity" data-toggle="tab">About School</a></li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                        <div class="post">
                            <p><?php echo $school[ORGANIZATION_ABOUT]; ?></p>
                        </div>
                    </div>
                    <div class="tab-pane" id="settings">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include "../main/footer.php";
?>
