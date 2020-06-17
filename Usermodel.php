<?php

function getAllUsers(){
try {
  $conn = openDatabaseConnection();
  $stmt = $conn->prepare("SELECT * FROM users");
  $stmt->execute();
  $result = $stmt->fetchAll();
}
  catch(PDOException $e){
  echo "Connection failed: " . $e->getMessage();
}
  $conn = null;
  return $result;
}

function createUser($name, $password){
  $conn = openDatabaseConnection();
  $statement = $conn->prepare("INSERT INTO users (name, password) VALUES (:name, :password)");
  $statement->bindParam(":name", $name);
  $statement->bindParam(":password", $password);
  $statement->execute();
 }

 function updateUser($data, $id){
  $conn = openDatabaseConnection();
  $stmt = $conn->prepare("UPDATE users SET name = :name, password = :password where id = :id");
  $stmt->bindParam(":id", $id);
  $stmt->bindParam(":age", $data["age"]);
  $stmt->bindParam(":password", $data["password"]);
  $stmt->execute();  
 }

  function deleteUser($id){
  $conn = openDatabaseConnection();
  $stmt = $conn->prepare("DELETE FROM users WHERE id = :id");
  $stmt->bindParam(":id", $id);
  $stmt->execute();
  $stmt = $conn->prepare("DELETE FROM reservations WHERE id = :id");
  $stmt->bindParam(":id", $id);
  $stmt->execute();
 }

 function infoUser($id){
  $conn = openDatabaseConnection();
  $stmt = $conn->prepare("SELECT FROM users WHERE id = :id");
  $stmt->bindParam(":id", $id);
  $stmt->execute();
  $result = $stmt->fetch();

 }


