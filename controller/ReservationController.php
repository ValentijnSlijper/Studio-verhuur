<?php

require(ROOT . "model/StudioModel.php");
require(ROOT . "model/ReservationModel.php");
require(ROOT . "model/SessionModel.php");
require(ROOT . "model/UserModel.php");
require(ROOT . "model/InstrumentModel.php");

use Dompdf\Dompdf; 
use Dompdf\Options;

function detail($id){
	render('reservationdetail', array(
        'reservation' => selectReservation($id),
        'reservations' => readReservations(),
		'session' => readSession(),
		'user' => selectUser(),
		'users' => readUsernames(),
		'studios' => getAllStudios(),
		'instruments' => readInstruments()
    ));
}

function delete($id){
	deleteReservation($id);
}

function create(){
	echo json_encode(createReservation($_POST['data']));

}

function update(){
	updateReservation($_POST['data']);
}

function price(){

	$starttime = intval($_POST['data']['starttime']);
	$endtime = intval($_POST['data']['endtime']);
	$studio = $_POST['data']['studio'];

	$totaltime = $endtime - $starttime;

	$studioprice = intval(studioDetails($studio)['price']);

	$_SESSION['price'] = $totaltime * $studioprice;

	if(isset($_POST['data']['instrument'])){
		$instrumentprice = intval(filterInstrument($_POST['data']['instrument'])['price']);

		$_SESSION['price'] = $_SESSION['price'] + ($totaltime * $instrumentprice);

	}

	echo $_SESSION['price'];

}

function test(){

}

function invoice($id){

	$data = readInvoice($id);
	$reservation = selectReservation($id);

	$subtotal = $reservation['price'] * 0.79;
	$vat = $reservation['price'] * 0.21;
	$total = $reservation['price'];

	$invoice = file_get_contents('../view/templates/invoice.html');
	$invoice = str_replace('%invoice_num%', $data['invoice'], $invoice);
	$invoice = str_replace('%name%', $data['name'], $invoice);
	$invoice = str_replace('%mail%', $data['mail'], $invoice);
	$invoice = str_replace('%curdate%', $data['curdate'], $invoice);
	$invoice = str_replace('%subtotal%', $subtotal, $invoice);
	$invoice = str_replace('%vat%', $vat, $invoice);
	$invoice = str_replace('%total%', $total, $invoice);

	$table = 
	'<tr>
		<th scope="row">1</th>
		<td>'.$reservation['studio'].'</td>
		<td>'.$reservation['starttime'].'</td>
		<td>'.$reservation['endtime'].'</td>
	</tr>';

	$invoice = str_replace('%table%', $table, $invoice);

	require_once '../dompdf/autoload.inc.php';

	$options = new Options();
    $options->set('isRemoteEnabled', TRUE);
    $options->set('enable_css_float', TRUE);
    $options->set('enable_html5_parser', FALSE);
    $dompdf = new Dompdf($options);

	$file_name = '2020-' . explode('-', $invoicenum['invoice'])[1];

	$dompdf->loadHtml($invoice);

	// (Optional) Setup the paper size and orientation
	$dompdf->setPaper('A4', 'landscape');

	// Render the HTML as PDF
	$dompdf->render();

	// Output the generated PDF to Browser
	$dompdf->stream();

}	