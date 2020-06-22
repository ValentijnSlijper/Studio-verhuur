<?php

require(ROOT . "model/StudioModel.php");
require(ROOT . "model/ReservationModel.php");
require(ROOT . "model/SessionModel.php");

function index(){

	render('index', array(
		'session' => readSession()
	));
}

function studios(){

    render('studios', array(
        'studios' => getAllStudios(),
	    'session' => readSession()
	));
}

function reservations(){
	render('reservations', array(
		'reservations' => readReservations(),
		'session' => readSession()
	));
}



?>