<?php

require(ROOT . "model/ReservationModel.php");
require(ROOT . "model/SessionModel.php");

function detail($id){
	render('reservationdetail', array(
        'reservation' => selectReservation($id),
		'session' => readSession()
    ));
}
<<<<<<< HEAD

function delete($id){
	deleteReservation($id);
}
=======
function destroy($id){
	deleteReservation($id);

	render('reservations', array(
        'reservation' => deleteReservation($id),
		'session' => readSession()
    ));
}
>>>>>>> master
