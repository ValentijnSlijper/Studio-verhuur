<?php 

session_start();

function readSession(){

	// wanneer de session login true is, word de text van de LI in de NAV op 'profile' gezet, anders op login
	$_SESSION['login'] === true ? $_SESSION['navtext'] = 'Profile' : $_SESSION['navtext'] = 'Login';

	return $_SESSION;
};