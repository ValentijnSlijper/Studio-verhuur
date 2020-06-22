<?php
require(ROOT . "model/StudioModel.php");
require(ROOT . "model/SessionModel.php");

function detail($id){
	render('studiodetails', array(
        'studio' => studioDetails($id),
        'session' => readSession()
	));
}

