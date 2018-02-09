<?php
define('RES_PATH','../../resource/image/person/');
define('MSG_PATH','../../resource/message/');
define('RPT_PATH','../../resource/report/');
session_start();
if(!isset($_SESSION['psId']))
    echo '<script>location.href="../../views/special/login.php";</script>';
include "../../settings/settings.php";
require_once "../../controller/special/common.php";
$vc = new common();
$emp_now = array();
$nowImg = $nowName = '';
$ps_id = $_SESSION['psId'];

if($_SESSION['userType'] == 0) {
    if (!$emp_now = $vc->getByEmpId($ps_id)) {
        echo 'Serve Not Found';
        exit();
    }
    $nowImg = $emp_now['emp_img'];
    $nowName = $emp_now['emp_name'];
}else{
    if (!$emp_now = $vc->getBySt($ps_id)) {
        echo 'Serve Not Found';
        exit();
    }
    $nowImg = $emp_now['stu_img'];
    $nowName = $emp_now['stu_name'];
}

?>
<!DOCTYPE html>


<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php $cfg_homepageTitle; ?></title>

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="../../resource/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

    <link rel="stylesheet" href="../../resource/dist/css/AdminLTE.min.css">

    <link rel="stylesheet" href="../../resource/dist/css/skins/skin-blue.min.css">

    <link rel="stylesheet" href="../../resource/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <link rel="stylesheet" href="../../resource/plugins/datatables/dataTables.bootstrap.css">

    <script src="../../resource/plugins/jQuery/jquery-2.2.3.min.js"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="../../resource/bootstrap/js/bootstrap.min.js"></script>

    <!-- jQuery 2.2.3 -->


    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <script src="../../resource/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <script src="../../resource/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../resource/plugins/datatables/dataTables.bootstrap.min.js"></script>

</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

        <!-- Logo -->
        <a href="index2.html" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><?php echo $cfg_homepageMinTitle; ?></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><?php echo $cfg_homepageTitle; ?></span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->

                    <!-- /.messages-menu -->

                    <!-- Notifications Menu -->
                    <!-- Tasks Menu -->

                    <!-- User Account Menu -->
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            <img src="<?php echo RES_PATH.$nowImg;?>" class="user-image" alt="User Image">
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs"><?php echo $nowName;?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                                <img src="<?php echo RES_PATH.$nowImg;?>" class="img-circle" alt="User Image">

                                <p>
                                    <?php echo $nowName ?>

                                </p>
                            </li>
                            <!-- Menu Body -->

                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <?php if($_SESSION['userType'] == 0) {
                                        echo '<a href="../../views/setup/EmployeeInformation_detail.php?emp_id='.$_SESSION['psId'].'" class="btn btn-default btn-flat">Profile</a>';
                                    }else{
                                        echo '<a href="../../views/setup/Student_detail?stu_id='.$_SESSION['psId'].'" class="btn btn-default btn-flat">Profile</a>';
                                    } ?>

                                </div>
                                <div class="pull-right">
                                    <a href="../special/login.php" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

            <!-- Sidebar user panel (optional) -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="<?php echo RES_PATH.$nowImg;?>" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p><?php echo $nowName;?></p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <?php
                $urltmp =  explode('/', $_SERVER['REQUEST_URI']);
                $titleTemp = $urltmp[count($urltmp)-1];
                $subUrl = explode('?', $titleTemp);
                $subUrl = explode('.', $subUrl[0]);
                $subUrl = explode('_', $subUrl[0]);
                $nowTitle = $subUrl[0];
                $mainTitle = 'MAIN NAVIGATION';
                $header_info = array('MAIN NAVIGATION'=>array('home'=>array('url'=>'../navigation/home.php'),
                                                              'message'=>array('url'=>'../navigation/message.php')),
                                     'Setup'=>array('School Information'=>array('url'=>'../setup/SchoolInformation.php'),
                                                    'Employee Information'=>array('url'=>'../setup/EmployeeInformation.php'),
                                                    'Course'=>array('url'=>'../setup/Course.php'),
                                                    'Training'=>array('url'=>'../setup/Training.php'),
                                                    'Student'=>array('url'=>'../setup/Student.php')),
                                     'Academic'=>array('Assign Trainer'=>array('url'=>'../academic/AssignTrainer.php'),
                                                        'Enroll Training'=>array('url'=>'../academic/EnrollTraining.php'),
                                                        'Report'=>array('url'=>'../academic/Report.php')));
            ?>
            <ul class="sidebar-menu">
            <?php foreach ($header_info as $mainKey => $headerMain) {?>
                <li class="header"><?php echo $mainKey; ?></li>
                <?php foreach($headerMain as $subKey=>$headerSub){
                    if(strtolower($subKey) == strtolower($nowTitle)){
                        $nowTitle = $subKey;
                        $mainTitle = $mainKey;
                        echo '<li class="active"><a href="'.$headerSub['url'].'"><i class="fa fa-folder"></i> <span>'.$subKey.'</span></a></li>';
                    }else{
                        echo '<li><a href="'.$headerSub['url'].'"><i class="fa fa-folder"></i> <span>'.$subKey.'</span></a></li>';
                    }
                }?>
            <?php }?>
            </ul>
            <!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
    </aside>
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?php echo $nowTitle; ?>
        </h1>
        <!--ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-folder"></i> <?php echo $mainTitle ?></a></li>
            <li class="active"><?php echo $nowTitle; ?></li>
        </ol-->
    </section>
    <script type="text/javascript" src="../../resource/js/common.js"></script>