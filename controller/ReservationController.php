<?php

require(ROOT . "model/ReservationModel.php");

function detail($id){
	render('reservationdetail', array(
        'reservation' => selectReservation($id))
    );
}