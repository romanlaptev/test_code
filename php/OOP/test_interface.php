<?php
error_reporting(E_ALL|E_STRICT);
ini_set('display_errors', 1);

//===========================
interface interface1 {
	public function method1();
	public function method2();
}//end

abstract class abstractClass1 {
	abstract public function method1();//realized in children class
	abstract public function method2();
	public function method3(){
		return 5+5;
	}
}//end class

class FirstClass implements interface1{
	private $name;
	private $age;

	function __construct(){
echo "Object of class ".__CLASS__." was created. "."<br>\n";
		$this->name = "Roman";
		$this->age = 44;
	}//end constructor
	
	public function method1(){
		return 1;
	}//end

	public function method2(){
		return 2;
	}//end
	
}//end class

$obj1 = new FirstClass();
echo "OBJ1: <pre>";
print_r( $obj1);
echo "</pre>\n";

//============================

class Class2 implements interface1 {
	public function method1(){
		return 3;
	}//end

	public function method2(){
		return 4;
	}//end
}//end class

$obj2 = new Class2();
echo "OBJ2: <pre>";
print_r( $obj2);
echo "</pre>\n";

//============================

class Class3 extends abstractClass1 {
	public function method1(){
		return 30;
	}//end

	public function method2(){
		return 40;
	}//end
}//end class

$obj3 = new Class3();
echo $obj3->method1();
echo "<br/>\n";

echo $obj3->method2();
echo "<br/>\n";

echo $obj3->method3();
echo "<br/>\n";

?>
