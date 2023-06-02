<?php
require("BD.php");

$fecha = $_GET["fecha"];
$dpto = $_GET["dpto"];
$ciudad = $_GET["ciudad"];

if (!isset($fecha) && !isset($dpto) && !isset($ciudad)) {
    $qry = "SELECT CAST(Par.Nit AS TEXT) AS Nit, CAST(Par.Nombre AS TEXT) AS Nombre,Par.Tarifa_carro AS 'Tarifa Carro',
    Par.Tarifa_moto AS 'Tarifa Moto',CAST(Par.Horario AS TEXT) AS Horario,CAST(Par.Ciudad AS TEXT) AS Ciudad,
    CAST(Par.Departamento AS TEXT) As Departamento, Par.Cupos, CAST(Par.Codigo AS TEXT) AS Codigo, 
    Par.Fecha_modificacion AS 'Fecha Modificacion', Ubi.Direccion from FelipeING_Parqueadero AS Par 
    LEFT JOIN FelipeING_Ubicacion AS Ubi on Par.Nit = Ubi.Parq_ID;";

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
} else if (isset($fecha)) {
    $qry = "SELECT CAST(Par.Nit AS TEXT) AS Nit, CAST(Par.Nombre AS TEXT) AS Nombre,
    CAST(Par.Ciudad AS TEXT) AS Ciudad, CAST(Par.Departamento AS TEXT) As Departamento,  SUM(Reg.Valor) AS Valor 
    from FelipeING_Parqueadero AS Par
    LEFT JOIN FelipeING_Ubicacion AS Ubi on Par.Nit = Ubi.Parq_ID
    LEFT JOIN FELIPEING_Registro AS Reg on Par.Nit = Reg.Parq_ID
    WHERE Reg.Fecha_R >= '$fecha' 
    GROUP BY Par.Nit, Par.Nombre, Ciudad, Departamento;";

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
} else if (isset($dpto)) {

    $qry = "SELECT CAST(Par.Nit AS TEXT) AS Nit, CAST(Par.Nombre AS TEXT) AS Nombre,Par.Tarifa_carro AS 'Tarifa Carro',
    Par.Tarifa_moto AS 'Tarifa Moto',CAST(Par.Horario AS TEXT) AS Horario,CAST(Par.Ciudad AS TEXT) AS Ciudad,
    CAST(Par.Departamento AS TEXT) As Departamento, Par.Cupos, CAST(Par.Codigo AS TEXT) AS Codigo, 
    Par.Fecha_modificacion AS 'Fecha Modificacion', Ubi.Direccion from FelipeING_Parqueadero AS Par 
    LEFT JOIN FelipeING_Ubicacion AS Ubi on Par.Nit = Ubi.Parq_ID
    WHERE Departamento = '$dpto';";

    $result = mssql_query($qry, $link);

    if (!$result) {
        die('Error al ejecutar la consulta filtro: ' . mssql_get_last_message());
    } else {
        $data = array();
        while ($row = mssql_fetch_assoc($result)) {
            $data[] = $row;
        }
        $json = json_encode($data);
        echo $json;
    }
} else if (isset($ciudad)) {

    $qry = "SELECT CAST(Par.Nit AS TEXT) AS Nit, CAST(Par.Nombre AS TEXT) AS Nombre,Par.Tarifa_carro AS 'Tarifa Carro',
    Par.Tarifa_moto AS 'Tarifa Moto',CAST(Par.Horario AS TEXT) AS Horario,CAST(Par.Ciudad AS TEXT) AS Ciudad,
    CAST(Par.Departamento AS TEXT) As Departamento, Par.Cupos, CAST(Par.Codigo AS TEXT) AS Codigo, 
    Par.Fecha_modificacion AS 'Fecha Modificacion', Ubi.Direccion from FelipeING_Parqueadero AS Par 
    LEFT JOIN FelipeING_Ubicacion AS Ubi on Par.Nit = Ubi.Parq_ID
    WHERE Ciudad = '$ciudad';";

    $result = mssql_query($qry, $link);

    if (!$result) {
        die('Error al ejecutar la consulta filtro: ' . mssql_get_last_message());
    } else {
        $data = array();
        while ($row = mssql_fetch_assoc($result)) {
            $data[] = $row;
        }
        $json = json_encode($data);
        echo $json;
    }
}
