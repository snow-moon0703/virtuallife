<?php 	
include("conn.php");  
	$sql = "SELECT id,title,content,startdate,enddate,image FROM news";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC),JSON_UNESCAPED_UNICODE);
?>