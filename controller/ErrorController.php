<?php

function error_404(){
	echo "404 - De gevraagde route is niet beschikbaar. Controleer je controller en action naam";
}

function validate($data){

	$err = new stdClass();

	if(isset($data['name']){
		$data['name'] == '' ? return $err->name = 'emptyname' : '' ;
	});

	if(isset($data['mail']){
		$data['mail'] == '' ? return $err->mail = 'emptymail' : '' ;
	});	



	echo 'hello';


}