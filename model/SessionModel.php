<?php 

session_start();

function readSession(){

	$conn = openDatabaseConnection();

	// wanneer de login key van de session array nog niet is gezet, word deze gemaakt en op false gezet
	isset($_SESSION['login']) != true ? $_SESSION['login'] = false : '' ;

	// wanneer de session login true is, word de text van de LI in de NAV op 'profile' gezet, anders op login
	if($_SESSION['login'] === true) {
		$_SESSION['navtext'] = 'Profile';
		$_SESSION['navlink'] = 'https://studio-verhuur.tk/home/profile';
	}else{
		$_SESSION['navtext'] = 'Login';
		$_SESSION['navlink'] = '#';
	}

	// returned de session array
	return $_SESSION;
};