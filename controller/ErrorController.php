<?php

require(ROOT . "model/UserModel.php");
require(ROOT . "model/ReservationModel.php");

function error_404(){
	echo "404 - De gevraagde route is niet beschikbaar. Controleer je controller en action naam";
}

//  functie om geldigheid van input fields te checken en waar nodig errors te returnen
function validate(){

	// initialiseren van error array
	$error = array();
	$booktime = array();

	// loopen over de post data array
	foreach ($_POST['data'] as $key => $value){

		$res_id = $_POST['data'][0]['value'];

		// extra check per veld voor vereiste gegevens of tekens
		switch ($value['name']) {

			case 'function':
				$formfunction = $value['value'];
			break;

			case 'name':

				// haalt de user data door de filter gehaald om te checken of het een valide structuur heeft
				if (!preg_match("/^[0-9a-zA-Z ]*$/", $value['value']) && $formfunction != 'createreservation') {
					array_push($error, 'Name can only contain letters, numbers and whitespace');
				}

				// wanneer het email veld leeg is, en de form niet op login staat, word dit aan de error array toegevoegd
				if(empty($value['value']) && $_POST['function'] != 'login' || $value['value'] == 'empty'){
					array_push($error, 'Name cannot be empty');
				}

				$name = test_input($value['value']);

				break;

			case 'studio':
				if(empty($value['value']) || $value['value'] == 'empty'){
					array_push($error, 'Please select your studio');
				}

				$studio = test_input($value['value']);

			break;

			case 'mail':

				// wanneer het mail veld niet leeg is, word deze door de filter gehaald om te checken of het een valide email structuur heeft
				if (!filter_var($value['value'], FILTER_VALIDATE_EMAIL) && $value['value'] != '') {
					array_push($error, 'Invalid email format');
				}

				// wanneer het email veld leeg is word dit aan de error array toegevoegd
				if(empty($value['value'])){
					array_push($error, 'mail cannot be empty');
				}

				// wanneer de form functie op register staat, checkt deze of de mail al is gebruikt aan de hand van een query uit de usermodel
				if($_POST['function'] == 'register' && duplicateUser($value['value'])){
					array_push($error, 'mail allready used');
				}
				break;

			case 'password':

				// wanneer het password veld leeg is word dit aan de error array toegevoegd
				if(empty($value['value'])){
					array_push($error, 'password cannot be empty');
				} 
				break;

			case 'starttime':

				if($value['value'] == 'empty'){
					array_push($error, 'Enter your start time');
				}			

				$booktime['starttime'] = test_input(intval($value['value']));
				break;

			case 'endtime':

				if($value['value'] == 'empty'){
					array_push($error, 'Enter your end time');
				}	

				$booktime['endtime'] = test_input(intval($value['value']));
				break;

			case 'instrument':
				$instrument = test_input($value['value']);
				break;
			
			default:
				break;
		}

	};


	// checkt of de starttijd en de eindtijd niet hetzelfde zijn
	if($formfunction == 'createreservation' || $formfunction == 'updatereservation'){
		$booktime['starttime'] == $booktime['endtime'] ? array_push($error, 'Start time and end time cannot be the same') : '' ;		
	}


	// checkt of de studio vrij is op het te boeken tijdstip
	if($formfunction == 'createreservation'){
		timecheck($booktime, $studio) ? '' : array_push($error, 'This studio is not available at this time');
	}else if($formfunction == 'updatereservation'){
		updatecheck($booktime, $studio, $res_id) ? '' : array_push($error, 'This studio is not available at this time');
	}

	// wanneer de error array geen waardes bevat word de success key hiervan op true gezet
	// de function van de form word weer terug gestuurd voor de 2e AJAX call (register, reservation of login)
	// ook wordt de sanitized data mee teruggestuurd
	if(!count($error)){
		$error['success'] = true;
		$error['function'] = $_POST['function'];
		$error['data'] = $_POST['data'];
		$error['reservation'] = array(
			'studio' => $studio,
			'name' => $name,
			'starttime' => $booktime['starttime'],
			'endtime' => $booktime['endtime'],
			'instrument' => $instrument,
			'id' => $res_id
		);
	}

	print_r(json_encode($error));
}

// functie om te kijken of de studio beschikbaar is op de gekozen tijd
function timecheck($booktime, $studio){

	// alle rijen ophalen uit de database
	$reservations = filterReservations($studio);

	return crosscheck($booktime, $reservations);

}

// functie om te kijken of de studio beschikbaar is op de gekozen tijd
function updatecheck($booktime, $studio, $id){

	// alle rijen ophalen uit de database
	$reservations = exceptReservations($studio, $id);

	$res_time = array();

	return crosscheck($booktime, $reservations);
}

function crosscheck($booktime, $reservations){

	$res_time = array();

	foreach ($reservations as $key => $value) {

		$res_time['starttime'] = intval(explode(':', $reservations[$key]['starttime'])[0]);
		$res_time['endtime'] = intval(explode(':', $reservations[$key]['endtime'])[0]);	


		// zit jouw starttijd tussen een reserverings tijd
		if($booktime['starttime'] > $res_time['starttime'] && $booktime['starttime'] < $res_time['endtime']){
			return false;
			break;
		}

		// zit jouw eindtijd tussen een reserverings tijd
		if($booktime['endtime'] > $res_time['starttime'] && $booktime['endtime'] < $res_time['endtime']){
			return false;
			break;
		}

		// overlapt jouw grotere boeking een kleinere reservering
		if($booktime['starttime'] < $res_time['starttime'] && $booktime['endtime'] > $res_time['endtime']){
			return false;
			break;
		}

		// is jouw start tijd of eind tijd gelijk aan de tijd van een reservering
		if($booktime['starttime'] == $res_time['starttime'] || $booktime['endtime'] == $res_time['endtime']){
			return false;
			break;
		}
	}
	
	return true;
}

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}