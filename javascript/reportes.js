function obtenerReportes() {
    fetch('./php/reportes.php')
      .then(response => response.json())
      .then(data => {
        var fila=0;
        data.forEach(element => {
            let tbody = document.getElementById("content_table");
            let tr = document.createElement("tr");
            tr.setAttribute("id", "tr"+fila);
            tbody.appendChild(tr);
            var columnaBody = 0;
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
    });
}
window.onload = obtenerReportes();