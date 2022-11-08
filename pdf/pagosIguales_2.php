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
    
    if($meses==1)
        {
            switch($group1)
            {
            case "Semanas":
                {
                    $pdf->SetFont('Times','b',13);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->Cell(2);
                    $pdf->Cell(20,6,utf8_decode('Periodos: '),0,0,'L');
                    $pdf->SetFont('Times','',13);
                    $pdf->Cell(80,6,utf8_decode('1 Semana'),0,1,'L');
                    break;
                }
            case "Quincenas":
                {
                    $pdf->SetFont('Times','b',13);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->Cell(2);
                    $pdf->Cell(20,6,utf8_decode('Periodos: '),0,0,'L');
                    $pdf->SetFont('Times','',13);
                    $pdf->Cell(80,6,utf8_decode('1 Quincena'),0,1,'L');
                    break;
                }
            case "Meses":
                {
                    $pdf->SetFont('Times','b',13);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->Cell(2);
                    $pdf->Cell(20,6,utf8_decode('Periodos: '),0,0,'L');
                    $pdf->SetFont('Times','',13);
                    $pdf->Cell(80,6,utf8_decode('1 Mes'),0,1,'L');
                    break;
                }
            case "Trimestres":
                {
                    $pdf->SetFont('Times','b',13);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->Cell(2);
                    $pdf->Cell(20,6,utf8_decode('Periodos: '),0,0,'L');
                    $pdf->SetFont('Times','',13);
                    $pdf->Cell(80,6,utf8_decode('1 Trimestre'),0,1,'L');
                    break;
                }
            case "Anios":
                {
                    $pdf->SetFont('Times','b',13);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->Cell(2);
                    $pdf->Cell(20,6,utf8_decode('Periodos: '),0,0,'L');
                    $pdf->SetFont('Times','',13);
                    $pdf->Cell(80,6,utf8_decode('1 Año'),0,1,'L');

                    break;
                }

        }
    }
    else
    {
        if($group1=="Anios")
        {

            $pdf->SetFont('Times','b',13);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->Cell(2);
                    $pdf->Cell(20,6,utf8_decode('Periodos: '),0,0,'L');
                    $pdf->SetFont('Times','',13);
                    $pdf->Cell(80,6,utf8_decode($meses.' Años'),0,1,'L');
        }
        else
        {
            $pdf->SetFont('Times','b',13);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->Cell(2);
                    $pdf->Cell(20,6,utf8_decode('Periodos: '),0,0,'L');
                    $pdf->SetFont('Times','',13);
                    $pdf->Cell(80,6,utf8_decode($meses.' '.$group1),0,1,'L');
     
        }
    }
    $pdf->SetFont('Times','b',13);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(2);
    $pdf->Cell(68,6,utf8_decode('Fecha de adquisición de la deuda: '),0,0,'L');
    $pdf->SetFont('Times','',13);
    $pdf->Cell(80,6,utf8_decode($fecha),0,1,'L');
    
    $pdf->SetFont('Times','b',13);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(2);
    $pdf->Cell(48,6,utf8_decode('Fecha del primer pago: '),0,0,'L');
    $pdf->SetFont('Times','',13);
    $pdf->Cell(45,6,utf8_decode($arreglo["fechas"][0]),0,0,'L');

    $pdf->SetFont('Times','b',13);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(2);
    $pdf->Cell(48,6,utf8_decode('Fecha del último pago: '),0,0,'L');
    $pdf->SetFont('Times','',13);
    $pdf->Cell(80,6,utf8_decode($arreglo["fechas"][sizeof($arreglo["fechas"])-1]),0,1,'L');

    $pdf->SetFont('Times','b',20);
    $pdf->SetTextColor(8,108,152);
    $pdf->Cell(2);
    $pdf->Cell(180,30,utf8_decode('Tabla de amortización de pagos iguales'),0,1,'C');
//////////////////////////////////////////////

$pdf->SetFont('Times','b',12);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(2);
$pdf->Cell(20,10,utf8_decode('# Pago'),1,0,'C');
$pdf->Cell(24,10,utf8_decode('Fecha'),1,0,'C');
$pdf->Cell(30,10,utf8_decode('Saldo inicial'),1,0,'C');
$pdf->Cell(25,10,utf8_decode('Intereses'),1,0,'C');
$pdf->Cell(32,10,utf8_decode('Amortización'),1,0,'C');
$pdf->Cell(28,10,utf8_decode('Anualidad'),1,0,'C');
$pdf->Cell(28,10,utf8_decode('Saldo final'),1,1,'C');
//////////////////////////////////////////////
$amortizacionTotal = 0;
$totalInteresesPagosIguales=0;
$pagoTotalPagosIguales = 0;
for($i=0;$i<=$meses;$i++)
{
    $arrayAux=[];
    if($i==0)//periodo 0, solo es el saldo final
    {
        $arrayAux["periodo"]=$i;
        $arrayAux["saldoInicial"]=0;
        $arrayAux["intereses"]=0;
        $arrayAux["abonoCap"]=0;
        $arrayAux["anualidad"]=0;
        $arrayAux["saldoFinal"]=$montoNecesitado;
    }
    else
    {
        $arrayAux["periodo"]=$i;
        $arrayAux["saldoInicial"]=$arreglo["pagosIguales"][$i-1]["saldoFinal"];
        $arrayAux["intereses"]=$arrayAux["saldoInicial"]*$TasaInteres;
        $totalInteresesPagosIguales = $totalInteresesPagosIguales + $arrayAux["saldoInicial"]*$TasaInteres;
        $arrayAux["abonoCap"]=(($montoNecesitado*$TasaInteres)/(1-pow((1+$TasaInteres),$meses*(-1))))-$arrayAux["intereses"];
        $amortizacionTotal = $amortizacionTotal + (($montoNecesitado*$TasaInteres)/(1-pow((1+$TasaInteres),$meses*(-1))))-$arrayAux["intereses"];
        $arrayAux["anualidad"]=($montoNecesitado*$TasaInteres)/(1-pow((1+$TasaInteres),$meses*(-1)));
        $arrayAux["saldoFinal"]=$arrayAux["saldoInicial"]-$arrayAux["abonoCap"];;
    }
    $arreglo["pagosIguales"][]=$arrayAux;
}
for($j=1;$j<sizeof($arreglo["pagosIguales"]);$j++)
{
   /* $html.='<tr>
                <td>'.$arreglo["pagosIguales"][$j]["periodo"].'</td>
                <td>'.$arreglo["fechas"][$j-1].'</td>
                <td align="right">$'.number_format($arreglo["pagosIguales"][$j]["saldoInicial"],2).'</td>
                <td align="right">$'.number_format($arreglo["pagosIguales"][$j]["intereses"],2).'</td>
                <td align="right">$'.number_format($arreglo["pagosIguales"][$j]["abonoCap"],2).'</td>
                <td align="right">$'.number_format($arreglo["pagosIguales"][$j]["anualidad"],2).'</td>
                <td align="right">$'.number_format($arreglo["pagosIguales"][$j]["saldoFinal"],2).'</td>
            </tr>';*/

            $pdf->SetFont('Times','',12);
            $pdf->SetTextColor(0,0,0);
            $pdf->Cell(2);
            $pdf->Cell(20,10,utf8_decode($arreglo["pagosIguales"][$j]["periodo"]),1,0,'C');
            $pdf->Cell(24,10,utf8_decode($arreglo["fechas"][$j-1]),1,0,'C');
            $pdf->Cell(30,10,utf8_decode('$'.number_format($arreglo["pagosIguales"][$j]["saldoInicial"],2)),1,0,'R');
            $pdf->Cell(25,10,utf8_decode('$'.number_format($arreglo["pagosIguales"][$j]["intereses"],2)),1,0,'R');
            $pdf->Cell(32,10,utf8_decode('$'.number_format($arreglo["pagosIguales"][$j]["abonoCap"],2)),1,0,'R');
            $pdf->Cell(28,10,utf8_decode('$'.number_format($arreglo["pagosIguales"][$j]["anualidad"],2)),1,0,'R');
            $pdf->Cell(28,10,utf8_decode('$'.number_format($arreglo["pagosIguales"][$j]["saldoFinal"],2)),1,1,'R');
}

////////////////////////////////////////////////////////////////////////////////////////////////
//TABLA RESUMEN
$pdf->SetFont('Times','b',20);
$pdf->SetTextColor(8,108,152);
$pdf->Cell(2);
$pdf->Cell(180,30,utf8_decode('Resumen de tu deuda'),0,1,'C');

$pdf->SetFont('Times','b',12);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(2);
$pdf->Cell(45,10,utf8_decode('Fecha de liquidación'),1,0,'C');
$pdf->Cell(47,10,utf8_decode('Total de intereses'),1,0,'C');
$pdf->Cell(48,10,utf8_decode('Amortización total'),1,0,'C');
$pdf->Cell(48,10,utf8_decode('Total pagado'),1,1,'C');

$arreglo["totalInteresesPagosIguales"] = number_format( $totalInteresesPagosIguales,2);
$arreglo["amortizacionTotal"] = number_format($amortizacionTotal,2);
$pagoTotalPagosIguales = $totalInteresesPagosIguales + $amortizacionTotal;
$arreglo["pagoTotalPagosIguales"] = number_format($pagoTotalPagosIguales,2);

$pdf->SetFont('Times','',12);
            $pdf->SetTextColor(0,0,0);
            $pdf->Cell(2);
            $pdf->Cell(45,10,utf8_decode($arreglo["fechas"][sizeof($arreglo["fechas"])-1]),1,0,'C');
            $pdf->Cell(47,10,utf8_decode('$'.$arreglo["totalInteresesPagosIguales"]),1,0,'R');
            $pdf->Cell(48,10,utf8_decode('$'.$arreglo["amortizacionTotal"]),1,0,'R');
            $pdf->Cell(48,10,utf8_decode('$'.$arreglo["pagoTotalPagosIguales"]),1,0,'R');



////////////////////////////////////////////////////////////////////////////////////////////////

$pdf->Output();
?>

?>
