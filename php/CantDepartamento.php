<?php
require("BD.php");
$depto = $_REQUEST["dpto"];
$total = 0;
$arreglo_lables = "[";
$arreglo_data = "[";
$dpto = $depto;
$lables = "labels: [";
$dataD = "data: [";

$qry;

#Domicilios
if (!isset($depto)) {
    $qry = "SELECT CAST(Par.Departamento AS TEXT) As Departamento, COUNT(Par.Departamento) AS TotalDptos
    from FelipeING_Parqueadero AS Par
    GROUP BY Departamento;";

    $consulta = mssql_query($qry, $link) or die("Error: " . mssql_get_last_message());
    if ($consulta) {
        while ($resul = mssql_fetch_array($consulta)) {
            $lables .= "'" . $resul['Departamento'] . "',";
            $arreglo_lables .= "'" . $resul['Departamento'] . "',";
            $total = $total + $resul['TotalDptos'];
            $arreglo_data .= $resul['TotalDptos'] . ",";
            $dataD = $dataD . "'" . $resul['TotalDptos'] . "',";
        }
    }

    mssql_free_result($consulta);

    $lables .= "],";
    $arreglo_lables = substr($arreglo_lables, 0, -1);
    $dataD = substr($dataD, 0, -1);
    $dataD .= "]";
    $total = number_format($total);

    #Grafico bar
    echo "var ctx = document.getElementById('Indicador_bar').getContext('2d');";
    echo "window.chartEE = new Chart(ctx, {";
    echo "type: 'bar',";
    echo "data: {";
    echo $lables;
    echo "datasets: [ {";
    echo "label: 'Departamentos',";
    echo $dataD;
    echo ",borderColor:'#FF0000',backgroundColor: '#FF0000',";
    echo "}]";
    echo "},";
    echo "plugins: [plugin],";
    echo "});";
    echo "lables =" . $arreglo_lables . "];";
    echo "data = " . $arreglo_data . "];";
    echo "document.getElementById('des_excel').setAttribute('href','./php/ExportDpto.php?&arl='+lables+'&ard='+data);";
} else {
    $qry = "SELECT CAST(Par.Ciudad AS TEXT) As Departamento, COUNT(Par.Ciudad) AS TotalDptos
    from FelipeING_Parqueadero AS Par
    WHERE Par.Departamento = '$dpto'
    GROUP BY Par.Ciudad;";

    $consulta = mssql_query($qry, $link) or die("Error: " . mssql_get_last_message());
    if ($consulta) {
        while ($resul = mssql_fetch_array($consulta)) {
            $lables .= "'" . $resul['Departamento'] . "',";
            $arreglo_lables .= "'" . $resul['Departamento'] . "',";
            $total = $total + $resul['TotalDptos'];
            $arreglo_data .= $resul['TotalDptos'] . ",";
            $dataD = $dataD . "'" . $resul['TotalDptos'] . "',";
        }
    }

    mssql_free_result($consulta);

    $lables .= "],";
    $arreglo_lables = substr($arreglo_lables, 0, -1);
    $dataD = substr($dataD, 0, -1);
    $dataD .= "]";
    $total = number_format($total);

    #Grafico bar
    echo "var ctx = document.getElementById('Indicador_bar').getContext('2d');";
    echo "window.chartEE = new Chart(ctx, {";
    echo "type: 'bar',";
    echo "data: {";
    echo $lables;
    echo "datasets: [ {";
    echo "label: 'Ciudades',";
    echo $dataD;
    echo ",borderColor:'#FF0000',backgroundColor: '#FF0000',";
    echo "}]";
    echo "},";
    echo "plugins: [plugin],";
    echo "});";
    echo "lables =" . $arreglo_lables . "];";
    echo "data = " . $arreglo_data . "];";
    echo "document.getElementById('des_excel').setAttribute('href','./php/ExportDpto.php?i=" . $depto . "&arl='+lables+'&ard='+data);";
}
