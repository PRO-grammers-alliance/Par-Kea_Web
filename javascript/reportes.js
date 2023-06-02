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
        //CARGAR DATOS
        var fila=0;
        var columnaBody = 0;
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
    }else{
        document.getElementById("filtroFecha").setAttribute("disabled", "disabled");
        document.getElementById("filtroFecha").value ="";
        obtenerReportes();
    }
}

document.getElementById("filtroFecha").onchange = function (){
    var fecha = document.getElementById("filtroFecha").value;
    fetch('./php/reportes.php?fecha=' + encodeURIComponent(fecha))
    .then(response => response.text())
    .then(data => {
        console.log(data);
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
        //Mostrar mensaje de carga
        var elemento = document.getElementById("codigo");
        elemento.classList.add("visible");
        document.body.style.overflow = "hidden";

        var fila=0;
        var columnaBody = 0;

        data.forEach(array => {
            console.log(array);
        })
        // data.forEach(element => {
        //     Object.vaules(element).forEach(function(value){
        //         let th = document.createElement("th");
        //         th.setAttribute("id", fila);
        //         th.textContent = value;
        //         thead.appendChild(th);
        //         ++fila;
        //     });
        // });

        fila = 0;
        data.forEach(element => {
            let tr = document.createElement("tr");
            tr.setAttribute("id", "tr"+fila);
            tbody.appendChild(tr);
            Object.keys(element).forEach(function(value){
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