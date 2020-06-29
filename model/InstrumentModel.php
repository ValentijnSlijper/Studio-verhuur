<?php

function readInstruments(){
	$conn = openDatabaseConnection();

	$stmt = $conn->prepare("SELECT name, img, price FROM instruments");
	$stmt->execute();
	
	$data = $stmt->fetchAll();

	return $data;
}

function filterInstrument($name){
	$conn = openDatabaseConnection();

	$stmt = $conn->prepare("SELECT name, img, price FROM instruments WHERE name = :name");
	$stmt->bindParam(':name', $name);
	$stmt->execute();
	
	$data = $stmt->fetch();

	return $data;
}