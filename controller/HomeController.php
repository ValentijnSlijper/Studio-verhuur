<?php

require(ROOT . "model/StudioModel.php");
session_start();

function index(){

	render('index');
}

function studios(){

    render('studios', array(
        'studios' => getAllStudios())
    );
}

function users(){
    render('users');
}

function reservations(){
    render('reservations');
}



?>