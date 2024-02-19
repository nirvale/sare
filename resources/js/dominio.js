
$( document ).ready(function() {



/* sCRIPT PARA CATALOGO */
var switche; //switch a edición
var estaCelda;
var estaCeldaTexto;
var row;
var catActual; // valor nuevo default indefinido o nullo
var data;
var idt; //index de la tabla
var clicken; //bandera de cambio en input [0=fuera, 1=dentro]
var manid; //clave del registro a actualizar

  function cleanvars(){
    switche = undefined; //switch a edición
    estaCelda = undefined;
    estaCeldaTexto = undefined;
    row = undefined;
    catActual = undefined; // valor nuevo default indefinido o nullo
    data = undefined;
    idt = undefined; //index de la tabla
    clicken = undefined; //bandera de cambio en input [0=fuera, 1=dentro]
    manid = undefined;
  console.log('variables limpiadas');
  };

  $('html').click(function (clickp){
    clickp.preventDefault();
    console.log('se detecto click');
    var claseclick = clickp.target.className.trim();
    //console.log('esta es '+claseclick);
    if (claseclick == 'catEditable' || claseclick == 'catEditable sorting_1') {
      console.log('sí es la clase que busco - catEditable');
      if (clickp.target.offsetParent.id != null ) {
        // idt ="'#"+clickp.target.offsetParent.id+" tbody'";
        idt ="#"+clickp.target.offsetParent.id+"_wrapper";
        console.log('el id del elemenoto padre de la seleccion es: '+clickp.target.offsetParent.id);
        console.log('esta es id de la tabla despues del click: '+idt);
      }
      //console.log(clickp.target.parentElement.firstChild.outerText);
        row = $(clickp.target.parentElement);
        // estaCelda = row.find("td:nth-child(2)");  //original
        estaCelda = $(clickp.target);
        estaCeldaTexto = clickp.target.outerText;
        manid = clickp.target.parentElement.firstChild.outerText;
        //console.log(estaCelda);
      //se obtuvieron las variables de renglon
      // se agrega la clase disparadora
        switche = 1;
        $('table', idt).addClass("tabEditando");
        estaCelda.removeClass('catEditable');
        estaCelda.addClass('catEditando');
        console.log('se agrego clase disparadora, fin stage 1');
        //se crea la forma para actualizar el indiceRenglon
        data= new FormData(); //creamos la forma
        data.append('id',manid);
        data.append('catOriginal',estaCeldaTexto);
        //inyectamos forma
        estaCelda.empty().append(
          "<input value='"+estaCeldaTexto+"'  name='nobjeto' type='text' id='nobjeto' class='form-control validate cambiarCatEditable' placeholder='Nombre del nuevo objeto'>"
        );
        console.log('se inyecto el campo editabla en la tabla');

    }else {
      console.log('no es la clase que busco');
        if (clickp.target.id == 'nobjeto' && $('table', idt).hasClass("tabEditando") && switche == 1) {
          clicken=1;
          console.log('click DENTRP de la zona de edicion, NO HACER NADA');

        }else if (clickp.target.id != 'nobjeto' && $('table', idt).hasClass("tabEditando") && switche == 1) {
          clicken=0;
          console.log('averiguar si hay cambios pendientes, confirmarlos o dejar la data original al cancelar, si no hay cambios solo dejar la data original' + data.get('catOriginal') +' y la nueva '+catActual);
          if ( catActual==null && clicken == 0) {
            console.log('click act cancelada SIN cambios pendientes reaturando a estado original');
            estaCelda.removeClass('catEditando');
            estaCelda.addClass('catEditable');
            $('table', idt).removeClass("tabEditando");
             estaCelda.empty().append(estaCeldaTexto);
            // $('table', idt).DataTable().ajax.reload ();
            alertify.error('Actualización Cancelada');
            cleanvars()
          }


        }
    };
  });



  $('table', idt).on('change', 'td.catEditando', function (checkcambios) {
      clicken=1;
      catActual = document.getElementById('nobjeto');
      alertify.confirm('ACTUALIZAR NOMBRE DE DOMINIO ','Actuaizar dominio: '+estaCeldaTexto+' <br>Al nuevo valor: '+catActual.value+'', function(){
        $('table', idt).removeClass("tabEditando");
      data.append('catActual',catActual.value); //agregamos al request el nuevo valor des js
      data.append('_method', 'PUT')//inyectamos el metodo  en request para serializar
        //data['_method'] = 'PUT';
        //console.log(data);
        $.ajax({
          url: "dominio/"+data.get('id'),
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
                          $('table', idt).removeClass("tabEditando"); //recargamos la tabla si hay errores

                };
              });
              $(response.errors).empty();
            }
            else
            {
              $('#modalusuario').modal('hide');
              alertify.success ("Actualizado con éxito: <br>"+data.get('catActual'));
              if ($('.sorting_1').length)
              {
                $('table', idt).DataTable().ajax.reload();
              }
              //apagamos edicion
              estaCelda.removeClass('catEditando');
              estaCelda.addClass('catEditable');
              $('table', idt).removeClass("tabEditando");
              estaCelda.empty().append(catActual);
              //$('table', idt).DataTable().ajax.reload();
              cleanvars()
              //console.log(response);
            }
          },
          error: function(response) {
            alertify.error("Error actualizando dominio: <br>"+data.get('catOriginal'));
              for (var value of data.values()) {
                console.log(value);
                }
            estaCelda.removeClass('catEditando');
            estaCelda.addClass('catEditable');
            $('table', idt).removeClass("tabEditando");
            $('table', idt).DataTable().ajax.reload();
            cleanvars()
          },
        });

      },function(){
        console.log('click act cancelada con cambios pendientes');
        estaCelda.removeClass('catEditando');
        estaCelda.addClass('catEditable');
        $('table', idt).removeClass("tabEditando");
         estaCelda.empty().append(estaCeldaTexto);
        // $('table', idt).DataTable().ajax.reload ();
        alertify.error('Actualización Cancelada');
        cleanvars()
      });
  });

});
