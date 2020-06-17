<?php

function index()
{
    //1. Haal alle medewerkers op uit de database (via de model) en sla deze op in een variable
    // $employees = getAllEmployees();
    //2. Geef een view weer en geef de variable met medewerkers hieraan mee
    // render('employee/index', $employees);
    render('studio/index');
}

?>