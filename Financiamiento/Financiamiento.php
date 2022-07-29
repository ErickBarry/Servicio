<?php
include("./../pages/getPosts.php");

$respAX["status"]=1;
$arreglo["pagosIguales"] = [];
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

//Poner formato de $ en el arreglo
for($i=0;$i<sizeof($arreglo["pagosIguales"]);$i++)
{
    $arreglo["pagosIguales"][$i]["saldoInicial"]=number_format($arreglo["pagosIguales"][$i]["saldoInicial"],2);
    $arreglo["pagosIguales"][$i]["intereses"]=number_format($arreglo["pagosIguales"][$i]["intereses"],2);
    $arreglo["pagosIguales"][$i]["abonoCap"]=number_format($arreglo["pagosIguales"][$i]["abonoCap"],2);
    $arreglo["pagosIguales"][$i]["anualidad"]=number_format($arreglo["pagosIguales"][$i]["anualidad"],2);
    $arreglo["pagosIguales"][$i]["saldoFinal"]=number_format($arreglo["pagosIguales"][$i]["saldoFinal"],2);
}
echo json_encode($arreglo);
?>