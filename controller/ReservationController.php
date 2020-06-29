<?php

require(ROOT . "model/StudioModel.php");
require(ROOT . "model/ReservationModel.php");
require(ROOT . "model/SessionModel.php");
require(ROOT . "model/UserModel.php");
require(ROOT . "model/InstrumentModel.php");

function detail($id){
	render('reservationdetail', array(
        'reservation' => selectReservation($id),
        'reservations' => readReservations(),
		'session' => readSession(),
		'user' => selectUser(),
		'users' => readUsernames(),
		'studios' => getAllStudios(),
		'instruments' => readInstruments()
    ));
}

function delete($id){
	deleteReservation($id);
}

function create(){
	createReservation($_POST['data']);
}

function update(){
	updateReservation($_POST['data']);
}

function price(){

	$starttime = intval($_POST['data']['starttime']);
	$endtime = intval($_POST['data']['endtime']);
	$studio = $_POST['data']['studio'];

	$totaltime = $endtime - $starttime;

	$studioprice = intval(studioDetails($studio)['price']);

	$_SESSION['price'] = $totaltime * $studioprice;

	if(isset($_POST['data']['instrument'])){
		$instrumentprice = intval(filterInstrument($_POST['data']['instrument'])['price']);

		$_SESSION['price'] = $_SESSION['price'] + ($totaltime * $instrumentprice);

	}

	echo $_SESSION['price'];

}