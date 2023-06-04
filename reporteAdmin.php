<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REPORTES ADMINISTRADOR</title>
    <!--Conexión con Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/estilosCod.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="./js/jquery/jquery-3.6.0.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="./js/jquery/jquery.dataTables.js" type="text/javascript" charset="utf-8"></script>
    <script src="./js/jquery/jquery-ui-1.10.4.js" type="text/javascript" charset="utf-8"></script>
    <script src="./js/jquery/jquery.alerts.js" type="text/javascript" charset="utf-8"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
</head>

<body id="body">
    <div class="container">
        <div class="row">
            <span class="col-sm-6">
                <a href="" id="des_excel">Descargar Excel</a>
            </span>
            <div class="flotante2" class="col-sm-6">
                <div class="row">
                    <div class="col-12 col-sm mb-4 mb-sm-0  text-center v-line position-relative">
                        <img src="./assets/imgs/parq.png" width="490" height="300" style="border-radius: 1.875em;">
                    </div>
                    <div class="col-sm-12">
                        <div class="d-grid gap-1">
                            <h4>Adiministrador</h4>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-3">
                        <button class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#filtros">VER FILTROS</button>
                        <div id="filtros" class="collapse">
                            <form class="mt-3">
                                <div class="form-check input-group">
                                    <label class="form-check-label">
                                        <input class="form-check-input" id="filterDate" onclick="enableDate()" type="radio" name="filtro">FILTRAR POR FECHA
                                    </label>
                                    <input type="date" name="" id="filtroFecha" class="form-control" min="2023-01-01" onchange="datosFecha()" disabled>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label class="form-check-label">
                                            <input class="form-check-input" id="filterDepto" type="radio" name="filtro" onclick="enableDpto()">VER POR DEPARTAMENTO
                                        </label>
                                        <select class="form-select-sm" id="departamento" name="departamento" disabled>
                                            <option value="0">Seleccione Departamento...</option>
                                            <?php
                                            require("./php/BD.php");
                                            $qryp = "SELECT id_CodeDepartamento,st_NombreDepartamento FROM cat_Departamentos WHERE id_Status=1";
                                            $resp = mssql_query($qryp, $link);
                                            while ($rowp = mssql_fetch_object($resp)) {
                                                echo  "<option value='" . $rowp->id_CodeDepartamento . "-" . $rowp->st_NombreDepartamento . "'>" . utf8_encode($rowp->st_NombreDepartamento) . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-check-label">
                                            VER POR CIUDAD
                                        </label>
                                        <select class="form-select-sm" id="ciudad" name="ciudad" onchange="reportCiudad()" disabled>
                                            <option value="0">Seleccione Ciudad...</option>
                                        </select>
                                    </div>
                                </div>
                                <div style="text-align: center;">
                                    <button class="btn btn-primary" onclick="limpiar()">LIMPIAR FILTRO</button>
                                </div>
                            </form>
                            <button class="btn btn-primary" onclick="graficas()">GENERAR GRAFICAS</button>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <table id="tablaReporte" class="table table-active table-bordered table-striped">
                            <thead>
                                <tr id="head_table">
                                </tr>
                            </thead>
                            <tbody id="content_table" style="font-size: 14px;">

                            </tbody>
                        </table>
                    </div>
                    <div class="col-sm-12 mt-3">
                        <a href="./admin.html"><button type="button" class="btn btn-danger" name="submit">Volver</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section id="grafica">
        <!-- <div class="container">
            <div class="row">
                <div class="col-lg-12 mb-6 mb-lg-0">
                    <div class="card shadow">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h3 class="h6 mb-0 font-weight-bold">Indicadores</h3>
                            <h3 class="h6 mb-0 font-weight-bold">Total :<span id="total"></span></h3>
                        </div>
                        <div style="background-color: #ffffff;" class="card-body p-1" id="cardLine">
                            <canvas id="Indicador_line"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mb-6 mb-lg-0">
                    <div class="card shadow">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h3 class="h6 mb-0 font-weight-bold">Indicadores</h3>
                            <h3 class="h6 mb-0 font-weight-bold">Total :<span id="total"></span></h3>
                        </div>
                        <div style="background-color: #ffffff;" class="card-body p-1" id="cardBar">
                            <canvas id="Indicador_bar"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div id="codigo">
        <div class="elemento col-sm-3 text-center" style="background-color: white; padding: 16px;">
            <h3>Cargando datos...</h3>
            <div class="spinner-border text-secondary"></div>
        </div>
    </div>
    <script>
        //Limites de la entrada de fecha
        function date_ddmmmyy(date) {
            var d = date.getDate();
            var m = date.getMonth() + 1;
            var y = date.getFullYear();
            return "" + y + "-" + (m < 10 ? "0" + m : m) + "-" + (d < 10 ? "0" + d : d);
        }
        s = "" + date_ddmmmyy(new Date());

        document.getElementById("filtroFecha").setAttribute("max", s);
    </script>
    <script>
        $(document).ready(function() {
            $("#departamento").on("change", function() {
                var departamento = $(this).val();
                var departamentoID = departamento.split("-")[0];
                if (departamentoID > 0) {
                    reportDepto();
                    var datos = new FormData();
                    datos.append('type', 2);
                    datos.append('departamento', departamentoID);
                    $.ajax({
                        url: "./php/ciudades.php",
                        type: 'POST',
                        dataType: 'JSON',
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: datos,
                        beforeSend: function(objeto) {
                            $(".loader").show();
                        },
                        success: function(response) {
                            $(".loader").hide();
                            if (response.flagerror == 1) {
                                alertError(response.message, '');
                            } else if (response.flagerror == 0) {
                                var datahtml = '<option value="0">Seleccione</option>';
                                var ciudades = response.ObjResult.ciudades;
                                if (ciudades.length > 0) {
                                    $.each(ciudades, function(index, ciudades) {
                                        datahtml += '<option value="' + ciudades.name + '">' + ciudades.name + '</option>';
                                    });
                                }

                                $("#ciudad").html(datahtml);
                            }
                        }
                    });
                }
            });
        });
    </script>
    <script id="grafico">
        let lables = "";
        let data = "";
    </script>
    <script>
        // Note: changes to the plugin code is not reflected to the chart, because the plugin is loaded at chart construction time and editor changes only trigger an chart.update().
        const plugin = {
            id: 'custom_canvas_background_color',
            beforeDraw: (chart) => {
                const {
                    ctx
                } = chart;
                ctx.save();
                ctx.globalCompositeOperation = 'destination-over';
                ctx.fillStyle = 'white';
                ctx.fillRect(0, 0, chart.width, chart.height);
                ctx.restore();
            }
        };
    </script>
    <script src="js/reportes.js"></script>
    <!-- BOOTSTRAP -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>