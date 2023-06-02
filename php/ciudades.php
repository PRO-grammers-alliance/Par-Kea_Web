<?php
	$ciudad = $_REQUEST["departamento"];
    require("./BD.php");
	$query = "SELECT id_CodeCiudades, st_Ciudades FROM cat_Ciudades WHERE id_CodeDepartamento=".$ciudad."";
	$consulta = mssql_query($query,$link) or die("primera consulta f");
	$K=0;
	if ($consulta) {
		while ($resul = mssql_fetch_array($consulta)) {
			$data .='{"key":"'.$resul['id_CodeCiudades'].'","name":"'.$resul['st_Ciudades'].'"},';			
		}
	}
	mssql_free_result($consulta);
	$data = substr($data,0,-1);
    echo '{"flagerror":0,"message":"Datos OK","ObjResult":{"ciudades":['.$data.']}}';
