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

function createReservation($data){

    try {

        $conn = openDatabaseConnection();

        // ophalen van de instrument id aan de hand van de name
        $stmt = $conn->prepare("SELECT id FROM instruments WHERE name = :name");
        $stmt->bindParam(':name', $data['instrument']);
        $stmt->execute();
        $result = $stmt->fetch();

        // toewijzen van variabelen voor de bindParam functie
        $price = $_SESSION['price'];
        $mail = $_SESSION['mail'];
        $studio = $data['studio'];
        $user = $data['name'];
        $starttime = $data['starttime'] . ':00:00';
        $endtime = $data['endtime'] . ':00:00';
        $instruments = $result['id'];

        // insert query voor de reservering
        $stmt = $conn->prepare("INSERT INTO `reservations` (`studio`, `user`, `price`, `starttime`, `endtime`, `instruments`) VALUES (:studio, :user, :price, :starttime, :endtime, :instruments)");
        $stmt->bindParam(':studio', $studio);
        $stmt->bindParam(':user', $user);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':starttime', $starttime);
        $stmt->bindParam(':endtime', $endtime);
        $stmt->bindParam(':instruments', $instruments);
        $stmt->execute();

        // opvragen van het Id uit bovenstaande insert query
        $stmt = $conn->prepare("SELECT id FROM reservations ORDER BY id DESC LIMIT 1");
        $stmt->execute();
        $result = $stmt->fetch();
        $res_id = $result['id'];

        // opvragen van het laatste factuurnummer
        $stmt = $conn->prepare("SELECT invoice FROM invoices ORDER BY invoice DESC LIMIT 1");
        $stmt->execute();
        $result = $stmt->fetch();
        $latest = intval(explode('-', $result['invoice'])[1]) + 1;
        $invoicenum = '2020-' . strval($latest);

        $curdate = date('Y/m/d');
        $mail = $_SESSION['mail'];
        $name = $_SESSION['name'];

        // insert query voor de factuur details
        $stmt = $conn->prepare("INSERT INTO invoices (invoice, reservation, name, mail, curdate) VALUES (:invoice, :reservation, :name, :mail, :curdate)");
        $stmt->bindParam(':invoice', $invoicenum);
        $stmt->bindParam(':reservation', $res_id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':mail', $mail);
        $stmt->bindParam(':curdate', $curdate);
        $stmt->execute();

    }
        catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
    }

    $conn = null;

    return $invoicenum . $res_id;
}

function filterReservations($studio){
    try {
        $conn = openDatabaseConnection();
        $stmt = $conn->prepare("SELECT id, starttime, endtime FROM reservations WHERE studio = :studio");
        $stmt->bindParam(':studio', $studio);
        $stmt->execute();
        $result = $stmt->fetchAll();
    }
    
    catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
    }

    $conn = null;

    return $result;
}

function exceptReservations($studio, $id){
    try {
        $conn = openDatabaseConnection();
        $stmt = $conn->prepare("SELECT id, starttime, endtime FROM reservations WHERE studio = :studio AND NOT id = :id");
        $stmt->bindParam(':studio', $studio);
        $stmt->bindParam(':id', $id);
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
        SELECT r.id, s.description, s.name AS studio, s.img AS studioimg, u.name AS user, r.price,  r.starttime, r.endtime, i.name AS instrument, i.img AS instrumentimg 
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

function updateReservation($data){

    try {

        $conn = openDatabaseConnection();

        $stmt = $conn->prepare("SELECT id FROM instruments WHERE name = :name");
        $stmt->bindParam(':name', $data['instrument']);
        $stmt->execute();
        $result = $stmt->fetch();

        $price = $_SESSION['price'];
        $studio = $data['studio'];
        $user = $data['name'];
        $starttime = $data['starttime'] . ':00:00';
        $endtime = $data['endtime'] . ':00:00';
        $instruments = $result['id'];
        $id = $data['id'];

        $stmt = $conn->prepare("UPDATE `reservations` SET studio=:studio, user=:user, price=:price, starttime=:starttime, endtime=:endtime, instruments=:instruments WHERE id = :id");
        $stmt->bindParam(':studio', $studio);
        $stmt->bindParam(':user', $user);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':starttime', $starttime);
        $stmt->bindParam(':endtime', $endtime);
        $stmt->bindParam(':instruments', $instruments);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
        catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
    }

    $conn = null;

    return $result;
}

function deleteReservation($id){
    try {
        $conn = openDatabaseConnection();

        $stmt = $conn->prepare("DELETE FROM reservations WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $stmt = $conn->prepare("DELETE FROM invoices WHERE reservation = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

    }
    catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
    }

    $conn = null;

    return $result;
}

function readInvoice($id){

    $conn = openDatabaseConnection();
    $stmt = $conn->prepare("SELECT * FROM invoices WHERE reservation = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $result = $stmt->fetch();

    return $result;
}