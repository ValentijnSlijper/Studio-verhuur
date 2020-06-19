<?php 

session_start();

$_SESSION['login'] = 'false';
$_SESSION['remy'] = 25;

function readSession(){
	return $_SESSION;
};