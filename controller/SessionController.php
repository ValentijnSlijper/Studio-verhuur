<?php  

require(ROOT . "model/SessionModel.php");

function getSession(){
	return readSession();
}