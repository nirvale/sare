$(document).ready(function(){
  $('#consultaUsuarios').click(function(event){
    event.preventDefault();
    var tablaUsuarios = $('#tablaUsuarios').DataTable();
    tablaUsuarios.destroy();
    $('#tablaUsuarios').DataTable({
          "language": {
                "url": "/sare/vendor/DataTables/lang/Spanish.json"
          },
          "responsive": true,
          "processing": true,
        //"serverSide": true,
          "ajax":{
             "url": "usuario",
             "type": 'GET',
             //"dataType": 'json',
             "data":{
               // al_id:{{ Auth::user()->id }},
             }
          },
          "columns":[
             {"data": "id" },
             {"data": "name" },
             // {"data": "empr_rfc" },
             {"data": "oficina" },
             {"data": "perfil" },
             {"data": "estado" },
             {"data": "action", className: 'dt-center', },
             //{"data": "empeval_cantidad_espacios" },
            //{"defaultContent":   "accion",
              // render: function ( data, type, row ) {
              //     if ( type === 'display' ) {
              //         return '<input type="checkbox" id="'+row.empr_id+'" class="editor-active">';
              //     }
              //     return data;
              // }
             //}
          ],
      });
});

$(document).on("click", "#editarusuario", function(){
  event.preventDefault();
  //para tabla responsive
  var fila = $(this.closest("tr"));
  if(fila.hasClass("child")){
    var  fila = fila.prev();
  }
  //console.log(fila.find('td:eq(0)').text()); // returning array of row data
  //var fila = $(this).closest("tr"); // tabla estática
  var id = fila.find('td:eq(0)').text();
  var ofi = fila.find('td:eq(2)').text();
  var perf = fila.find('td:eq(3)').text();
  var est = fila.find('td:eq(4)').text();
  $('#modalc1').empty();
  $('#modalc2').empty();
  $('#footermodal').empty();

  $.ajax({
    url: "usuario/"+id,
    type: 'GET',
    // async: false,
    dataType: 'json',
    data: {
        // _token: $('input[name="_token"]').val(),
        // enco_id:enco_id,

    },
    success: function(response) {

      console.log(response);

      //construir forma
        var id =  "<div class='form-group col-md-12 ml-auto'> <input value='"+response[0][0].id+"' name='id' type='text' id='id' class='form-control validate' hidden></div> ";
        var nombre =  "<div class='form-group col-md-12 ml-auto'><label data-error='error' data-success='ok' for='cmb_nombre'>nombre</label> <input value='"+response[0][0].name+"' name='nombre' type='text' id='nombre' class='form-control validate' placeholder='Nombre del usuario'></div> ";
        var email =  "<div class='form-group col-md-12 ml-auto'><label data-error='error' data-success='ok' for='cmb_nombre'>correo</label> <input value='"+response[0][0].email+"' name='email' type='email' id='email' class='form-control validate' placeholder='Correo electrónico...'></div> ";
        var oficina =  ("<div class='form-group col-md-12 ml-auto'><label data-error='error' data-success='ok' for='sel'>oficina</label> <select class='form-control select2' id='selOficina' name='cve_oficina'><option value='' disabled selected>Seleciona una oficina...</option>");
        var perfil =  ("<div class='form-group col-md-12 ml-auto'><label data-error='error' data-success='ok' for='sel'>perfil</label> <select class='form-control select2' id='selPerfil' name='id_perfil'><option value='' disabled selected>Seleciona un perfil...</option>");
        var estado =  ("<div class='form-group col-md-12 ml-auto'><label data-error='error' data-success='ok' for='sel'>estado</label> <select class='form-control select2' id='selEstado' name='cve_estado'><option value='' disabled selected>Seleciona un estado de usuario...</option>");
        var pwd =  "<div class='form-group col-md-12 ml-auto'><label data-error='error' data-success='ok' for='cmb_nombre'>password</label> <input value='' name='pwd' type='text' id='pwd' class='form-control validate' placeholder='Contraseña...'></div> ";
        var footermodal = "<button class='btn btn-success' id='updateUsuario' >Guardar</button><button class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>";
        // var footermodal = "<button class='btn btn-success' id='updateUsuario' >Guardar</button><button class='btn btn-warning' id='printEvaluacion' onclick='PrintContent()' >Imprimir</button><button class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>";

        $('#tituloModal').html("<i class='fas fa-user-edit'></i> - Editar Usuario ");
        $("#modalc1").append(nombre);
        $("#modalc1").append(oficina);
        console.log(response[2].oficina);
        for (var j = 0; j < response[2].length; j++) {
            if (ofi == response[2][j].oficina) {
              var selected= 'selected';
            }else {
              var selected= '';
            }
            $("#selOficina").append("<option value='"+response[2][j].cve_oficina+"' "+selected+ ">"+response[2][j].oficina+"</option>");
          }
        $("#modalc1").append(perfil);
        for (var j = 0; j < response[3].length; j++) {
            if (perf == response[3][j].name) {
              var selected= 'selected';
            }else {
              var selected= '';
            }
            $("#selPerfil").append("<option value='"+response[3][j].id+"' "+selected+ ">"+response[3][j].name+"</option>");
          }
        $("#modalc1").append(estado);
        for (var j = 0; j < response[1].length; j++) {
            if (est == response[1][j].estado) {
              var selected= 'selected';
            }else {
              var selected= '';
            }
            $("#selEstado").append("<option value='"+response[1][j].cve_estado+"' "+selected+ ">"+response[1][j].estado+"</option>");
          }
        $("#modalc1").append(email);
        $("#modalc1").append(pwd);
        $("#footermodal").append(footermodal);
        $("#footermodal").append(id);
      //fin construir la forma

      $('#modalusuario').modal('show');
      $('#modalusuario').on('hide.bs.modal', function () {
      //  alertify.warning('Edición Cancelada');
      });

    },
    error: function(response) {
        console.log(response);
    },
  });
});

$(document).on("click", "#updateUsuario", function(){
  event.preventDefault();

  var data = new FormData(document.getElementById("form-usuario"));

  data.append('_method', 'PUT');


  for (var value of data.values()) {
    console.log(value);
  }
  alertify.minimalDialog || alertify.dialog('minimalDialog',function(){
    return {
        main:function(content){
            this.setContent(content);
        }
    };
  });
  alertify.confirm('ACTUALIZACIÓN DE DATOS DE USUARIO ','Actuaizar usuario: '+data.get('nombre')+'', function(){

    $.ajax({
      url: "usuario/"+data.get('id'),
      type: 'POST',
      // headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
      processData: false,
      contentType: false,
      dataType: 'json',
      cache:false,
      data:data,

      success: function(response) {
        //validando formulario
        if(response.errors)
        {


          $.each(response.errors, function(key, value){
            var msg = alertify.error(value+"<br><button class='btn btn-danger'>Cerrar</button>",10000);
            msg.callback = function (isClicked) {
                    if(isClicked)
                        console.log('notification dismissed by user');
                    else
                        console.log('notification auto-dismissed');
            };
          });
          $(response.errors).empty();
        }
        else
        {
          $('#modalusuario').modal('hide');
          alertify.success ("Actualizado con éxito: <br>"+data.get('nombre'));
          if ($('.sorting_1').length)
          {
            $('#tablaUsuarios').DataTable().ajax.reload();
          }
          console.log(response);
        }


      },
      error: function(response) {

        alertify.error("Error actualizando usuario: <br>"+data.get('nombre'));
          for (var value of data.values()) {
            console.log(value);
            }
        console.log(response);
      //  console.log(xhr.status);
      //  console.log(xhr.responseText);
      //  console.log(thrownError);

      },
    });

  },function(){


    alertify.error('Actualización Cancelada')

  });

});


$(document).on("click", "#agregarUsuario", function(){
  event.preventDefault();
  $('#modalc1').empty();
  $('#modalc2').empty();
  $('#footermodal').empty();

  $.ajax({
    url: "usuario/create",
    type: 'GET',
    // async: false,
    dataType: 'json',
    data: {
        // _token: $('input[name="_token"]').val(),
        // enco_id:enco_id,

    },
    success: function(response) {

      console.log(response);

      //construir forma
        //id =  "<div class='form-group col-md-12 ml-auto'> <input value='"+response[0][0].id+"' name='id' type='text' id='id' class='form-control validate' hidden></div> ";
        var nombre =  "<div class='form-group col-md-12 ml-auto'><label data-error='error' data-success='ok' for='cmb_nombre'>nombre</label> <input value='' name='nombre' type='text' id='nombre' class='form-control validate' placeholder='Nombre del usuario...'></div> ";
        var oficina =  ("<div class='form-group col-md-12 ml-auto'><label data-error='error' data-success='ok' for='sel'>oficina</label> <select class='form-control select2' id='selOficina' name='cve_oficina'><option value='' disabled selected>Seleciona una oficina...</option>");
        var perfil =  ("<div class='form-group col-md-12 ml-auto'><label data-error='error' data-success='ok' for='sel'>perfil</label> <select class='form-control select2' id='selPerfil' name='id_perfil'><option value='' disabled selected>Seleciona un perfil...</option>");
        var estado =  ("<div class='form-group col-md-12 ml-auto'><label data-error='error' data-success='ok' for='sel'>estado</label> <select class='form-control select2' id='selEstado' name='cve_estado'><option value='' disabled selected>Seleciona un estado de usuario...</option>");
        var email =  "<div class='form-group col-md-12 ml-auto'><label data-error='error' data-success='ok' for='cmb_nombre'>correo</label> <input value='' name='email' type='email' id='email' class='form-control validate' placeholder='Correo electrónico...'></div> ";
        var pwd =  "<div class='form-group col-md-12 ml-auto'><label data-error='error' data-success='ok' for='cmb_nombre'>password</label> <input value='' name='pwd' type='text' id='pwd' class='form-control validate' placeholder='Contraseña...'></div> ";
        var footermodal = "<button class='btn btn-success' id='createUsuario' >Crear</button><button class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>";

        $('#tituloModal').html("<i class='fas fa-user-plus'></i> - Agregar Usuario ");
        $("#modalc1").append(nombre);
        $("#modalc1").append(oficina);
        for (var j = 0; j < response[1].length; j++) {

            $("#selOficina").append("<option value='"+response[1][j].cve_oficina+"' "+">"+response[1][j].oficina+"</option>");
          }
        $("#modalc1").append(perfil);
        for (var j = 0; j < response[2].length; j++) {

            $("#selPerfil").append("<option value='"+response[2][j].id+"' "+">"+response[2][j].name+"</option>");
          }
          $("#modalc1").append(estado);
          for (var j = 0; j < response[0].length; j++) {

              $("#selEstado").append("<option value='"+response[0][j].cve_estado+"' "+">"+response[0][j].estado+"</option>");
            }
        $("#modalc1").append(email);
        $("#modalc1").append(pwd);
        $("#footermodal").append(footermodal);
        //$("#footermodal").append(id);
      //fin construir la forma

      $('#modalusuario').modal('show');
      $('#modalusuario').on('hide.bs.modal', function () {
      //  alertify.warning('Edición Cancelada');
      });

    },
    error: function(response) {
        console.log(response);
    },
  });
});

$(document).on("click", "#createUsuario", function(){
  event.preventDefault();

  var data = new FormData(document.getElementById("form-usuario"));

  //data.append('_method', 'PUT');


  for (var value of data.values()) {
    console.log(value);
  }
  alertify.minimalDialog || alertify.dialog('minimalDialog',function(){
    return {
        main:function(content){
            this.setContent(content);
        }
    };
  });
  alertify.confirm('CREAR NUEVO USUARIO ','Se va a crear el siguiente usuario: '+data.get('nombre')+'', function(){

    $.ajax({
      url: "usuario",
      type: 'POST',
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      processData: false,
      contentType: false,
      dataType: 'json',
      cache:false,
      data:data,

      success: function(response) {
        //validando formulario
        if(response.errors)
        {


          $.each(response.errors, function(key, value){
            var msg = alertify.error(value+"<br><button class='btn btn-danger'>Cerrar</button>",10000);
            msg.callback = function (isClicked) {
                    if(isClicked)
                        console.log('notification dismissed by user');
                    else
                        console.log('notification auto-dismissed');
            };
          });
          $(response.errors).empty();
        }
        else
        {
          $('#modalusuario').modal('hide');
          alertify.success ("Se creo con éxito: <br>"+data.get('nombre'));

            $('#tablaUsuarios').DataTable({
                  "language": {
                        "url": "/sare/vendor/DataTables/lang/Spanish.json"
                  },
                  "responsive": true,
                  "processing": true,
                //"serverSide": true,
                  "ajax":{
                     "url": "usuario",
                     "type": 'GET',
                     //"dataType": 'json',
                     "data":{
                       // al_id:{{ Auth::user()->id }},
                     }
                  },
                  "columns":[
                     {"data": "id" },
                     {"data": "name" },
                     // {"data": "empr_rfc" },
                     {"data": "oficina" },
                     {"data": "perfil" },
                     {"data": "estado" },
                     {"data": "action", className: 'dt-center', },
                     //{"data": "empeval_cantidad_espacios" },
                    //{"defaultContent":   "accion",
                      // render: function ( data, type, row ) {
                      //     if ( type === 'display' ) {
                      //         return '<input type="checkbox" id="'+row.empr_id+'" class="editor-active">';
                      //     }
                      //     return data;
                      // }
                     //}
                  ],
              });

          console.log(response);
        }


      },
      error: function(response) {

        alertify.error("Error creando usuario: <br>"+data.get('nombre'));
          for (var value of data.values()) {
            console.log(value);
            }
        console.log(response);
      //  console.log(xhr.status);
      //  console.log(xhr.responseText);
      //  console.log(thrownError);

      },
    });

  },function(){


    alertify.error('Creacion Cancelada')

  });

});

$(document).on("click", "#eliminarusuario", function(){
  event.preventDefault();

  var fila = $(this).closest("tr");
  var id = fila.find('td:eq(0)').text();
  var nombre = fila.find('td:eq(1)').text();
  alertify.minimalDialog || alertify.dialog('minimalDialog',function(){
    return {
        main:function(content){
            this.setContent(content);
        }
    };
  });
  alertify.confirm('ELIMINACIÓN DE DATOS DE USUARIO ','Eliminar usuario: '+nombre+'', function(){

    $.ajax({
      url: "usuario/"+id ,
      type: 'DELETE',
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      processData: false,
      contentType: false,
      dataType: 'json',
      cache:false,
    //  data:data,

      success: function(response) {
        //validando formulario
        if(response.errors)
        {


          $.each(response.errors, function(key, value){
            var msg = alertify.error(value+"<br><button class='btn btn-danger'>Cerrar</button>",10000);
            msg.callback = function (isClicked) {
                    if(isClicked)
                        console.log('notification dismissed by user');
                    else
                        console.log('notification auto-dismissed');
            };
          });
          $(response.errors).empty();
        }
        else
        {
          $('#modalusuario').modal('hide');
          alertify.success ("Se eliminó con éxito: <br>"+nombre );
          if ($('.sorting_1').length)
          {
            $('#tablaUsuarios').DataTable().ajax.reload();
          }
          console.log(response);
        }


      },
      error: function(response) {

        alertify.error("Error eliminando usuario: <br>"+nombre );

        console.log(response);
      //  console.log(xhr.status);
      //  console.log(xhr.responseText);
      //  console.log(thrownError);

      },
    });

  },function(){


    alertify.error('Eliminación Cancelada');

  });

});



});
