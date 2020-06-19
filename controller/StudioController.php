<?php
require(ROOT . "model/StudioModel.php");

function detail($id){
	render('studiodetails', array(
        'studio' => studioDetails($id))
    );
}

