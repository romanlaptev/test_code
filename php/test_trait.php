//(PHP 5 >= 5.4.0)
//https://www.php.net/manual/ru/language.oop5.traits.php
<?php

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
