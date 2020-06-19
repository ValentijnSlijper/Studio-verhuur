<?php

require(ROOT . "model/StudioModel.php");
require(ROOT . "model/ReservationModel.php");
require(ROOT . "model/SessionModel.php");


session_start();

function index(){

	render('index', array(
		'session' => readSession()
	));
}

function studios(){

    render('studios', array(
        'studios' => getAllStudios())
    );
}

function users(){
    render('users');
}

function reservations(){
	render('reservations', array(
		'reservations' => readReservations()));
}



?>