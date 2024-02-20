
$( document ).ready(function() {

/* sCRIPT PARA CATALOGO */
var switche; //switch a edición
var estaCelda;
var estaCeldaTexto;
var row;
var catActual; // valor nuevo default indefinido o nullo
var data;
var idt; //index de la tabla DENTRO DE MODULO EDICIÓN
var clicken; //bandera de cambio en input [0=fuera, 1=dentro]
var mainid; //clave del registro a actualizar
var workid; // clave de registro donde se hace click
const IDT='#'+$('table.dataTable').attr('id'); // ID DE LA TABLA GENERAL
const modelos= IDT.toLowerCase().slice(4);
const modelo = modelos.slice(0,-1);

//console.log('este es el modelo : '+modelo);
  function cleanvars(){
    switche = undefined; //switch a edición
    estaCelda = undefined;
    estaCeldaTexto = undefined;
    row = undefined;
    catActual = undefined; // valor nuevo default indefinido o nullo
    data = undefined;
    idt = undefined; //index de la tabla
    clicken = undefined; //bandera de cambio en input [0=fuera, 1=dentro]
    mainid = undefined;
  console.log('variables limpiadas');
  };
  $(IDT).on('click','td', function(){
  //var fila = $(this).closest('tr');
  workid = $(this).closest('tr').find('td:eq(0)').text();
  // closest(selector) busca el elemento con el selector indicado más cercano a $(this)
  // Luego te traes el dato 'id' del tr con la función attr(dato)
console.log(workid+'dfsdfsdfasdfasdfads');
});

  $('html').click(function (clickp){
    clickp.preventDefault();
    console.log('se detecto click');
    var claseclick = clickp.target.className.trim();
    //console.log('esta es '+claseclick);
    if (claseclick == 'catEditable' || claseclick == 'catEditable sorting_1') {
      console.log('sí es la clase que busco - catEditable');
      if (clickp.target.offsetParent.id != null && clickp.target.offsetParent.id == IDT.slice(1)) {
            idt = IDT;
            //idt ="#"+clickp.target.offsetParent.id;
            //idt ="#"+clickp.target.offsetParent.id+"_wrapper";
            console.log('el id del elemenoto padre de la seleccion es IGUAL, IDT: '+ IDT.slice(1)+ '= idt: '+clickp.target.offsetParent.id);
            console.log('esta es id de la tabla despues del click: '+idt);
            //console.log(clickp.target.parentElement.firstChild.outerText);
            console.log(mainid+'--1--'+workid);
                if (!mainid) {

                          row = $(clickp.target.parentElement);
                          // estaCelda = row.find("td:nth-child(2)");  //original
                          estaCelda = $(clickp.target);
                          estaCeldaTexto = clickp.target.outerText;
                          mainid = clickp.target.parentElement.firstChild.innerText;

                          //console.log(estaCelda);
                        //se obtuvieron las variables de renglon
                        // se agrega la clase disparadora
                          switche = 1;
                          $(IDT).addClass("tabEditando");
                          estaCelda.removeClass('catEditable');
                          estaCelda.addClass('catEditando');
                          console.log('se agrego clase disparadora, fin stage 1');
                          //se crea la forma para actualizar el indiceRenglon
                          data= new FormData(); //creamos la forma
                          data.append('id',mainid);
                          data.append('catOriginal',estaCeldaTexto);
                          //inyectamos forma
                          estaCelda.empty().append(
                            "<input value='"+estaCeldaTexto+"'  name='nobjeto' type='text' id='nobjeto' class='form-control validate cambiarCatEditable' placeholder='Nombre del nuevo objeto'>"
                          );
                          console.log('se inyecto el campo editabla en la tabla');


              }else if (clickp.target.id != 'nobjeto' && $(IDT).hasClass("tabEditando") && switche == 1 && mainid != workid) {
                      console.log(mainid+'---2-'+workid);
                      clicken=0;
                      console.log('averiguar si hay cambios pendientes, confirmarlos o dejar la data original al cancelar, si no hay cambios solo dejar la data original' + data.get('catOriginal') +' y la nueva '+catActual);
                      if ( catActual==null && clicken == 0) {
                        console.log('click fuera de la celda editable SIN cambios pendientes... restaurando estado original');
                        estaCelda.removeClass('catEditando');
                        estaCelda.addClass('catEditable');
                        $(IDT).removeClass("tabEditando");
                         estaCelda.empty().append(estaCeldaTexto);
                        // $(IDT).DataTable().ajax.reload ();
                        alertify.error('Actualización Cancelada');
                        cleanvars()
                        console.log('Programa cerrado, se cambio de celda');
                      }
              }

          }


    }else if(clickp.target.id == 'nobjeto' && $(IDT).hasClass("tabEditando") && switche == 1 && mainid==workid){
          clicken=1;
          console.log('no es la clase que busco para iniciar edición');
        //  var workid=clickp.target.parentElement.firstChild.outerText;
          console.log(mainid+'--2--'+workid);
          console.log('click DENTRO de la zona de edición, NO HACER NADA');
    }else {
      clicken=0;
      console.log('no es la clase que busco');
      console.log('si hay edicion activa la cierro y restauro a su estado original');
      if (mainid) {
        console.log('Existe una sesion de edición, ciérrala puto');
        console.log(mainid+'---3-'+workid);

        if ( !catActual && clicken == 0) {
          console.log('click fuera de la celda editable SIN cambios pendientes... restaurando estado original');
          estaCelda.removeClass('catEditando');
          estaCelda.addClass('catEditable');
          $(IDT).removeClass("tabEditando");
           estaCelda.empty().append(estaCeldaTexto);
          // $(IDT).DataTable().ajax.reload ();
          alertify.error('Actualización Cancelada');
          cleanvars()
          console.log('Programa cerrado, no hubo cambios en la celda');
        }
      }
      console.log('No hay sesiones de edición, nada  por hacer, fin del modulo de edición');
    }

  });



  $(IDT).on('change', 'td.catEditando', function (checkcambios) {
    event.preventDefault();
    // console.log($('table', idt));
    // console.log($(IDT));
      clicken=1;
      catActual = document.getElementById('nobjeto');
      alertify.confirm('ACTUALIZAR NOMBRE DE '+modelo+' ','Actuaizar: '+estaCeldaTexto+' <br>Al nuevo valor: '+catActual.value+'', function(){
        $(IDT).removeClass("tabEditando");
      data.append('catActual',catActual.value); //agregamos al request el nuevo valor des js
      data.append('_method', 'PUT')//inyectamos el metodo  en request para serializar
        //data['_method'] = 'PUT';
        //console.log(modelo.toLowerCase());
        $.ajax({
          url: modelo.toLowerCase()+'/'+data.get('id'),
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
          },
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
                          estaCelda.removeClass('catEditando');
                          estaCelda.addClass('catEditable');
                          $(IDT).removeClass("tabEditando"); //recargamos la tabla si hay errores

                };
              });
              $(response.errors).empty();
            }
            else
            {
              //$('#modalusuario').modal('hide');
              alertify.success ("Actualizado con éxito: <br>"+data.get('catActual'));
              //apagamos edicion
              estaCelda.removeClass('catEditando');
              estaCelda.addClass('catEditable');
              $(IDT).removeClass("tabEditando");
              estaCelda.empty().append(catActual);
              $(IDT).DataTable().ajax.reload();
              cleanvars()
              console.log('Programa cerrado, fin del modulo de edición');
              //console.log(response);

              if ($('.sorting_1').length)
              {
                $(IDT).DataTable().ajax.reload();
              }
            }
          },
          error: function(response) {
            alertify.error("Error actualizando "+modelo+": <br>"+data.get('catOriginal'));
              for (var value of data.values()) {
                console.log(value);
                }
            estaCelda.removeClass('catEditando');
            estaCelda.addClass('catEditable');
            $(IDT).removeClass("tabEditando");
            $(IDT).DataTable().ajax.reload();
            cleanvars()
            console.log('Programa cerrado, fin del modulo de edición');
          },
        });

      },function(){
        console.log('click act cancelada con cambios pendientes');
        estaCelda.removeClass('catEditando');
        estaCelda.addClass('catEditable');
        $(IDT).removeClass("tabEditando");
         estaCelda.empty().append(estaCeldaTexto);
        // $(IDT).DataTable().ajax.reload ();
        alertify.error('Actualización Cancelada');
        cleanvars()
        console.log('Programa cerrado, fin del modulo de edición');
      }).set('labels', {ok:'CONTINUAR', cancel:'CANCELAR'});
  });
  $.fn.dataTable.ext.buttons.nuevoDominio = {
    name: 'add',
    className: 'buttons-add btn-success',
    text: '<i class="fa fa-plus"></i> Nuevo',
    action: function (e, dt, button, config) {
        event.preventDefault();
        $('#modalc1').empty();
        $('#footermodal').empty();

        var catNuevo =  "<div class='form-group col-md-12 ml-auto'><label data-error='error' data-success='ok' for='cmb_nombre'>NUEVO(A) "+modelo.toUpperCase() +":</label> <input value='' name='"+modelo.toLowerCase()+"' type='text' id='"+modelo+"' class='form-control validate' placeholder='Nombre del nuevo objeto...'></div> ";
        var footermodal = "<button class='btn btn-success' id='crear"+modelo+"' >Crear</button><button class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>";

        $("#modalc1").append(catNuevo);
        $("#footermodal").append(footermodal);
        $("#modal"+modelos).modal('show');

    }
  };

  $(document).on("click", "#crear"+modelo+"", function(){
    event.preventDefault();


    console.log('voy a guardar nuevo objeto');
    var data = new FormData(document.getElementById("form-"+modelos));
    alertify.confirm('GUARDAR NOMBRE DE '+modelo.toUpperCase()+' ','Crear: '+data.get(modelo), function(){
  //  data.append('_method', 'PUT')//inyectamos el metodo  en request para serializar NO SE NECESITA EN ESTE MODULO
      //data['_method'] = 'PUT';
      //console.log(modelo.toLowerCase());
      $.ajax({
        url: modelo,
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
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

            $("#modal"+modelos).modal('hide');
            alertify.success ("Guardado con éxito: <br>"+data.get(modelo));
            //apagamos edicion
            $(IDT).DataTable().ajax.reload();
            cleanvars();
            //console.log(response);

            if ($('.sorting_1').length)
            {
              $(IDT).DataTable().ajax.reload();
              cleanvars();
            }
          }
        },
        error: function(response) {
          alertify.error("Error guardando "+modelo+": <br>"+data.get(modelo));
            for (var value of data.values()) {
              console.log(value);
              }
          $("#modal"+modelos).modal('hide');
          $(IDT).DataTable().ajax.reload();
          cleanvars();
        },
      });

    },function(){
      console.log('click act cancelada con cambios pendientes');
      $(IDT).DataTable().ajax.reload();
      $("#modal"+modelos).modal('hide');
      alertify.error('Creacion Cancelada');
      cleanvars()
    }).set('labels', {ok:'CONTINUAR', cancel:'CANCELAR'});

  });

  // $.fn.dataTable.ext.buttons.reload = {
  //   name: 'reload',
  //   // className: 'buttons-add btn-success',
  //   text: '<i class="fa fa-undo"></i> Recargar',
  //   action: function (e, dt, button, config) {
  //       alert('table',idt);
  //       $("table", "#cat"+modelo[0]+modelo.toLowerCase().slice(1)+"").DataTable().ajax.reload();
  //   }
  // };

});
