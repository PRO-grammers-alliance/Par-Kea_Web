function obtenerReportes() {
    //VACIAR TABLA
    let tbody = document.getElementById("content_table");
    if (tbody.hasChildNodes){
        while (tbody.firstChild) {
            tbody.firstChild.remove();
          }
    }
    //Mostrar mensaje de carga
    var elemento = document.getElementById("codigo");
    elemento.classList.add("visible");
    document.body.style.overflow = "hidden";

    //Traer Datos
    fetch('./php/reportes.php')
      .then(response => response.json())
      .then(data => {
        //VACIAR TABLA
        let tbody = document.getElementById("content_table");
        let thead = document.getElementById("head_table");
        if (tbody.hasChildNodes){
            while (tbody.firstChild) {
                tbody.firstChild.remove();
            }
        }
        if (thead.hasChildNodes){
            while (thead.firstChild) {
                thead.firstChild.remove();
            }
        }

        //CARGAR DATOS
        var fila=0;
        var columnaBody = 0;
        data.forEach(element => {
            if (thead.hasChildNodes){
                while (thead.firstChild) {
                    thead.firstChild.remove();
                }
            }
            Object.keys(element).forEach(function(value){
                let th = document.createElement("th");
                th.setAttribute("id", value +"-"+fila);
                th.textContent = value.replace("_", " ");
                thead.appendChild(th);
                ++fila;
            });
        });

        fila = 0;

        data.forEach(element => {
            let tr = document.createElement("tr");
            tr.setAttribute("id", "tr"+fila);
            tbody.appendChild(tr);
            Object.values(element).forEach(function(value){
                let tdTr = document.getElementById("tr" + fila);
                let td = document.createElement("td");
                td.setAttribute("id", columnaBody);
                td.textContent = value;
                tdTr.appendChild(td);
                ++columnaBody;
            });
            ++fila;
        });

        //Quitar mensaje de carga
        elemento.classList.remove("visible");
        document.body.style.overflow = "auto";
    }); 
    
    
}
window.onload = obtenerReportes();

function enableDate(){
    var checkDate = document.getElementById("filterDate");
    if(checkDate.checked){
        document.getElementById("filtroFecha").removeAttribute("disabled");
        document.getElementById("genGraf").removeAttribute("hidden");
        document.getElementById("departamento").setAttribute("disabled", "disabled");
        document.getElementById("departamento").value =0;
        document.getElementById("ciudad").setAttribute("disabled", "disabled");
        document.getElementById("ciudad").value =0;
        document.getElementById("grafica").setAttribute("hidden", "hidden");
        obtenerReportes();
    }
}

function datosFecha (){
    var fecha = document.getElementById("filtroFecha").value;
    //Mostrar mensaje de carga
    var elemento = document.getElementById("codigo");
    elemento.classList.add("visible");
    document.body.style.overflow = "hidden";
    fetch('./php/reportes.php?fecha=' + encodeURIComponent(fecha))
    .then(response => response.json())
    .then(data => {
      //VACIAR TABLA
        let tbody = document.getElementById("content_table");
        let thead = document.getElementById("head_table");
        if (tbody.hasChildNodes){
            while (tbody.firstChild) {
                tbody.firstChild.remove();
            }
        }
        if (thead.hasChildNodes){
            while (thead.firstChild) {
                thead.firstChild.remove();
            }
        }

        var fila=0;
        var columnaBody = 0;

        data.forEach(element => {
            if (thead.hasChildNodes){
                while (thead.firstChild) {
                    thead.firstChild.remove();
                }
            }
            Object.keys(element).forEach(function(value){
                let th = document.createElement("th");
                th.setAttribute("id", value +"-"+fila);
                th.textContent = value;
                thead.appendChild(th);
                ++fila;
            });
        });

        fila = 0;
        data.forEach(element => {
            let tr = document.createElement("tr");
            tr.setAttribute("id", "tr"+fila);
            tbody.appendChild(tr);
            Object.values(element).forEach(function(value){
                let tdTr = document.getElementById("tr" + fila);
                let td = document.createElement("td");
                td.setAttribute("id", columnaBody);
                td.textContent = value;
                tdTr.appendChild(td);
                ++columnaBody;
            });
            ++fila;
        });

        //Quitar mensaje de carga
        elemento.classList.remove("visible");
        document.body.style.overflow = "auto";
    })
}

function enableDpto(){
    var checkDate = document.getElementById("filterDepto");
    if(checkDate.checked){
        document.getElementById("departamento").removeAttribute("disabled");
        document.getElementById("ciudad").removeAttribute("disabled");
        document.getElementById("filtroFecha").setAttribute("disabled", "disabled");
        document.getElementById("filtroFecha").value ="";
        document.getElementById("genGraf").setAttribute("hidden", "hidden");
        obtenerReportes();
        document.getElementById("grafica").removeAttribute("hidden");
        document.getElementById("Indicador_bar").outerHTML="";
        var c2 = document.getElementById("cardBar");
        var canvas2 = document.createElement("canvas");
        canvas2.setAttribute("id","Indicador_bar");
        c2.appendChild(canvas2);
        document.getElementById("grafico").outerHTML="";
        var b=document.getElementById("body")
        var G=document.createElement("script");
        G.setAttribute("id","grafico");
        b.appendChild(G);
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("grafico").innerHTML = this.responseText;
            }
        }
        xmlhttp.open("POST", "./php/CantDepartamento.php",true);
        xmlhttp.send();
    }
}

function reportDepto(){
    var dpto = document.getElementById("departamento").value;
    if(dpto != 0){
        dpto = document.getElementById("departamento").value.split("-")[1];
        //Mostrar mensaje de carga
        var elemento = document.getElementById("codigo");
        elemento.classList.add("visible");
        document.body.style.overflow = "hidden";
        fetch('./php/reportes.php?dpto=' + encodeURIComponent(dpto))
        .then(response => response.json())
        .then(data => {
          //VACIAR TABLA
            let tbody = document.getElementById("content_table");
            let thead = document.getElementById("head_table");
            if (tbody.hasChildNodes){
                while (tbody.firstChild) {
                    tbody.firstChild.remove();
                }
            }
            if (thead.hasChildNodes){
                while (thead.firstChild) {
                    thead.firstChild.remove();
                }
            }
        
            var fila=0;
            var columnaBody = 0;
        
            data.forEach(element => {
                if (thead.hasChildNodes){
                    while (thead.firstChild) {
                        thead.firstChild.remove();
                    }
                }
                Object.keys(element).forEach(function(value){
                    let th = document.createElement("th");
                    th.setAttribute("id", value +"-"+fila);
                    th.textContent = value;
                    thead.appendChild(th);
                    ++fila;
                });
            });
        
            fila = 0;
            data.forEach(element => {
                let tr = document.createElement("tr");
                tr.setAttribute("id", "tr"+fila);
                tbody.appendChild(tr);
                Object.values(element).forEach(function(value){
                    let tdTr = document.getElementById("tr" + fila);
                    let td = document.createElement("td");
                    td.setAttribute("id", columnaBody);
                    td.textContent = value;
                    tdTr.appendChild(td);
                    ++columnaBody;
                });
                ++fila;
            });
        
            //Quitar mensaje de carga
            elemento.classList.remove("visible");
            document.body.style.overflow = "auto";
        })
    }else{
        obtenerReportes();
    }
    
    
}

function reportCiudad(){
    var ciudad = document.getElementById("ciudad").value;
    //Mostrar mensaje de carga
    if(ciudad != 0){
        var elemento = document.getElementById("codigo");
        elemento.classList.add("visible");
        document.body.style.overflow = "hidden";
        fetch('./php/reportes.php?ciudad=' + encodeURIComponent(ciudad))
        .then(response => response.json())
        .then(data => {
          //VACIAR TABLA
            let tbody = document.getElementById("content_table");
            let thead = document.getElementById("head_table");
            if (tbody.hasChildNodes){
                while (tbody.firstChild) {
                    tbody.firstChild.remove();
                }
            }
            if (thead.hasChildNodes){
                while (thead.firstChild) {
                    thead.firstChild.remove();
                }
            }
        
            var fila=0;
            var columnaBody = 0;
        
            data.forEach(element => {
                if (thead.hasChildNodes){
                    while (thead.firstChild) {
                        thead.firstChild.remove();
                    }
                }
                Object.keys(element).forEach(function(value){
                    let th = document.createElement("th");
                    th.setAttribute("id", value +"-"+fila);
                    th.textContent = value;
                    thead.appendChild(th);
                    ++fila;
                });
            });
        
            fila = 0;
            data.forEach(element => {
                let tr = document.createElement("tr");
                tr.setAttribute("id", "tr"+fila);
                tbody.appendChild(tr);
                Object.values(element).forEach(function(value){
                    let tdTr = document.getElementById("tr" + fila);
                    let td = document.createElement("td");
                    td.setAttribute("id", columnaBody);
                    td.textContent = value;
                    tdTr.appendChild(td);
                    ++columnaBody;
                });
                ++fila;
            });
            
            //Quitar mensaje de carga
            elemento.classList.remove("visible");
            document.body.style.overflow = "auto";
        })
    }
}

function graficas(){
    var fecha = document.getElementById("filtroFecha").value;
    var dpto = document.getElementById("departamento").value;
    if(fecha != ""){
        document.getElementById("grafica").removeAttribute("hidden");
        document.getElementById("Indicador_bar").outerHTML="";
        var c2 = document.getElementById("cardBar");
        var canvas2 = document.createElement("canvas");
        canvas2.setAttribute("id","Indicador_bar");
        c2.appendChild(canvas2);
        document.getElementById("grafico").outerHTML="";
        var b=document.getElementById("body")
        var G=document.createElement("script");
        G.setAttribute("id","grafico");
        b.appendChild(G);
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("grafico").innerHTML = this.responseText;
            }
        }
        xmlhttp.open("POST", "./php/IngresosPar.php?i="+fecha,true);
        xmlhttp.send();
    }else if(dpto != 0){
        dpto = document.getElementById("departamento").value.split("-")[1];
        document.getElementById("grafica").removeAttribute("hidden");
        document.getElementById("Indicador_bar").outerHTML="";
        var c2 = document.getElementById("cardBar");
        var canvas2 = document.createElement("canvas");
        canvas2.setAttribute("id","Indicador_bar");
        c2.appendChild(canvas2);
        document.getElementById("grafico").outerHTML="";
        var b=document.getElementById("body")
        var G=document.createElement("script");
        G.setAttribute("id","grafico");
        b.appendChild(G);
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("grafico").innerHTML = this.responseText;
            }
        }
        xmlhttp.open("POST", "./php/CantDepartamento.php?dpto="+dpto,true);
        xmlhttp.send();
    }else{
        enableDpto();
    }
    
}

function limpiar(){
    document.getElementById("filtroFecha").setAttribute("disabled", "disabled");
    document.getElementById("filtroFecha").value ="";
    document.getElementById("genGraf").setAttribute("hidden", "hidden");
    document.getElementById("grafica").setAttribute("hidden", "hidden");
    document.getElementById("departamento").setAttribute("disabled", "disabled");
    document.getElementById("departamento").value =0;
    document.getElementById("ciudad").setAttribute("disabled", "disabled");
    document.getElementById("ciudad").value =0;
    document.getElementById("filterDate").checked = false;
    document.getElementById("filterDepto").checked = false;
    obtenerReportes();
}