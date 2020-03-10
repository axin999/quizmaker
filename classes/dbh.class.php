<?php
namespace Core;
use \PDO;
use \PDOException;
class Dbh{
	private $host = "localhost";
	private $user = "engelbert";
	private $password = "131313";
	private $dbName = "quiz_maker";

	protected function connect(){
		$dsn = 'mysql:host='.$this->host.';dbname='.$this->dbName;
		$pdo = new PDO($dsn,$this->user,$this->password);
		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
		return $pdo;
	}
}