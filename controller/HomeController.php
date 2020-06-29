<?php

require(ROOT . "model/StudioModel.php");
require(ROOT . "model/ReservationModel.php");
require(ROOT . "model/SessionModel.php");
require(ROOT . "model/UserModel.php");
require(ROOT . "model/InstrumentModel.php");


function index(){

	render('index', array(
		'reservations' => readReservations(),
		'session' => readSession(),
		'user' => selectUser(),
		'users' => readUsernames(),
		'studios' => getAllStudios(),
		'instruments' => readInstruments()
	));
}

function studios(){

    render('studios', array(
		'reservations' => readReservations(),
		'session' => readSession(),
		'user' => selectUser(),
		'users' => readUsernames(),
		'studios' => getAllStudios(),
		'instruments' => readInstruments()
	));
}

function reservations(){
	render('reservations', array(
		'reservations' => readReservations(),
		'session' => readSession(),
		'user' => selectUser(),
		'users' => readUsernames(),
		'studios' => getAllStudios(),
		'instruments' => readInstruments()
	));
}

function profile(){
	render('profile', array(
		'session' => readSession(),
		'user' => selectUser()
	));
}


?>