fetch('https://raw.githubusercontent.com/marcovega/colombia-json/master/colombia.min.json')
  .then(response => response.json())
  .then(data => {
    var selectDepto = document.getElementById("depto");
    var i = 1;
    data.forEach(element => {
        var opcionesDepto = document.createElement("option");
        opcionesDepto.value = element["departamento"];
        opcionesDepto.id = i;
        opcionesDepto.textContent = element["departamento"];
        i++;
        selectDepto.appendChild(opcionesDepto);
    });
    selectDepto.onchange = function(){
        var deptoSelected = selectDepto.value;
        var selectCiudad = document.getElementById("ciudad");
        var numOption = selectCiudad.options.length;
        if (numOption > 1){
            for(var j = 1; j < numOption; j++){
                selectCiudad.remove(1);
            }
        }
        var k = 0;
        var id;
        data.forEach(element => {
            if (element["departamento"] === deptoSelected){
                id = k;
                var idCiudad = 1;
                data[id]["ciudades"].forEach(datos =>{
                    var opcionesCiudad = document.createElement("option");
                    opcionesCiudad.value = datos;
                    opcionesCiudad.id = idCiudad;
                    opcionesCiudad.textContent = datos;
                    idCiudad++;
                    selectCiudad.appendChild(opcionesCiudad);
                })
            }
            k++;
        });
    }
  })
  .catch(error => {
    console.error('Error:', error);
  });
