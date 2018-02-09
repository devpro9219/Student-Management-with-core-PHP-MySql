<?php
include "../main/header.php";
require_once("../../controller/setup/SchoolInformation.php");

$vc = new SchoolInformation();
$action_status = 'normal';
$school = array(ORGANIZATION_NAME=>'', ORGANIZATION_CONNUM=>'', ORGANIZATION_EMAIL=>'', ORGANIZATION_ADDRESS=>'', ORGANIZATION_ABOUT=>'', ORGANIZATION_LOGO=>'');

if(isset($_REQUEST['action_status']) && $_REQUEST['action_status'] == 'save') {
    $scho_img = $_FILES['inputSchoolLogo']['tmp_name'];
    $seedRand = rand(1,500)*rand(1,500);
    $src = RES_PATH.$seedRand.".png";
    if(is_uploaded_file($scho_img))
        move_uploaded_file($_FILES['inputSchoolLogo']['tmp_name'], $src);
    $scho_img = $seedRand.'.png';
    $vc->addSchool($_REQUEST['inputSchoolName'], $_REQUEST['inputContactNo'], $_REQUEST['inputEmail'], $_REQUEST['inputAddress'], $_REQUEST['inputAboutSchool'], $scho_img);
    $_REQUEST = array();
    echo '<script>location.href="SchoolInformation.php";</script>';
}

if(isset($_REQUEST['action_status']) && $_REQUEST['action_status'] == 'update'){
    if(!$school = $vc->getSchool()){
        echo 'Server Not Found';
        exit();
    }
    if($_FILES['inputSchoolLogo'])
        $seedRand = rand(1,500)*rand(1,500);
    $src = RES_PATH.$seedRand.".png";
    $scho_img = $seedRand.'.png';
    if(is_uploaded_file($_FILES['inputSchoolLogo']['tmp_name']))
        move_uploaded_file($_FILES['inputSchoolLogo']['tmp_name'], $src);
    else
        $scho_img = $school[ORGANIZATION_LOGO];

    $vc->updateSchool(1, $_REQUEST['inputSchoolName'], $_REQUEST['inputContactNo'], $_REQUEST['inputEmail'], $_REQUEST['inputAddress'], $_REQUEST['inputAboutSchool'], $scho_img);
    echo '<script>location.href="SchoolInformation.php";</script>';
}

if($school = $vc->getSchool()) {
    $action_status = 'update';
} else {
    $action_status = 'normal';
}
?>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header" style="height:65px">
                    <h3 class="box-title"></h3>

                    <div class="col-xs-12" style="padding-top:10px; padding-bottom:10px">
                        <div class="input-group input-group-sm" style="float:left; margin-left:-20px;">
                            <a href="SchoolInformation.php"> <button type="button" class="btn btn-block btn-primary" style="width:200px">School Information</button> </a>
                        </div>
                    </div>

                </div>
                <form action="SchoolInformation_entry.php" id="school_form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                    <input type="hidden" id="action_status" name="action_status" value="<?php echo $action_status; ?>" />
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">School Name<span style="color:#F00"> * </span></label>
                            <div class="col-sm-10">
                                <input type="text" id="inputSchoolName" value="<?php echo $school[ORGANIZATION_NAME]?>" name="inputSchoolName" class="form-control" placeholder="School Name" required autofocus>
                                <span class="help-block" style="color:#F00"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Contact No<span style="color:#F00"> * </span></label>
                            <div class="col-sm-10">
                                <input type="text" id="inputContactNo" value="<?php echo $school[ORGANIZATION_CONNUM]?>" class="form-control" placeholder="Contact No"  name="inputContactNo" value="" required>
                                <span class="help-block" style="color:#F00"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Email<span style="color:#F00"> * </span></label>
                            <div class="col-sm-10">
                                <input type="email" id="inputEmail" value="<?php echo $school[ORGANIZATION_EMAIL]?>" class="form-control" placeholder="Email"  name="inputEmail" value="" required>
                                <span class="help-block" style="color:#F00"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Address<span style="color:#F00"> * </span></label>
                            <div class="col-sm-10">
                                <input type="text" id="inputAddress" value="<?php echo $school[ORGANIZATION_ADDRESS]?>" name="inputAddress" class="form-control" placeholder="Address" value="" required>
                                <span class="help-block" style="color:#F00"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">About School<span style="color:#F00"> * </span></label>
                            <div class="col-sm-10">
                                <input type="text" id="inputAboutSchool" value="<?php echo $school[ORGANIZATION_ABOUT]?>" name="inputAboutSchool" class="form-control" placeholder="Information About School" value="" required>
                                <span class="help-block" style="color:#F00"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Logo</label>
                            <div class="col-sm-10">
                                <input type="file" id="inputSchoolLogo" name="inputSchoolLogo" value="<?php echo RES_PATH.$school[ORGANIZATION_LOGO]; ?>">
                                <span class="help-block" style="color:#F00"></span>
                            </div>
                        </div>

                    </div>
                    <div class="box-footer" style="text-align:center">
                        <button type="submit" class="btn btn-info" id="btn_save">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
<script type="text/javascript" src="../../resource/js/SchoolInformation.js"></script>

<?php
include "../main/footer.php";
?>
