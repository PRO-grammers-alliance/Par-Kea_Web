<?php
//require("./BD.php");

//GENERAR CODIGO PARA CREACION DEL PARQUEADERO
function genCod()
{
    $numeros = range(1, 9);
    $CODIGO = "";
    while (strlen($CODIGO) < 10) {
        $numRand = rand(0, count($numeros) - 1);
        $CODIGO = $CODIGO .  $numeros[$numRand];
    }
    echo $CODIGO;
}
genCod();

//Traer datos de conexion
// $user = $_REQUEST("User");
// $password = $_REQUEST("Passwd");
// $spass = sha1($password);

// //-------Confirmar Codigo en BD-------
// genCod();
// $qrySelect = "SELECT codigo from coodigo;";
// $execute = $myssql_query($qrySelect, $link);
// if ($execute) {
//     while ($result = $myssql_fetch_array($execute)) {
//         if ($result["codigo"] != $CODIGO) {
//             $qry = "INSERT INTO codigo (codigo, activo) values (" . $CODIGO . ", 1);";
//             $insertar = $myssql_query($qrySelect, $link);
//         }
//     }
// }
// //-------GUARDAR CODIGO-------
// //realizar query


// echo $CODIGO;
