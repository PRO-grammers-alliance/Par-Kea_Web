<?php
error_reporting (0);
//$BD = "54.190.55.127";
// $User = "fidelissa_2017";
// $Passwd = "f1d3l1ss4crm_2017";
// $BDName = "FidelissaCRM";
$BD = "localhost";
$User = "root";
$Passwd = "12345";
$BDName = "ingsoft2";

$link = mssql_connect($BD, $User, $Passwd)
    or die("No se conecto  server'");
mssql_select_db($BDName)
    or die("No se conecto  BD");
?>