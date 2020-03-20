<?php
error_reporting(E_ALL|E_STRICT);
ini_set('display_errors', 1);

$courses = array();

$course_a = new stdClass();
$course_a->course_id = 1;
$course_a->title = "First course";
$course_a->description = "the most difficult of courses";
		
$courses[]=$course_a;

$course_b = new stdClass();
$course_b->course_id = 2;
$course_b->title = "Second course";
$course_b->description = "easiest of courses";

$courses[]=$course_b;

echo "<pre>";
print_r( $courses );
echo "</pre>";

//============================ 2
class Course {
	public $course_id;
	public $title;
	public $description;

	public function __construct( $id, $title, $description ){
		$this->course_id = $id;
		$this->title = $title;
		$this->description = $description;
	}
}//end class

$arr2 = array();

$course1 = new Course(1, "First course", "the most difficult of courses....");
$course2 = new Course(2, "Second course", "...easiest of courses");

$arr2[]=$course1;
$arr2[]=$course2;

echo "<pre>";
print_r( $arr2 );
echo "</pre>";

?>
