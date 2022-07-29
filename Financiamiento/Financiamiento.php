<?php
include("./../pages/getPosts.php");

$respAX["status"]=1;
$arreglo["pagosIguales"] = [];
$arreglo["pagoIntFinPeriodo"] = [];
$arreglo["pagoCadaPeriodo"] = [];
$TasaInteres=0.0;
//Tasa de interes Checar si es por semanas, meses o 
switch($group1)
{
    case "Semanas":
        {
            $TasaInteres=($interes/100)/52;
            break;
        }
    case "Meses":
        {
            $TasaInteres=($interes/100)/12;
            break;
        }
    case "Anios":
        {
            $TasaInteres=$interes/100;
            break;
        }

}
//PAGOS IGUALES//
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
        $arrayAux["abonoCap"]=(($montoNecesitado*$TasaInteres)/(1-pow((1+$TasaInteres),$meses*(-1))))-$arrayAux["intereses"];
        $arrayAux["anualidad"]=($montoNecesitado*$TasaInteres)/(1-pow((1+$TasaInteres),$meses*(-1)));
        $arrayAux["saldoFinal"]=$arrayAux["saldoInicial"]-$arrayAux["abonoCap"];;
    }
    $arreglo["pagosIguales"][]=$arrayAux;
}
///////////////////////////////////////////////////////////////////////////

//PAGO DE CAPITAL E INTERESES AL FINALIZAR EL PERIODO DEL PRESTAMO//
$arrayAux=[];
$arrayAux["periodo"]=1;
$arrayAux["pagoCapital"]=$montoNecesitado;
$arrayAux["pagoFinal"]=$montoNecesitado*(pow(1+$TasaInteres,$meses));
$arrayAux["intereses"]=$arrayAux["pagoFinal"]-$montoNecesitado;
$arreglo["pagoIntFinPeriodo"][]=$arrayAux;
//////////////////////////////////////////////////////////////////////////

//PAGO DE INTERESES AL FINAL DE CADA PERIODO Y PAGO DEL PRINCIPAL AL FINAL DEL PLAZO
$interesPeriodo=$montoNecesitado*$TasaInteres;
for($i=0;$i<$meses;$i++)
{
    $arrayAux=[];
    if($i==0)//periodo 0, solo es el saldo final
    {
        $arrayAux["periodo"]=$i;
        $arrayAux["intereses"]=0;
        $arrayAux["pagoFinalPeriodo"]=0;
        $arrayAux["deudaDespuesPago"]=$montoNecesitado;
    }
    else
    {
        $arrayAux["periodo"]=$i;
        $arrayAux["intereses"]=$interesPeriodo;
        $arrayAux["pagoFinalPeriodo"]=$interesPeriodo;
        $arrayAux["deudaDespuesPago"]=$montoNecesitado;
    }
    $arreglo["pagoCadaPeriodo"][]=$arrayAux;
}
$arrayAux=[];
$arrayAux["periodo"]=$meses;
$arrayAux["intereses"]=$interesPeriodo;
$arrayAux["pagoFinalPeriodo"]=$interesPeriodo+$montoNecesitado;
$arrayAux["deudaDespuesPago"]=0;
$arreglo["pagoCadaPeriodo"][]=$arrayAux;
//////////////////////////////////////////////////////////////////////////
//Poner formato de $ en el arreglo
for($i=0;$i<sizeof($arreglo["pagosIguales"]);$i++)
{
    $arreglo["pagosIguales"][$i]["saldoInicial"]=number_format($arreglo["pagosIguales"][$i]["saldoInicial"],2);
    $arreglo["pagosIguales"][$i]["intereses"]=number_format($arreglo["pagosIguales"][$i]["intereses"],2);
    $arreglo["pagosIguales"][$i]["abonoCap"]=number_format($arreglo["pagosIguales"][$i]["abonoCap"],2);
    $arreglo["pagosIguales"][$i]["anualidad"]=number_format($arreglo["pagosIguales"][$i]["anualidad"],2);
    $arreglo["pagosIguales"][$i]["saldoFinal"]=number_format($arreglo["pagosIguales"][$i]["saldoFinal"],2);
}

$arreglo["pagoIntFinPeriodo"][0]["pagoCapital"]=number_format($arreglo["pagoIntFinPeriodo"][0]["pagoCapital"],2);
$arreglo["pagoIntFinPeriodo"][0]["pagoFinal"]=number_format($arreglo["pagoIntFinPeriodo"][0]["pagoFinal"],2);
$arreglo["pagoIntFinPeriodo"][0]["intereses"]=number_format($arreglo["pagoIntFinPeriodo"][0]["intereses"],2);

for($i=0;$i<sizeof($arreglo["pagoCadaPeriodo"]);$i++)
{
    $arreglo["pagoCadaPeriodo"][$i]["intereses"]=number_format($arreglo["pagoCadaPeriodo"][$i]["intereses"],2);
    $arreglo["pagoCadaPeriodo"][$i]["pagoFinalPeriodo"]=number_format($arreglo["pagoCadaPeriodo"][$i]["pagoFinalPeriodo"],2);
    $arreglo["pagoCadaPeriodo"][$i]["deudaDespuesPago"]=number_format($arreglo["pagoCadaPeriodo"][$i]["deudaDespuesPago"],2);
}
echo json_encode($arreglo);
?>