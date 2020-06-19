<?php  

require(ROOT . "model/SessionModel.php");

function sessionStatus(){
	return readSession();
}