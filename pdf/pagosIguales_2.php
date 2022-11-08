<?php

//session_start();
//obtener los datos de la sesion
/*$montoNecesitado=$_SESSION["monto"];
$prestamista=$_SESSION["prestamista"];
$interes=$_SESSION["tasaInteresAnual"];
$tasaEfec=$_SESSION["tasaEfectiva"];
$meses=$_SESSION["periodos"];
$fecha=$_SESSION["fecha"];
$group1=$_SESSION["tipoPlazo"];

require('./../assets/fpdf/fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'Hello World!');
$pdf->Output();*/



session_start();
//obtener los datos de la sesion
$montoNecesitado=$_SESSION["monto"];
$prestamista=$_SESSION["prestamista"];
$interes=$_SESSION["tasaInteresAnual"];
$tasaEfec=$_SESSION["tasaEfectiva"];
$meses=$_SESSION["periodos"];
$fecha=$_SESSION["fecha"];
$group1=$_SESSION["tipoPlazo"];

require_once __DIR__ .'./../assets/mpdf/vendor/autoload.php';
/////////////////////////////////////////////////////////////////////////
// Create an instance of the class:
$mpdfConfig = array(
    'mode' => 'utf-8', 
    //'format' => 'A4',
    'margin_header' => 10,     // 30mm not pixel
    'margin_footer' => 10,     // 10mm
    'margin-bottom' => 20,
    //'orientation' => 'P'    
);
$mpdf = new \Mpdf\Mpdf($mpdfConfig);
$mpdf->SetTitle('Pagos iguales');//titulo del documento

$stylesheet = file_get_contents('./../css/estiloPDF.css');
$mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);

$mpdf->setFooter('{PAGENO}');
$html='<br>';//variable html(se guarda todo el codigo html aqui)
/////////////////////////////////////////////////////////////////////

//Cabecera
$mpdf->setHTMLHeader('<div class="row">
    <div class="col s6 l6 m6">
        <p align="left" style="font-size:15px;">Tablas de amortización</p>
    </div>
    <div class="col s5 l6 m6">
        <p align="right" style="font-size:13px;">Pagos iguales</p>
    </div>
</div>
');

////////////////////////////////////////////////////////////////////////////////////////////////
// Write some HTML code:
$mpdf->WriteHTML($html,\Mpdf\HTMLParserMode::HTML_BODY);

// Output a PDF file directly to the browser
$mpdf->Output('filename.pdf',\Mpdf\Output\Destination::FILE);


?>
