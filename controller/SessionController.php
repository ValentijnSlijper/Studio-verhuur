<?php  

require(ROOT . "model/SessionModel.php");

function getSession(){
	return readSession();
}

function jsonSession(){
	echo json_encode(readSession());
}