
///////////////////////////////////////login 
function login(){
  $("#btnLogin").attr('disabled', true);
  var error = 0;
  
  if ($("#user").val() == "" && error == 0) {
    alertForm('user', 'Ingresa el usuario ');
    error = 1;
  }

  if ($("#password").val() == "" && error == 0) {
    alertForm('password', 'Ingresa la contraseña ');
    error = 1;
  }

  if(error == 0){
    var datos = new FormData($("#formDataLogin")[0]);
    $("#btnLogin").attr('disabled', true);
    $.ajax({
      url: "../src/class/stg.php",
      type: 'POST',
      dataType: 'JSON',
      cache: false,
      contentType: false,
      processData: false,
      data: datos,
      beforeSend: function (objeto) {
        $(".loader").show();
      },
      success: function (response) {
        $("#btnLogin").attr("disabled", false);
        $(".loader").hide();
        if (response.flagerror == 1) {
          alertError(response.message, '');
        } else if (response.flagerror == 0) {
          location = "./perfil.php";
          ///alertOk('¡Muy bien!',response.message,'location.reload();');
        }
      }
    });
  }else{
    $("#btnLogin").attr("disabled", false);
  }
}



//////////////////////////// recover Password 1 


function recover(){
  $("#btnRecover").attr('disabled', true);
   var error = 0;

   if ($("#userRecover").val() == "" && error == 0) {
     alertForm('user', 'Ingresa el usuario ');
     error = 1;
   }

   if(error == 0){
     var datos = new FormData($("#formRecover")[0]);
     $("#bbtnRecover").attr('disabled', true);
     $.ajax({
       url: "../src/class/stg.php",
       type: 'POST',
       dataType: 'JSON',
       cache: false,
       contentType: false,
       processData: false,
       data: datos,
       beforeSend: function (objeto) {
         $(".loader").show();
       },
       success: function (response) {
         $("#btnRecover").attr("disabled", false);
         $(".loader").hide();
         if (response.flagerror == 1) {
           alertError(response.message, '');
         } else if (response.flagerror == 0) {
           alertOk('¡Muy bien!',response.message,'location.reload();');
         }
       }
     });
   }else{
     $("#btnRecover").attr("disabled", false);
   }
}





// ------------------------------------- Funciones ^^^^^^^----------------------------------

function ValidEmail(mail){
	return /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(mail);
}
function isNumberVal(evt) {
  var charCode = (evt.which) ? evt.which : event.keyCode
  if (charCode > 31 && (charCode < 48 || charCode > 57))
    return false;

  return true;
}
// -----------------------------> FUNCIONES SWEET ALERT <-------------------------------------
function alertConfirm(title, message, action) {
  Swal.fire({
    title: title,
    text: message,
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Continuar',
    cancelButtonText: 'Cancelar',
    reverseButtons: true
  }).then((result) => {
    if (result.value) {
      eval(action);
    }
  })
}
function alertOk(title, message, action) {
  Swal.fire({
    title: title,
    text: message,
    type: 'success',
    reverseButtons: true
  }).then((result) => {
    if (result.value) {
      eval(action);
    }
  })
}
function alertForm(id, message) {
  Swal.fire({
    type: 'error',
    title: 'Datos incompletos',
    text: message,
    confirmButtonColor: 'red',
    confirmButtonText: 'ACEPTAR',
    //footer: '<a href>Why do I have this issue?</a>',
    reverseButtons: true
  }).then((result) => {
    if (result.value) {
      setTimeout("$('#" + id + "').focus()", 1000);
    }
  })
}
function alertError(message, action) {
  Swal.fire({
    type: 'error',
    title: 'Error',
    confirmButtonColor: 'red',
    confirmButtonText: 'ACEPTAR',
    text: message,
    //footer: '<a href>Why do I have this issue?</a>',
    reverseButtons: true
  }).then((result) => {
    if (result.value) {
      eval(action);
    }
  })
}
// -----------------------------> FIN FUNCIONES SWEET ALERT <-------------------------------------