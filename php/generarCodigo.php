<?php
require("BD.php");

//GENERAR CODIGO PARA CREACION DEL PARQUEADERO

$numeros = range(1, 9);
$CODIGO = "";
while (strlen($CODIGO) < 10) {
    $numRand = rand(0, count($numeros) - 1);
    $CODIGO = $CODIGO .  $numeros[$numRand];
}

function confCod($link, $COD)
{
    $esta = false;

    $qry = "SELECT codigo from FelipeING_Codigo;";
    $result = mssql_query($qry, $link);

    if (!$result) {
        die('Error al ejecutar la consulta: ' . mssql_get_last_message());
    } else {
        while ($row = mssql_fetch_array($result)) {
            if ($row['Codigo'] === $COD) {
                $esta = true;
            } else {
                $esta = false;
            }
        }
    }
    mssql_close($link);
    return $esta;
}

function guardarCODBD($existe, $COD)
{
    //CONFIRMAR GUARDAR
}
