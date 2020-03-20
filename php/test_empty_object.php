<?php
error_reporting(E_ALL|E_STRICT);
ini_set('display_errors', 1);

$courses = array();

$course = new stdClass();
$course->course_id = 1;
$course->title = "First course";
$course->description = "the most difficult of courses";
		
$courses[]=$course;

$course->course_id = 2;
$course->title = "Second course";
$course->description = "easiest of courses";

$courses[]=$course;

echo "<pre>";
print_r( $courses );
echo "</pre>";


?>
