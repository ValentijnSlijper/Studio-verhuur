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

	// loopen over de post data array
	foreach ($_POST['data'] as $key => $value){

		// wanneer de waarde van een input field leeg is, word dit in de errors array gepushed	


		// extra check per veld voor vereiste gegevens of tekens
		switch ($value['name']) {
			case 'name':

				// haalt de user data door de filter gehaald om te checken of het een valide structuur heeft
				if (!preg_match("/^[a-zA-Z ]*$/", $value['value'])) {
					array_push($error, 'Name can only contain letters and whitespace');
				}

				// wanneer het email veld leeg is, en de form niet op login staat, word dit aan de error array toegevoegd
				if(empty($value['value']) && $_POST['function'] != 'login'){
					array_push($error, 'name cannot be empty');
				}

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
					// if(timecheck($value['value'])){

					// }
			array_push($error, $value['value']);
				break;

			case 'endtime':
					// if(timecheck($value['value'])){

					// }
			array_push($error, $value['value']);
				break;
			
			default:
				break;
		}

	};

	// wanneer de error array geen waardes bevat word de success key hiervan op true gezet
	// de function van de form word weer terug gestuurd voor de 2e AJAX call (register, reservation of login)
	// ook wordt de sanitized data mee teruggestuurd
	if(!count($error)){
		$error['success'] = true;
		$error['function'] = $_POST['function'];
		$error['data'] = $_POST['data'];
	}

	print_r(json_encode($error));
}

function timecheck($starttime){

}

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}