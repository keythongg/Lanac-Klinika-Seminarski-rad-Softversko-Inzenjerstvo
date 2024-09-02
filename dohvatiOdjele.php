<?php
header('Content-Type: application/json');

require_once 'connection.php';
require_once 'Departments.php';


$departments = new Departments($con);

$departmentList = $departments->getAllDepartments();



echo json_encode($departmentList);
?>
