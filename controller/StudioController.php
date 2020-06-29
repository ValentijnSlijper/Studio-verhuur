<?php

require(ROOT . "model/StudioModel.php");
require(ROOT . "model/ReservationModel.php");
require(ROOT . "model/SessionModel.php");
require(ROOT . "model/UserModel.php");
require(ROOT . "model/InstrumentModel.php");

function detail($id){
	render('studiodetails', array(
		'reservations' => readReservations(),
        'studio' => studioDetails($id),
        'session' => readSession(),
		'users' => readUsernames(),
		'studios' => getAllStudios(),
		'instruments' => readInstruments(),
		'user' => selectUser()
	));
}
		
