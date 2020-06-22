<?php

require(ROOT . 'model/UserModel.php');

function newuser(){

	// variabelen maken aan de hand van de formdata
	extract(vars($_POST['data']));

	// password hash
	$password = password_hash($password, PASSWORD_BCRYPT);

	// create functie in de usermodel
	createUser($name, $password, $mail);

}

function login(){

	// variabelen maken aan de hand van de formdata
	extract(vars($_POST['data']));

	// wanneer de functie true returned, stuurt het success naar het script, zo niet echo'ed het de error van de usermodel
	echo json_encode(loginUser($mail, $password));

}


function vars($data){

	foreach ($data as $key => $value){	

		// maakt van elke data name een variabele met de waarde
		// "name" => "Piet" word dan $name = 'Piet'
		${$value['name']} = $value['value'];

	};

	$result = array(
		'name' => $name,
		'password' => $password,
		'mail' => $mail
	);

	return $result;

}