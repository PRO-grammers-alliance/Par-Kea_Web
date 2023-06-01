<?php
require("BD.php");

if (!isset($_GET["fecha"])) {
    $qry = "SELECT CAST(Par.Nit AS TEXT) AS Nit, CAST(Par.Nombre AS TEXT) AS Nombre,Par.Tarifa_carro,
    Par.Tarifa_moto,CAST(Par.Horario AS TEXT) AS Horario,CAST(Par.Ciudad AS TEXT) AS Ciudad, Par.Cupos, Par.Cupos_dis,
    CAST(Par.Codigo AS TEXT) AS Codigo, Par.Fecha_modificacion,Ubi.Direccion from FelipeING_Parqueadero AS Par 
    LEFT JOIN FelipeING_Ubicacion AS Ubi on Par.Nit = Ubi.Parq_ID;";

    // $qry = "SELECT CAST(Par.Nit AS TEXT) AS Nit, CAST(Par.Nombre AS TEXT) AS Nombre,Par.Tarifa_carro,
    //     Par.Tarifa_moto,CAST(Par.Horario AS TEXT) AS Horario,CAST(Par.Ciudad AS TEXT) AS Ciudad, Par.Cupos, Par.Cupos_dis,
    //     CAST(Par.Codigo AS TEXT) AS Codigo, Par.Fecha_modificacion from FelipeING_Parqueadero AS Par;";

    $result = mssql_query($qry, $link);


    if (!$result) {
        die('Error al ejecutar la consulta: ' . mssql_get_last_message());
    } else {
        $data = array();
        while ($row = mssql_fetch_assoc($result)) {
            $data[] = $row;
        }
        $json = json_encode($data);
        echo $json;
    }
} else if (isset($_GET["fecha"])) {
    //ALGO
}
