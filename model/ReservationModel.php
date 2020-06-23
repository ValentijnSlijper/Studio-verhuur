<?php

function readReservations(){
    try {
        $conn = openDatabaseConnection();
        $stmt = $conn->prepare("SELECT r.id, s.description, s.name AS studio, s.img AS studioimg, u.name AS user, r.price,  r.starttime, r.endtime, i.name AS instrument, i.img AS instrumentimg
        FROM reservations r
        JOIN instruments i ON i.id = r.instruments
        JOIN studios s ON r.studio = s.id
        JOIN users u ON r.user = u.id ");
        $stmt->execute();
        $result = $stmt->fetchAll();
    }
    catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
    }

    $conn = null;

    return $result;
    }

    function deleteReservation($id){
      $conn = openDatabaseConnection();
      $stmt = $conn->prepare("DELETE FROM reservations WHERE id = :id");
      $stmt->bindParam(":id", $id);
      $stmt->execute();
 	    }

function selectReservation($id){
    try {
        $conn = openDatabaseConnection();

        $stmt = $conn->prepare("
<<<<<<< HEAD
        SELECT r.id, s.description, s.name AS studio, s.img AS studioimg, u.name AS user, r.price,  r.starttime, r.endtime, i.name AS instrument, i.img AS instrumentimg 
        FROM reservations r 
        JOIN instruments i ON i.id = r.instruments 
        JOIN studios s ON r.studio = s.id 
        JOIN users u ON r.user = u.id 
=======
        SELECT r.id, s.description, s.name AS studio, s.img AS studioimg, u.name AS user, r.price,  r.starttime, r.endtime, i.name AS instrument, i.img AS instrumentimg
        FROM reservations r
        JOIN instruments i ON i.id = r.instruments
        JOIN studios s ON r.studio = s.id
        JOIN users u ON r.user = u.id
>>>>>>> master
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
<<<<<<< HEAD

function deleteReservation($id){
    try {
        $conn = openDatabaseConnection();

        $stmt = $conn->prepare("DELETE FROM reservations WHERE id = :id");

        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
    catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
    }

    $conn = null;

    return $result;
}
=======
>>>>>>> master
