<?php
$fechaI = $_REQUEST["i"];
$fechaF = $_REQUEST["f"];
$arreglo_lables = $_REQUEST["arl"];
$arreglo_data = $_REQUEST["ard"];
$lables = explode(',', $arreglo_lables);
$data = explode(',', $arreglo_data);

require('./Excel/PHPExcel.php');
$Excel = new PHPExcel();
$Excel->getProperties()->setCreator('Programmer aliance Reportes')
    ->setTitle('Clientes ' . $fechaI . ' - ' . $fechaF)
    ->setDescription('Reporte Clientes en intervalo de dias');

$Excel->setActiveSheetIndex(0);
$Excel->getActiveSheet()->setTitle('Clientes Dias');
$Excel->getActiveSheet()->setCellValue('A1', 'Departamento');
$Excel->getActiveSheet()->setCellValue('B1', 'Ingresos Totales');

$celda = 2;
for ($n = 0; $n < count($lables); $n++) {
    $Excel->getActiveSheet()->setCellValue('A' . $celda, $lables[$n]);
    $Excel->getActiveSheet()->setCellValue('B' . $celda, $data[$n]);
    $celda = $celda + 1;
}
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=Clientes " . $fechaI . " - " . $fechaF . ".xls");
header('Cache-Control: max-age=0');
$writer = PHPExcel_IOFactory::createWriter($Excel, 'Excel5');
$writer->save('php://output');
