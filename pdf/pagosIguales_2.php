<?php
session_start();
//obtener los datos de la sesion
$montoNecesitado=$_SESSION["monto"];
$prestamista=$_SESSION["prestamista"];
$interes=$_SESSION["tasaInteresAnual"];
$tasaEfec=$_SESSION["tasaEfectiva"];
$meses=$_SESSION["periodos"];
$fecha=$_SESSION["fecha"];
$group1=$_SESSION["tipoPlazo"];

require('./../assets/fpdf/fpdf.php');


class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    //$this->Image('logo.png',10,8,33);
    // Arial bold 15
    $this->SetFont('Times','',12);
    // Movernos a la derecha
    $this->Cell(2);
    // Título
    $this->SetTextColor(0,0,0);
    $this->Cell(160,10,utf8_decode('Tablas de amortización'),0,0,'L');
    $this->SetFont('Times','',12);
    $this->Cell(20,10,utf8_decode('Pagos iguales'),0,0,'R');
    // Salto de línea
    $this->Ln(20);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
}
}
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$pdf->SetTextColor(0,0,0);
//////////////////////////////////////////////////////////////////////////////////////////////////
//Calculos
date_default_timezone_set("America/Mexico_City");
$NvaFecha=str_replace('/','-',$fecha);//cambiar el formato 01/08/2022 por 01-08-2022 para que no haya problema en las operaciones

$arreglo["pagosIguales"] = [];
$arreglo["pagoIntFinPeriodo"] = [];
$arreglo["pagoCadaPeriodo"] = [];
$arreglo["pagoParteProporcional"] = [];
$arreglo["pagoCreciente"] = [];
$arreglo["fechas"] = [];//lista de las fechas
$TasaInteres=0.0;

switch($group1)
{
    case "Semanas":
        {
            $TasaInteres=($interes/100)/52;

            for($i=0;$i<$meses;$i++)
            {
                $NvaFecha=date('d-m-Y',strtotime($NvaFecha.' + 7 days '));//Se suman 7 dias
                $arreglo["fechas"][]=str_replace('-','/',$NvaFecha);//se regresa al formato 01/08/2022
            }

            break;
        }
    case "Quincenas":
        {
            $TasaInteres=($interes/100)/26;

            for($i=0;$i<$meses;$i++)
            {
                $NvaFecha=date('d-m-Y',strtotime($NvaFecha.' + 15 days '));//Se suman 15 dias
                $arreglo["fechas"][]=str_replace('-','/',$NvaFecha);//se regresa al formato 01/08/2022
            }

            break;
        }
    case "Meses":
        {
            $TasaInteres=($interes/100)/12;

            for($i=0;$i<$meses;$i++)
            {
                $NvaFecha=date('d-m-Y',strtotime($NvaFecha.' + 1 month'));//Se suman 1 mes
                $arreglo["fechas"][]=str_replace('-','/',$NvaFecha);//se regresa al formato 01/08/2022
            }

            break;
        }
    case "Trimestres":
        {
            $TasaInteres=($interes/100)/4;

            for($i=0;$i<$meses;$i++)
            {
                $NvaFecha=date('d-m-Y',strtotime($NvaFecha.' + 3 month'));//Se suman 3 meses
                $arreglo["fechas"][]=str_replace('-','/',$NvaFecha);//se regresa al formato 01/08/2022
            }

            break;
        }
    case "Anios":
        {
            $TasaInteres=$interes/100;

            for($i=0;$i<$meses;$i++)
            {
                $NvaFecha=date('d-m-Y',strtotime($NvaFecha.' + 1 year'));//Se suman 1 mes
                $arreglo["fechas"][]=str_replace('-','/',$NvaFecha);//se regresa al formato 01/08/2022
            }

            break;
        }

}
////////////////////////////////////////////////////////////////////////////////////////////////
/*$html.='<h5 class="teal-text text-accent-4"><b>Datos</b></h5>';
    $html.='<h6><b>Prestamista: </b>'.$prestamista.'</h6>
    <h6><b>Monto de la deuda: </b>$'.number_format($montoNecesitado,2).'</h6>
    <h6><b>Tasa de interes anual: </b>'.$interes.'%</h6>
    <h6><b>Tasa efectiva: </b>'.$tasaEfec.'</h6>';
    */
    $pdf->SetFont('Times','b',20);
    $pdf->SetTextColor(0,152,117);
    $pdf->Cell(2);
    $pdf->Cell(160,10,utf8_decode('Datos'),0,1,'L');

    $pdf->SetFont('Times','b',13);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(2);
    $pdf->Cell(28,6,utf8_decode('Prestamista: '),0,0,'L');
    $pdf->SetFont('Times','',13);
    $pdf->Cell(80,6,utf8_decode($prestamista),0,1,'L');

    $pdf->SetFont('Times','b',13);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(2);
    $pdf->Cell(40,6,utf8_decode('Monto de la deuda: '),0,0,'L');
    $pdf->SetFont('Times','',13);
    $pdf->Cell(80,6,utf8_decode('$'.number_format($montoNecesitado,2)),0,1,'L');

    $pdf->SetFont('Times','b',13);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(2);
    $pdf->Cell(45,6,utf8_decode('Tasa de interés anual: '),0,0,'L');
    $pdf->SetFont('Times','',13);
    $pdf->Cell(80,6,utf8_decode($interes),0,1,'L');

    $pdf->SetFont('Times','b',13);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(2);
    $pdf->Cell(30,6,utf8_decode('Tasa efectiva: '),0,0,'L');
    $pdf->SetFont('Times','',13);
    $pdf->Cell(80,6,utf8_decode($tasaEfec),0,1,'L');
    //Checar si es 1 periodo para poner 1 mes/1 semana/1 año/1 trimestre etc.
    
    /*if($meses==1)
        {
            switch($group1)
            {
            case "Semanas":
                {
                    $html.='<h6><b>Periodos: </b>1 Semana</h6>';
                    break;
                }
            case "Quincenas":
                {
                    $html.='<h6><b>Periodos: </b>1 Quincena</h6>';
                    break;
                }
            case "Meses":
                {
                    $html.='<h6><b>Periodos: </b>1 Mes</h6>';
                    break;
                }
            case "Trimestres":
                {
                    $html.='<h6><b>Periodos: </b>1 Trimestre</h6>';
                    break;
                }
            case "Anios":
                {
                    $html.='<h6><b>Periodos: </b>1 Año</h6>';

                    break;
                }

        }
    }
    else
    {
        if($group1=="Anios")
        {
            $html.='<h6><b>Periodos: </b>'.$meses.' Años</h6>';
        }
        else
        {
            $html.='<h6><b>Periodos: </b>'.$meses.' '.$group1.'</h6>';
        }
    }
    $html.='<h6><b>Fecha de adquisición de la deuda: </b>'.$fecha.'</h6>';
    $html.='<h6><b>Fecha del primer pago: </b>'.$arreglo["fechas"][0].'</h6>';
    $html.='<h6><b>Fecha del último pago: </b>'.$arreglo["fechas"][sizeof($arreglo["fechas"])-1].'</h6>';
    $html.='<hr><br>';*/
















$pdf->Output();
?>

?>
