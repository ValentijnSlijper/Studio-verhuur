<?php

function readReservations(){
  try {
    $conn = openDatabaseConnection();
    $stmt = $conn->prepare("SELECT * FROM reservations");
    $stmt->execute();
    $result = $stmt->fetchAll();
  }
    catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
  }

    $conn = null;

    return $result;
}

function selectReservation($id){
  try {
    $conn = openDatabaseConnection();
    $stmt = $conn->prepare("
    	SELECT s.description ,r.id, s.name AS studio, s.img AS studioimg, u.name AS user, r.price, r.starttime, r.endtime, i.name AS instrument, i.img AS instrumentimg
    	FROM reservations r
    	JOIN instruments i ON i.id = r.instruments
    	JOIN studios s ON r.studio = s.id
    	JOIN users u ON r.user = u.id
    	WHERE r.id = :id"
    );
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
