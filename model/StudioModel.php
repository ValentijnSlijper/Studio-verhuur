<?php

function getAllStudios(){
  try {
    $conn = openDatabaseConnection();
    $stmt = $conn->prepare("SELECT * FROM studios");
    $stmt->execute();
    $result = $stmt->fetchAll();
  }
    catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
  }

    $conn = null;

    return $result;
}

function studioDetails($id){
  try {
    $conn = openDatabaseConnection();
    $stmt = $conn->prepare("SELECT * FROM studios WHERE id=:id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $result = $stmt->fetch();
  }
    catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
  }

    $conn = null;

    return $result;

}