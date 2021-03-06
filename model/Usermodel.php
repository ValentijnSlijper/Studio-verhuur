<?php

// session starten voor het getten en setten van variabelen
session_start();

function createUser($name, $password, $mail){
	try{
		$conn = openDatabaseConnection();

		$stmt = $conn->prepare("INSERT INTO users (name, password, mail) VALUES (:name, :password, :mail)");
		$stmt->bindParam(":name", $name);
		$stmt->bindParam(":password", $password);
		$stmt->bindParam(":mail", $mail);
		$stmt->execute();

		$_SESSION['login'] = true;
		$_SESSION['name'] = $data['name'];
		$_SESSION['mail'] = $mail;

	}
		catch(PDOException $e){
		echo "Connection failed: " . $e->getMessage();
	}

	$conn = null;
}

function loginUser($mail, $password){

	$conn = openDatabaseConnection();

	$stmt = $conn->prepare("SELECT * FROM users WHERE mail = :mail");
	$stmt->bindParam(":mail", $mail);
	$stmt->execute();

	$data = $stmt->fetch();

	// als er geen rows gevonden zijn
	if (!$data) {
		return 'No user found with this email';
	}

	// als de passwords niet matchen
	else if(!password_verify($password, $data['password'])) {
		return 'You have entered the wrong password';
	}

	// als alles klopt
	else{
		$_SESSION['login'] = true;
		$_SESSION['name'] = $data['name'];
		$_SESSION['mail'] = $mail;
		return 'success';
	}
}

function selectUser(){
	try{
		$conn = openDatabaseConnection();

		if (!isset($_SESSION['mail'])){
			$mail = 'remynijsten@hotmail.com';
		}else{
			$mail = $_SESSION['mail'];
		}

		$stmt = $conn->prepare("SELECT id, name, mail FROM users WHERE mail = :mail");
		$stmt->bindParam(":mail", $mail);
		$stmt->execute();
		$result = $stmt->fetch();
	}
	
	catch(PDOException $e){
		echo "Connection failed: " . $e->getMessage();
	}

	$conn = null;

	return $result;
}


function updateUser($data){

	$id = $data['id'];
	$name = $data['name'];
	$mail = $data['mail'];
	$password = $data['password'];
	

	try{
		$conn = openDatabaseConnection();

		$stmt = $conn->prepare("UPDATE users SET name = :name, mail=:mail WHERE id = :id");
		$stmt->bindParam(":name", $name);
		$stmt->bindParam(":mail", $mail);
		$stmt->bindParam(":id", $id);
		$stmt->execute();

		$_SESSION['name'] = $name;
		$_SESSION['mail'] = $mail;

		if($password != ""){
			$stmt = $conn->prepare("UPDATE users SET password = :password WHERE id = :id");
			$stmt->bindParam(":id", $id);
			$stmt->bindParam(":password", $password);
			$stmt->execute();		
		}
	}
	
	catch(PDOException $e){
		echo "Connection failed: " . $e->getMessage();
	}

	$conn = null;

	return $result;
}

function deleteUser($id){
	
	$conn = openDatabaseConnection();

	$stmt = $conn->prepare("DELETE FROM users WHERE id = :id");
	$stmt->bindParam(":id", $id);
	$stmt->execute();

	$stmt = $conn->prepare("DELETE FROM reservations WHERE user = :id");
	$stmt->bindParam(":id", $id);
	$stmt->execute();

}

function readUsernames(){
	$conn = openDatabaseConnection();

	$stmt = $conn->prepare("SELECT id, name FROM users");
	$stmt->bindParam(":mail", $mail);
	$stmt->execute();
	
	$data = $stmt->fetchAll();

	return $data;
}

function duplicateUser($mail){
	$conn = openDatabaseConnection();

	$stmt = $conn->prepare("SELECT * FROM users WHERE mail = :mail");
	$stmt->bindParam(":mail", $mail);
	$stmt->execute();
	
	$data = $stmt->fetchAll();

	if ($data) {
	    return true;
	}
}