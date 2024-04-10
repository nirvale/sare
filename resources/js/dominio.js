
$( document ).ready(function() {

/* sCRIPT PARA CATALOGO */
let switche; //switch a edición
let estaCelda;
let estaCeldaTexto;
let row;
let catActual; // valor nuevo default indefinido o nullo
let data;
let thead;
let clicken; //bandera de cambio en input [0=fuera, 1=dentro]
let mainid; //clave del registro a actualizar
let workid; // clave de registro donde se hace click
let cat; //catalogos
let edId=1; //bandera para editar id
const remAceEsp = str =>
  str.normalize('NFD').replace(/[\u0300-\u036f]/g, '').replace(/["'()]/g,"").replace(/\s/g, '_').toLowerCase();//remover acentos, parentesis,comillas y espacios de strings
const IDT='#'+$('table.dataTable').attr('id'); // ID DE LA TABLA GENERAL
const modelos= IDT.toLowerCase().slice(4);
const modelo = modelos.slice(0,-1);
const theads = document.getElementById(IDT.slice(1)).getElementsByTagName("th");
////console.log('este es el modelo : '+modelo);
  function cleanvars(){
    switche = undefined; //switch a edición
    estaCelda = undefined;
    estaCeldaTexto = undefined;
    row = undefined;
    catActual = undefined; // valor nuevo default indefinido o nullo
    data = undefined;
    thead = undefined;
    clicken = undefined; //bandera de cambio en input [0=fuera, 1=dentro]
    mainid = undefined;
    edId = 1;
  //console.log('variables limpiadas');
  };
  $(IDT).on('click','td', function(){
    //let fila = $(this).closest('tr');
    workid = $(this).closest('tr').find('td:eq(0)').text().trim();
        if (!workid) {
          //alert('no existe workid');
          //console.log($(this).closest('tr').find('td:eq(0)'));
          //let preworkid =$(this).closest('tr').find('td:eq(0)');
          workid=$(this).closest('tr').find('td:eq(0)')[0].firstChild.value;
          //console.log(preworkid[0]);
        }
    let ncol = $(this).index();
    //thead = $("thead th:eq(" + $(this).index() + ")").text().trim();
    // closest(selector) busca el elemento con el selector indicado más cercano a $(this)
    // Luego te traes el dato 'id' del tr con la función attr(dato)
    // console.log('este es numero de la columna'+ncol);
    // console.log($("thead th:eq(" + $(this).index() + ")").text().trim());
  });

  $('html').click(function (clickp){
    //clickp.preventDefault();
    //console.log('se detecto click');
    let claseclick = clickp.target.className.trim().split(' ');
    //console.log(claseclick);
    if (claseclick.includes('catEditable')) {
      //console.log('sí es la clase que busco - catEditable');
      if (clickp.target.offsetParent.id != null && clickp.target.offsetParent.id == IDT.slice(1) && clickp.target.tagName !='TH') {

            //idt ="#"+clickp.target.offsetParent.id;
            //idt ="#"+clickp.target.offsetParent.id+"_wrapper";
            //console.log('el id del elemenoto padre de la seleccion es IGUAL, IDT: '+ IDT.slice(1)+ '= idt: '+clickp.target.offsetParent.id);
            //console.log('esta es id de la tabla despues del click: '+clickp.target.offsetParent.id);
            ////console.log(clickp.target.parentElement.firstChild.outerText);
            //console.log(mainid+'--1--'+workid);
                if (!mainid) {

                          row = $(clickp.target.parentElement);
                          // estaCelda = row.find("td:nth-child(2)");  //original
                          estaCelda = $(clickp.target);
                          estaCeldaTexto = clickp.target.innerHTML;
                          mainid = clickp.target.parentElement.firstChild.innerText;
                          thead = $("thead th:eq(" + $(clickp.target).index() + ")").text().trim();                       ;
                          ////console.log(clickp.target);
                        //se obtuvieron las variables de renglon
                        // se agrega la clase disparadora
                          switche = 1;
                          $(IDT).addClass("tabEditando");
                          estaCelda.removeClass('catEditable');
                          estaCelda.addClass('catEditando');
                          ////console.log('se agrego clase disparadora, fin stage 1');
                          //se crea la forma para actualizar el indiceRenglon
                          data = new FormData(); //creamos la forma
                          data.append('id',mainid);
                          data.append('catOriginal',estaCeldaTexto);
                          //inyectamos forma
                          if (claseclick.includes('catCombox') && !claseclick.includes('catComboxMulti')) {
                            //alert('debo traer un combo');
                            //catman();
                            let catChild=remAceEsp(thead);
                            let catIndex=theads[0].title.toLowerCase();
                            // console.log(cat[catChild].length);
                            // console.log(cat[catChild][0][catIndex]);
                            // console.log(cat[catChild][0][catChild]);

                            estaCelda.empty().append(
                            //  "<input value='"+estaCeldaTexto+"'  name='nobjeto' type='text' id='nobjeto' class='form-control validate cambiarCatEditable' placeholder='Nombre del nuevo objeto'>"
                              "<select class='form-control select2 cambiarCatComboEditable' id='nobjeto' name='nobjeto' title='Selecciona uno...'><option value='' selected='selected'>Seleccionar...</option></select>"
                            );
                            if (!claseclick.includes('catComboxNest')) {
                              for (let i = 0; i < cat[catChild].length; i++) {
                                //console.log(cat[catChild][i][catIndex]);
                                //console.log(cat[catChild][i][catChild]);
                                let setSelection='';
                                if (cat[catChild][i][catChild]==estaCeldaTexto) {
                                    setSelection='disabled selected';
                                }else{
                                  setSelection='class=comboselecting';
                                }

                                  $('.cambiarCatComboEditable').append(
                                    "<option value="+cat[catChild][i][catIndex]+" "+setSelection+" >" +cat[catChild][i][catChild]+"</option>"
                                );

                              }
                            }else  if (claseclick.includes('catComboxNest')) {
                              //console.log(claseclick);
                              let nph;
                              let arrHeaders=[];
                              let nptn;
                              let npih;
                              $(theads).each(function(i,value){
                                  arrHeaders[i]=remAceEsp(value.innerText)
                                  return arrHeaders;
                                }
                              );
                              //console.log(arrHeaders);
                              nph = claseclick.find((element) => element.startsWith('nest-')).split('-');
                              //console.log(theads,arrHeaders);
                              npih=$.inArray(nph[1],arrHeaders);
                              nptn=row.find('td:eq('+npih+')').text();
                              // console.log(npih);
                              // console.log(nptn);
                               //console.log(catChild);
                              // console.log(nph[1]);
                              // console.log(cat[nph[1]][0][nph[1]]);
                              // console.log(cat[catChild][0][nph[1]]);

                              for (let i = 0; i < cat[nph[1]].length; i++) {
                                // console.log(i);
                                if (cat[nph[1]][i][nph[1]] == nptn) {
                                  // console.log(cat[nph[1]][i][catChild+'s'] );
                                  for (let j = 0; j < cat[nph[1]][i][catChild+'s'].length; j++) {
                                   // console.log(cat[nph[1]][i][catChild+'s'][j][catChild]);
                                    //console.log(cat[catChild][i][catChild]);
                                    let setSelection='';
                                    if (cat[nph[1]][i][catChild+'s'][j][catChild]==estaCeldaTexto) {
                                        setSelection='disabled selected';
                                    }else{
                                      setSelection='class=comboselecting';
                                    }

                                      $('.cambiarCatComboEditable').append(
                                        "<option value="+cat[nph[1]][i][catChild+'s'][j][catIndex]+" "+setSelection+" >" +cat[nph[1]][i][catChild+'s'][j][catChild]+"</option>"
                                    );

                                  }
                                }
                              }


                            }

                          }else if (claseclick.includes('catCombox') && claseclick.includes('catComboxMulti')) {
                            //alert('debo traer un combo multiple');
                            //catman();

                            let catChild=remAceEsp(thead);
                            let catIndex=theads[0].title.toLowerCase();
                            // console.log(cat[catChild].length);
                            // console.log(cat[catChild][0][catIndex]);
                            // console.log(cat[catChild][0][catChild]);

                            estaCelda.empty().append(
                            //  "<input value='"+estaCeldaTexto+"'  name='nobjeto' type='text' id='nobjeto' class='form-control validate cambiarCatEditable' placeholder='Nombre del nuevo objeto'>"
                              "<select class='form-control select2 cambiarCatComboEditable' id='nobjeto' name='nobjeto' title='Selecciona uno...'multiple ><option value='' selected='selected'>Seleccionar...</option></select>"
                            );

                            for (let i = 0; i < cat[catChild].length; i++) {
                              //console.log(cat[catChild][i][catIndex]);
                              //console.log(cat[catChild][i][catChild]);
                              let setSelection='';
                              if (cat[catChild][i][catChild]==estaCeldaTexto) {
                                  setSelection='disabled selected';
                              }else{
                                setSelection='class=comboselecting';
                              }

                                $('.cambiarCatComboEditable').append(
                                  "<option value="+cat[catChild][i][catIndex]+" "+setSelection+" >" +cat[catChild][i][catChild]+"</option>"
                              );

                            }
                          }else if(!claseclick.includes('catCombox') && claseclick.includes('catEditableTA')) {
                            estaCelda.empty().append(
                              "<textarea name='nobjeto' type='text' id='nobjeto'  class='form-control validate cambiarCatEditable' placeholder='Nuevo texto'>"+estaCeldaTexto.replace(/<br\s*[\/]?>/gi, "\r")+"</textarea>"
                            );
                          }else {
                            estaCelda.empty().append(
                              "<input value='"+estaCeldaTexto+"'  name='nobjeto' type='text' id='nobjeto' class='form-control validate cambiarCatEditable' placeholder='Nombre del nuevo objeto'>"
                            );
                          }

                          ////console.log('se inyecto el campo editabla en la tabla');


              }else if (clickp.target.id != 'nobjeto' && $(IDT).hasClass("tabEditando") && switche == 1 && mainid != workid) {
                      ////console.log(mainid+'---2-'+workid);
                      clicken=0;
                      ////console.log('averiguar si hay cambios pendientes, confirmarlos o dejar la data original al cancelar, si no hay cambios solo dejar la data original' + data.get('catOriginal') +' y la nueva '+catActual);
                      if ( catActual==null && clicken == 0) {
                        ////console.log('click fuera de la celda editable SIN cambios pendientes... restaurando estado original');
                        estaCelda.removeClass('catEditando');
                        estaCelda.addClass('catEditable');
                        $(IDT).removeClass("tabEditando");
                         estaCelda.empty().append(estaCeldaTexto);
                        // $(IDT).DataTable().ajax.reload ();
                        alertify.error('Actualización Cancelada');
                        cleanvars()
                        ////console.log('Programa cerrado, se cambio de celda');
                      }
              }else if (clickp.target.id != 'nobjeto' && $(IDT).hasClass("tabEditando") && switche == 1 && mainid == workid) {
                ////console.log(mainid+'---2-'+workid);
                clicken=0;
                ////console.log('averiguar si hay cambios pendientes, confirmarlos o dejar la data original al cancelar, si no hay cambios solo dejar la data original' + data.get('catOriginal') +' y la nueva '+catActual);
                if ( catActual==null && clicken == 0) {
                  ////console.log('click fuera de la celda editable SIN cambios pendientes... restaurando estado original');
                  estaCelda.removeClass('catEditando');
                  estaCelda.addClass('catEditable');
                  $(IDT).removeClass("tabEditando");
                   estaCelda.empty().append(estaCeldaTexto);
                  // $(IDT).DataTable().ajax.reload ();
                  alertify.error('Actualización Cancelada');
                  cleanvars()
                  ////console.log('Programa cerrado, se cambio de celda');
                }
              }

          }


    }else if(clickp.target.id == 'nobjeto' && $(IDT).hasClass("tabEditando") && switche == 1 && mainid==workid){
          clicken=1;
          //console.log('no es la clase que busco para iniciar edición');
        //  let workid=clickp.target.parentElement.firstChild.outerText;
          //console.log(mainid+'--2--'+workid);
          //console.log('click DENTRO de la zona de edición, NO HACER NADA');
    }else {
      clicken=0;
      //console.log('no es la clase que busco');
      //console.log('si hay edicion activa la cierro y restauro a su estado original');
      if (mainid) {
        //console.log('Existe una sesion de edición, ciérrala puto');
        //console.log(mainid+'---3-'+workid);

        if ( !catActual && clicken == 0) {
          //console.log('click fuera de la celda editable SIN cambios pendientes... restaurando estado original');
          estaCelda.removeClass('catEditando');
          estaCelda.addClass('catEditable');
          $(IDT).removeClass("tabEditando");
           estaCelda.empty().append(estaCeldaTexto);
          // $(IDT).DataTable().ajax.reload ();
          alertify.error('Actualización Cancelada');
          cleanvars()
          //console.log('Programa cerrado, no hubo cambios en la celda');
        }
      }
      //console.log('No hay sesiones de edición, nada  por hacer, fin del modulo de edición');
    }

  });

  $(IDT).on('keydown', 'td.catComboxMulti', function () {
    event.preventDefault();
    console.log( event.type + ": " +  event.which );
    if (event.which==17) {
      $( 'td.catComboxMulti' ).one( "keyup", function( event ) {
        event.preventDefault();
          //console.log( event.type + ": " +  event.which );
          let catActual0 = [];
          let dsplyCatActual= [];
          $.each($('.catComboxMulti option:selected'),function() {
            dsplyCatActual.push($(this).text());
          });
          $.each($('.catComboxMulti option:selected'), function(){
              catActual0.push($(this).val());
          });
          let catActual = new Object(); //we inicia porque no existe, el atributo "value" necesario para enviar la data
          catActual.value = catActual0;
          data.append('catActual',JSON.stringify(catActual.value));
          // data.append('catActual',catActual.value);
          //console.log(catActual.value);
          // alert("You have selected - " + dsplyCatActual0.join(", "));
          // data.delete('catActual'); //eliminamos para no tener la misma variable muchas veces, en ejecucion no debe existir este problema
          sChanges(dsplyCatActual);
        });
    }else if (event.which==27) {
      cancelEdit();
    }

  });

  function lnbr(dsplyCatActual){
    //console.log(dsplyCatActual);
    if (Array.isArray(dsplyCatActual)) {
      $.each( dsplyCatActual, function( i, valt ){
        dsplyCatActual[i]=valt.replace(/\n/gi, "<br>");
      });
    }else if (!Array.isArray(dsplyCatActual)) {
      dsplyCatActual=dsplyCatActual.replace(/\n/gi, "<br>");
    }
    //console.log(dsplyCatActual);
    return dsplyCatActual;
  };

  function cancelEdit(){
    //console.log('click act cancelada con cambios pendientes');
    estaCelda.removeClass('catEditando');
    estaCelda.addClass('catEditable');
    $(IDT).removeClass("tabEditando");
     estaCelda.empty().append(estaCeldaTexto);
    // $(IDT).DataTable().ajax.reload ();
    alertify.error('Actualización Cancelada');
    cleanvars()
    //console.log('Programa cerrado, fin del modulo de edición');
  };


  $(IDT).on('change', 'td.catEditando', function (checkcambios) {
    event.preventDefault();
    // //console.log($('table', idt));
    // //console.log($(IDT));
      clicken=1;
      catActual = document.getElementById('nobjeto');
      let dsplyCatActual= null;
    //  console.log(catActual.attributes);
    if (catActual.classList.contains('cambiarCatComboEditable') && catActual.attributes.multiple) {
      //abortamos actualización para iniciar multiple select
    }else { // eliminamos el else

      if($('.comboselecting').text()) {
        dsplyCatActual = $('select[name=nobjeto] option').filter(':selected').text();
        //alert($('select[name=nobjeto] option').filter(':selected').text())
      }else {
        dsplyCatActual = catActual.value;
      }
      data.append('catActual',catActual.value);
      sChanges(dsplyCatActual);
    }


  });

  function sChanges(dsplyCatActual){
    alertify.confirm('ACTUALIZAR NOMBRE DE '+thead+' ','<b>Actualizar: </b><br>'+estaCeldaTexto+' <br><b>Al nuevo valor: </b><br>'+lnbr(dsplyCatActual)+'', function(){
      //dsplyCatActual=null;
      $(IDT).removeClass("tabEditando");
     //agregamos al request el nuevo valor des js
    data.append('_method', 'PUT');//inyectamos el metodo  en request para serializar
    data.append('thead', remAceEsp(thead));//inyectamos el nombre de la columna  en request para serializar
      //data['_method'] = 'PUT';
      ////console.log(modelo.toLowerCase());
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
              let msg = alertify.error(value+"<br><button class='btn btn-danger'>Cerrar</button>",10000);
              msg.callback = function (isClicked) {
                      if(isClicked){
                        ////console.log('notification dismissed by user');
                      }
                      else{
                        ////console.log('notification auto-dismissed');
                        estaCelda.removeClass('catEditando');
                        estaCelda.addClass('catEditable');
                        $(IDT).removeClass("tabEditando"); //recargamos la tabla si hay errores
                      }


              };
            });
            $(response.errors).empty();
          }
          else
          {
            //$('#modalusuario').modal('hide');
            alertify.success ("Actualizado con éxito: <br>"+dsplyCatActual);
            //apagamos edicion
            estaCelda.removeClass('catEditando');
            estaCelda.addClass('catEditable');
            $(IDT).removeClass("tabEditando");
            //estaCelda.empty().append(catActual);
            $(IDT).DataTable().ajax.reload();
            cleanvars()
            //console.log('Programa cerrado, fin del modulo de edición');
            ////console.log(response);

            if ($('.sorting_1').length)
            {
              $(IDT).DataTable().ajax.reload();
            }
          }
        },
        error: function(response) {
          alertify.error("Error actualizando "+modelo+": <br>"+data.get('catOriginal'));
            for (let value of data.values()) {
              ////console.log(value);
              }
          estaCelda.removeClass('catEditando');
          estaCelda.addClass('catEditable');
          $(IDT).removeClass("tabEditando");
          $(IDT).DataTable().ajax.reload();
          cleanvars()
          //console.log('Programa cerrado, fin del modulo de edición');
        },
      });

    },function(){
      cancelEdit();
    }).set('labels', {ok:'CONTINUAR', cancel:'CANCELAR'});
  };
//  $.fn.dataTable.render.percentBar('round','#fff', '#FF9CAB', '#FF0033', '#FF9CAB', 0, 'solid')

  $.fn.dataTable.ext.buttons.nuevo = {
    //type: modelo,
    name: 'add',
    className: 'buttons-add btn-success',
    text: '<i class="fa fa-plus"></i> Nuevo',
    action: function (e, dt, button, config) {
        event.preventDefault();
        $('#modalc1').empty();
        $('#modalc2').empty();
        $('#footermodal').empty();
        if (theads[0].classList.contains('catEditable')) {
          edId=0;
        }
        //for (let i = edId; i < theads.length-1; i++) {
          //console.log('index :'+i+', nombre del head:'+theads[i].innerText);
          if ($('th.catCombox').length > 0) {
            let thcombox =$('th.catCombox');
            for (let i = edId; i < theads.length-1; i++) {
                if(theads[i].innerText && !theads[i].classList.contains('catCombox') && !theads[i].classList.contains('catEditableTA') && theads[i].classList.contains('catEditable')){
                  let catNuevo =  "<div class='form-group col-md-12 ml-auto'><label data-error='error' data-success='ok' for='cmb_nombre'>NUEVO(A) "+theads[i].innerText+":</label> <input value='' name='"+remAceEsp(theads[i].innerText)+"' type='text' id='"+remAceEsp(theads[i].innerText)+"' class='form-control validate' placeholder='Nuevo Objeto...'></div> ";
                  $("#modalc1").append(catNuevo);
                }else if (theads[i].innerText && !theads[i].classList.contains('catCombox') && theads[i].classList.contains('catEditableTA') && theads[i].classList.contains('catEditable')) {
                  let catNuevo =  "<div class='form-group col-md-12 ml-auto'><label data-error='error' data-success='ok' for='cmb_nombre'>NUEVO(A) "+theads[i].innerText+":</label> <textarea value='' type='text' name='"+remAceEsp(theads[i].innerText)+"' id='"+remAceEsp(theads[i].innerText)+"' class='form-control validate' placeholder='Inserte Texto...'></textarea></div> ";
                  $("#modalc1").append(catNuevo);
                }
                for (let j = 0; j < thcombox.length; j++) {    ////
                  if (thcombox[j].innerText == theads[i].innerText ) {
                    let catChild= remAceEsp(thcombox[j].innerText);
                    let catIndex=theads[0].title.toLowerCase();
                    $("#modalc1").append(
                      "<div class='form-group col-md-12 ml-auto'><label data-error='error' data-success='ok' for='cmb_nombre'>NUEVO(A) "+theads[i].innerText+":</label><select class='form-control select2 cambiarCatComboEditable"+j+"' id='"+remAceEsp(theads[i].innerText)+"' name='"+remAceEsp(theads[i].innerText)+"' title='Selecciona uno...'><option value='' selected='selected'>Seleccionar nuevo...</option></select></div>"
                    );
                    if (theads[i].classList.contains('catComboxMulti')) {
                      //alert('es un combo multiple para crear'+remAceEsp(theads[i].innerText));
                      $('#'+remAceEsp(theads[i].innerText)).attr('multiple','multiple');
                      $('#'+remAceEsp(theads[i].innerText)).attr('name',remAceEsp(theads[i].innerText)+'[]');
                    }

                    if (theads[i].classList.contains('catComboxNest')) {
                      //llamas funcion on change
                      let theadNestPatch=theads[i].className.split(' ').find((element) => element.startsWith('nest-')).split('-');
                      $('#'+theadNestPatch[1]).addClass('catComboxNestF');
                    }else {
                      for (let k = 0; k < cat[catChild].length; k++) {
                        // console.log(cat[catChild][i][catIndex]);
                        // console.log(cat[catChild][i][catChild]);
                          $('.cambiarCatComboEditable'+j).append(
                            "<option value="+cat[catChild][k][catIndex]+">" +cat[catChild][k][catChild]+"</option>"
                        );
                      }
                      // let catNuevo =  "<div class='form-group col-md-12 ml-auto'><label data-error='error' data-success='ok' for='cmb_nombre'>NUEVO(A) "+theads[i].innerText+":</label> <input value='' name='"+remAceEsp(theads[i].innerText )+"' type='text' id='"+remAceEsp(theads[i].innerText )+"' class='form-control validate' placeholder='Nombre del nuevo objeto...'></div> ";
                      // $("#modalc1").append(catNuevo);
                    }

                  }else {

                  }
    ///
                }
              }
          }else {
            for (let i = edId; i < theads.length-1; i++) {
              if (theads[i].classList.contains('catEditable') && !theads[i].classList.contains('catEditableTA')) {
                let catNuevo =  "<div class='form-group col-md-12 ml-auto'><label data-error='error' data-success='ok' for='cmb_nombre'>NUEVO(A) "+theads[i].innerText+":</label> <input value='' name='"+remAceEsp(theads[i].innerText)+"' type='text' id='"+remAceEsp(theads[i].innerText)+"' class='form-control validate' placeholder='Nombre del nuevo objeto...'></div> ";
                $("#modalc1").append(catNuevo);
              }else if (theads[i].classList.contains('catEditable') && theads[i].classList.contains('catEditableTA')) {
                let catNuevo =  "<div class='form-group col-md-12 ml-auto'><label data-error='error' data-success='ok' for='cmb_nombre'>NUEVO(A) "+theads[i].innerText+":</label> <textarea value='' type='text' name='"+remAceEsp(theads[i].innerText)+"' id='"+remAceEsp(theads[i].innerText)+"' class='form-control validate' placeholder='Inserte Texto...'></textarea></div> ";
                $("#modalc1").append(catNuevo);
              }

            }
          }

        //}

      //  let catNuevo =  "<div class='form-group col-md-12 ml-auto'><label data-error='error' data-success='ok' for='cmb_nombre'>NUEVO(A) "+modelo.toUpperCase() +":</label> <input value='' name='"+modelo.toLowerCase()+"' type='text' id='"+modelo+"' class='form-control validate' placeholder='Nombre del nuevo objeto...'></div> "; //PARA UN SOLO CAMPO
        let footermodal = "<button class='btn btn-success' id='crear"+modelo+"' >Crear</button><button class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>";

        //$("#modalc1").append(catNuevo); //para 1 solo campo variable
        $("#footermodal").append(footermodal);
        $("#modal"+modelos).modal('show');

    }
  };

  $('body').on('change',  '.catComboxNestF',function(){
      let catIndex=theads[0].title.toLowerCase();
      let nestChangeId=$(this).attr('id');
      let nestChangeText=$( ".catComboxNestF option:selected:first" ).text()
      let arrHeaders=[];
      let arrHeadersNest=[];
      $(theads).each(function(i,value){

        if (value.classList.contains('catComboxNest')) {
          console.log('encontre: '+i+' :'+value.innerText);
          arrHeaders.push(remAceEsp(value.innerText));
          arrHeadersNest.push(value.className.split(' ').find((element) => element.startsWith('nest-')).split('-'));
        }

        }
      );
      for (let i = 0; i < arrHeaders.length; i++) {
        $('#'+arrHeadersNest[i][2]).find('option').not(':first').remove();
          if (arrHeadersNest[i][1]==nestChangeId) {
              for (let j = 0; j < cat[arrHeadersNest[i][1]].length; j++) {
                if (cat[arrHeadersNest[i][1]][j][arrHeadersNest[i][1]]==nestChangeText) {
                  for (let k = 0; k < cat[arrHeadersNest[i][1]][j][arrHeadersNest[i][2]+'s'].length; k++) {
                    alert(cat[arrHeadersNest[i][1]][j][arrHeadersNest[i][2]+'s'][k][arrHeadersNest[i][2]]);
                    console.log(  $('#'+arrHeadersNest[i][2]));
                      $('#'+arrHeadersNest[i][2]).append(
                        "<option value="+cat[arrHeadersNest[i][1]][j][arrHeadersNest[i][2]+'s'][k][catIndex]+"  >" +cat[arrHeadersNest[i][1]][j][arrHeadersNest[i][2]+'s'][k][arrHeadersNest[i][2]]+"</option>"
                      );
                  }
                }
              }
          }
      }

  });

  $(document).on("click", "#crear"+modelo+"", function(){
    event.preventDefault();


    //console.log('voy a guardar nuevo objeto');
    data = new FormData(document.getElementById("form-"+modelos));
    //console.log(data)

    if (data.get(modelo)==null) {
      data.append(modelo, data.get(remAceEsp(theads[1].innerText)));
    }
    //
    alertify.confirm('GUARDAR NOMBRE DE '+modelo.toUpperCase()+' ','Crear: '+data.get(modelo), function(){
  //  data.append('_method', 'PUT')//inyectamos el metodo  en request para serializar NO SE NECESITA EN ESTE MODULO
      //data['_method'] = 'PUT';
      ////console.log(modelo.toLowerCase());
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
              let msg = alertify.error(value+"<br><button class='btn btn-danger'>Cerrar</button>",10000);
              msg.callback = function (isClicked) {
                      if(isClicked){
                        ////console.log('notification dismissed by user');
                      }
                        ////console.log('notification auto-dismissed');
                      else{

                      }

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
            ////console.log(response);

            if ($('.sorting_1').length)
            {
              $(IDT).DataTable().ajax.reload();
              cleanvars();
            }
          }
        },
        error: function(response) {
          alertify.error("Error guardando "+modelo+": <br>"+data.get(modelo));
            for (let value of data.values()) {
              //console.log(value);
              }
          $("#modal"+modelos).modal('hide');
          $(IDT).DataTable().ajax.reload();
          cleanvars();
        },
      });

    },function(){
      //console.log('click act cancelada con cambios pendientes');
      $(IDT).DataTable().ajax.reload();
      $("#modal"+modelos).modal('hide');
      alertify.error('Creacion Cancelada');
      cleanvars()
    }).set('labels', {ok:'CONTINUAR', cancel:'CANCELAR'});

  });

  $(document).on("click", "#eliminar"+modelo+"", function(){
    event.preventDefault();
    let destroyid = $(this).closest('tr').find('td:eq(0)').text().trim();
    let destroyobject = $(this).closest('tr').find('td:eq(1)').text().trim();
    alertify.confirm('ELIMINAR NOMBRE DE '+modelo.toUpperCase()+' ','Eliminar: '+destroyobject, function(){
  //  data.append('_method', 'PUT')//inyectamos el metodo  en request para serializar NO SE NECESITA EN ESTE MODULO
      //data['_method'] = 'PUT';
      ////console.log(modelo.toLowerCase());
      $.ajax({
        url: modelo+'/'+destroyid,
        method: 'DELETE',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        processData: false,
        contentType: false,
        dataType: 'json',
        cache:false,
        data:{
          'id':destroyid,
        },

        success: function(response) {
          //validando formulario
          if(response.errors)
          {


            $.each(response.errors, function(key, value){
              let msg = alertify.error(value+"<br><button class='btn btn-danger'>Cerrar</button>",10000);
              msg.callback = function (isClicked) {
                      if(isClicked){
                        ////console.log('notification dismissed by user');
                      }

                      else{
                        //console.log('notification auto-dismissed');
                      }

              };
            });
            $(response.errors).empty();
          }
          else
          {

            $("#modal"+modelos).modal('hide');
            alertify.success ("Eliminado con éxito: <br>"+destroyobject);
            //apagamos edicion
            $(IDT).DataTable().ajax.reload();
            cleanvars();
            ////console.log(response);

            if ($('.sorting_1').length)
            {
              $(IDT).DataTable().ajax.reload();
              cleanvars();
            }
          }
        },
        error: function(response) {
          alertify.error("Error eliminando "+modelo+": <br>"+destroyobject);
            // for (let value of data.values()) {
            //   //console.log(value);
            //   }
          $("#modal"+modelos).modal('hide');
          $(IDT).DataTable().ajax.reload();
          cleanvars();
        },
      });

    },function(){
      //console.log('click act cancelada con cambios pendientes');
      //$(IDT).DataTable().ajax.reload();
      $("#modal"+modelos).modal('hide');
      alertify.error('Eliminación Cancelada');
      cleanvars()
    }).set('labels', {ok:'ELIMINAR', cancel:'CANCELAR'});


  });

function catman(){  //console.log(modelo);
  //let combos = $('th.catCombox');
  let theadcombox =[];
  // for (let i = 0; i < combos.length; i++) {
  //     theadcombox[i]=combos[i].innerText.toLowerCase();
  // }
  //alert('llame al catalogo')
  if ($('th.catCombox').length > 0) {
    $('th.catCombox').each(function(i,vars) {
            theadcombox[i]=remAceEsp($(this).text());
    });
    //console.log(theadcombox);
        $.ajax({
          url:'catman',
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
          },
          data:{
            'catman': modelo,
            'theadcombox': theadcombox,
            'theheadcomboxLen': theadcombox.length,
          },

          success: function(response) {
            //alert('si encontre el controlador de catalogos');
            cat = response;
            //console.log(cat);

          },
          error: function(response) {
            alertify.error("Error recibiendo catalogos para: " +modelo);
              //  console.log(response);
          },
        });
  }

}


setTimeout(catman, 100);



  // $.fn.dataTable.ext.buttons.reload = {
  //   name: 'reload',
  //   // className: 'buttons-add btn-success',
  //   text: '<i class="fa fa-undo"></i> Recargar',
  //   action: function (e, dt, button, config) {
  //       alert('table',IDT);
  //       $("table", "#cat"+modelo[0]+modelo.toLowerCase().slice(1)+"").DataTable().ajax.reload();
  //   }
  // };

});
