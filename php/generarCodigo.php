<?php
require("BD.php");

//GENERAR CODIGO PARA CREACION DEL PARQUEADERO


$CODIGO = "";
function genCOD()
{
    global $CODIGO;
    $numeros = range(1, 9);
    while (strlen($CODIGO) < 10) {
        $numRand = rand(0, count($numeros) - 1);
        $CODIGO = $CODIGO .  $numeros[$numRand];
    }
    return $CODIGO;
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
                echo "YA ESTABA";
            } else {
                $esta = false;
            }
        }
    }
    mssql_close($link);
    return $esta;
}

function guardarCODBD($existe, $link)
{
    global $CODIGO;

    if (!$existe) {
        $qry = "INSERT INTO FelipeING_Codigo (codigo, activo) VALUES (" . $CODIGO . ",1);";
        $insertar = mssql_query($qry, $link);
        if (!$insertar) {
            die("Error al insertar codigo" . mssql_get_last_message());
        }
        return $CODIGO;
    } else {
        return "Vuelve a Generar Otro Codigo";
    }
}

echo guardarCODBD(confCod($link, genCOD()), $link);
