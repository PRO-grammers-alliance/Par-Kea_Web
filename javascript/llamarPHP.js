function llamarFuncionPHP() {
    fetch('./php/generarCodigo.php')
      .then(response => response.text())
      .then(data => {
        console.log(data);
        document.getElementById('resultado').innerHTML = data;
        //Mostrar Codigo
        var elemento = document.getElementById("codigo");
        elemento.classList.add("visible");
        document.body.style.overflow = "hidden";
    });
}

function ocultarElemento() {
    var elemento = document.getElementById("codigo");
    elemento.classList.remove("visible");
    document.body.style.overflow = "auto";
}