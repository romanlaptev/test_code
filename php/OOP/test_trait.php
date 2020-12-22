<?php
//(PHP 5 >= 5.4.0)
//https://www.php.net/manual/ru/language.oop5.traits.php
//https://www.youtube.com/watch?v=UKO281qhhKQ

trait BaseModel {

	public $sql;

	public function executeSql() {
		return $this->sql;
	}

}//end trait

class Article {
	use BaseModel;

	public function setSql() {
		$this->sql = "SELECT * FROM arcticles";
	}

}//end class

class User {
	use BaseModel;

	public function setSql() {
		$this->sql = "SELECT * FROM users";
	}

}//end class

$articles = new Article();
$articles->setSql();
echo $articles->executeSql()."<br/>\n";

$users = new User();
$users->setSql();
echo $users->executeSql()."<br/>\n";

?>
