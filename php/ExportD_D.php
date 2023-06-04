<?php
$fecha = $_REQUEST["i"];
$arreglo_lables = $_REQUEST["arl"];
$arreglo_data = $_REQUEST["ard"];
$lables = explode(',', $arreglo_lables);
$data = explode(',', $arreglo_data);

require('./Excel/PHPExcel.php');
$Excel = new PHPExcel();
$Excel->getProperties()->setCreator('Programmer aliance Reportes')
    ->setTitle('Clientes ' . $fecha)
    ->setDescription('Reporte Ingresos por Departamento');

$Excel->setActiveSheetIndex(0);
$Excel->getActiveSheet()->setTitle('Clientes por Departamentos');
$Excel->getActiveSheet()->setCellValue('A1', 'Departamento');
$Excel->getActiveSheet()->setCellValue('B1', 'Total Ingresos');

$celda = 2;
for ($n = 0; $n < count($lables); $n++) {
    $Excel->getActiveSheet()->setCellValue('A' . $celda, $lables[$n]);
    $Excel->getActiveSheet()->setCellValue('B' . $celda, $data[$n]);
    $celda = $celda + 1;
}
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=Clientes_" . $fecha . ".xls");
header('Cache-Control: max-age=0');
$writer = PHPExcel_IOFactory::createWriter($Excel, 'Excel5');
$writer->save('php://output');
