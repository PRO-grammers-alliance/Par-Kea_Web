<?php
require("BD.php");
$fechaI = $_REQUEST["i"];
$total = 0;
$arreglo_lables = "[";
$arreglo_data = "[";
$fecha = $fechaI;
$lables = "labels: [";
$dataD = "data: [";

#Domicilios
$qry = "SELECT SUM(Reg.Valor) AS Valor, CAST(Par.Departamento AS TEXT) As Departamento 
    from FelipeING_Parqueadero AS Par
    LEFT JOIN FELIPEING_Registro AS Reg on Par.Nit = Reg.Parq_ID
    WHERE Reg.Fecha_R >= '$fecha' 
    GROUP BY Departamento;";
$consulta = mssql_query($qry, $link) or die("Error: " . mssql_get_last_message());
if ($consulta) {
    while ($resul = mssql_fetch_array($consulta)) {
        $lables .= "'" . $resul['Departamento'] . "',";
        $arreglo_lables .= "'" . $resul['Departamento'] . "',";
        $total = $total + $resul['Valor'];
        $arreglo_data .= $resul['Valor'] . ",";
        $dataD = $dataD . "'" . $resul['Valor'] . "',";
    }
}

mssql_free_result($consulta);

$lables .= "],";
$arreglo_lables = substr($arreglo_lables, 0, -1);
$dataD = substr($dataD, 0, -1);
$dataD .= "]";
$total = number_format($total);
// echo "document.getElementById('total').textContent  = ' " . $total . "';";
// echo "var ctx = document.getElementById('Indicador_line').getContext('2d');";
// echo "window.chartEE = new Chart(ctx, {";
// echo "type: 'line',";
// echo "data: {";
// echo $lables;
// echo "datasets: [ {";
// echo "label: 'Ingresos',";
// echo "backgroundColor: 'transparent',";
// echo "borderColor: '#0049FF',";
// echo $dataD;
// echo "}]";
// echo "},";
// echo "plugins: [plugin],";
// echo "});";
// echo "lables =" . $arreglo_lables . "];";
// echo "data = " . $arreglo_data . "];";

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
echo "document.getElementById('des_excel').setAttribute('href','./php/ExportD_D.php?i=" . $fechaI . "&f=" . $fechaF . "&arl='+lables+'&ard='+data);";
