<?php
require_once("../../controller/academic/enrolltraining.php");

$vc = new enrolltraining();
$course_id = $_REQUEST['course_id'];
$studentList = $vc->getStudentListByCourse($course_id);
$trainingList = $vc->getTrainingListByCourse($course_id);
echo json_encode(array('student' => $studentList,'training' => $trainingList));
?>