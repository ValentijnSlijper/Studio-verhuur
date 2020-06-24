<?php

function readInstruments(){
	$conn = openDatabaseConnection();

	$stmt = $conn->prepare("SELECT name, img, price FROM instruments");
	$stmt->bindParam(":mail", $mail);
	$stmt->execute();
	
	$data = $stmt->fetchAll();

	return $data;
}