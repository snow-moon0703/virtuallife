<?php
	$host = 'localhost';
	$port = '3306';
	$name = 'virtuallife';
	$user = 'user1';
	$pass = 'Axcf4268';
	$charset = 'utf8';
	try{
		$pdo = new PDO("mysql:host=$host;dbname=$name;charset=$charset", $user, $pass);

	}catch(PDOException $e){
		 echo "Error: " . $e->getMessage();
	}

	function close(){
		$pdo = null;
	}

?>