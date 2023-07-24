
$(document).ready(function () {
    ListarEventos();
})

function ListarEventos(origen) {

    var texto;

    texto = $("#filtro").val();

    return $.ajax({
        type: "get",
        url: 'eventos/listar',
        data: {
            origen: origen,
            texto: texto,
        },
        success: function (data) {
            $('#listareventos div').remove();
            $.each(data, function (i, item) {
                var categoria;
                if (item.categoria == 'Programas Sociales') {
                    categoria = 'hogar-de-la-madre';
                } else if (item.categoria == 'Patrimonio Cultural') {
                    categoria = 'cementerio-el-angel';
                } else {
                    categoria = 'noticias';
                }
                $("#listareventos").append("" +
                        "<div class='col-lg-4 col-md-4 col-sm-4'>" +
                        "<div class='event-item'>" +
                        "<div class='event-image'>" +
                        "<img src='https://beneficenciadelima.org/public/" + item.foto + "' alt=''>" +
                        "</div>" +
                        "<div class='event-info'>" +
                        "<div class='date'>" +
                        "<span>" +
                        "<span class='day'>" + item.dia + "</span>" +
                        "<span class='month'>" + item.mes + "</span>" +
                        "</span>" +
                        "</div>" +
                        "<div class='event-content'>" +
                        "<h6><a onclick='verEvento(" + item.codigo + ")'>" + item.nombre + "</a></h6>" +
                        "<ul class='event-meta'>" +
                        "<li><i class='icons icon-clock'></i> " + item.hora + "</li>" +
                        "<li><i class='icons icon-location'></i> " + item.lugar + "</li>" +
                        "</ul>" +
                        "</div>" +
                        "</div>" +
                        "</div>" +
                        "</div>");
            });
        },
        error: function () {
        }
    });
}

function verEvento(codigo) {
    var codigo = codigo;
    $('#modalEditarEvento').modal('show');
    return $.ajax({
        type: "get",
        url: 'https://beneficenciadelima.org/public/admin/evento/editar',
        data: {
            codigo: codigo
        },
        success: function (data) {
            $.each(data, function (i, item) {
                document.getElementById("tituloevento").innerHTML = item.nombre;
                $('#foto').attr('src', '{{base_url()}}/' + item.foto);
                document.getElementById("fecha").innerHTML = item.fecha;
                document.getElementById("hora").innerHTML = item.hora;
                document.getElementById("lugar").innerHTML = item.lugar;
                document.getElementById("detalle").innerHTML = item.descripcion;
                document.getElementById("categoria").innerHTML = item.categoria;

            });
        },
        error: function () {
            alert("Algo salió mal, actualice la página")
        }
    });
}


$('#motivo').click(function () {
    if ($(this).val() == 'Consulta') {
        $("#donacion").css("display", "none");
        $("#voluntariado").css("display", "none");
        $("#tipodonacion").removeClass("obligate");
        $("#tiempovoluntario").removeClass("obligate");
        $("#tipodonacion").val("");
        $("#tiempovoluntario").val("");
    } else if ($(this).val() == 'Donación') {
        $("#donacion").css("display", "block");
        $("#voluntariado").css("display", "none");
        $("#tipodonacion").addClass("obligate");
        $("#tiempovoluntario").removeClass("obligate");
        $("#tiempovoluntario").val("");
    } else if ($(this).val() == 'Voluntariado') {
        $("#voluntariado").css("display", "block");
        $("#donacion").css("display", "none");
        $("#tiempovoluntario").addClass("obligate");
        $("#tipodonacion").removeClass("obligate");
        $("#tipodonacion").val("");
    } else {
        $("#donacion").css("display", "none");
        $("#voluntariado").css("display", "none");
        $("#tipodonacion").removeClass("obligate");
        $("#tiempovoluntario").removeClass("obligate");
        $("#tipodonacion").val("");
        $("#tiempovoluntario").val("");
    }
});

$(document).ready(function(){
    var ancho_pantalla = $(window).width();

    if (ancho_pantalla < 520){
        $('.sect_noticias').addClass("owl-carousel owl-theme owl_home_noticias");
    }

     $(".btn_col").click(function(){

    });
    $('#sl2').slider();
    var RGBChange = function() {
	  $('#RGB').css('background', 'rgb('+r.getValue()+','+g.getValue()+','+b.getValue()+')')
	};
});

function validaNumericos(event) {
    if(event.charCode >= 48 && event.charCode <= 57){
      return true;
     }
     return false;
}

function validaLetras(e){
   key = e.keyCode || e.which;
   tecla = String.fromCharCode(key).toLowerCase();
   letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
   especiales = "8-37-39-46";

   tecla_especial = false
   for(var i in especiales){
        if(key == especiales[i]){
            tecla_especial = true;
            break;
        }
    }

    if(letras.indexOf(tecla)==-1 && !tecla_especial){
        return false;
    }
}
        var base_url = window.location.origin;

        var d = new Date();
        var month = d.getMonth() + 1;
        var day = d.getDate();
        var output = (day < 10 ? '0' : '') + day + '-' + (month < 10 ? '0' : '') + month + '-' + d.getFullYear();

        $("#periodo").val(output);


        !function (a) {
            "use strict";

            a(function () {
                var b = a(window),
                    c = a(document.body),
                    mensaje = '',
                    tipo = '',
                    codigo = '';

                $('.registrarform').click(function(){
                    var b = a(this), dataString;
                    var holder = '';
                    var exito = true;

                    $(".obligate").each(function(){
                        if($(this).val()==''){
                            $(this).focus();
                            holder=$(this).attr("data-content");
                            exito=false;
                            $(".msg").html("").show();
                            $(".msg").html("<div class='alert alert-danger'><i class='fa fa-exclamation-triangle'></i> "+holder+"</div>");
                            setTimeout(function() {
                                $(".msg").fadeOut(1500);
                            },1500);
                            return false;
                        }
                    });

                    if(!exito)
                        return false;


                    var formData = new FormData($("#FormRegistro")[0]);

                    $.ajax({
                        type: "POST",
                        url: "formulario/registrar",
                        data: formData,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        beforeSend: function () {
                            $("#registrar").attr("disabled", true);
                        },
                        success: function (data) {
                            if (data.response == 'success') {
                                $('#Formulario').modal('hide');
                                $('#modalMensaje').find(".modal-body").html(data.message);
                                $('#modalMensaje').modal('show');
                                setTimeout(function () {
                                    $("#FormRegistro")[0].reset();
                                    $("#registrar").attr("disabled", false);
                                }, 1500);
                            } else {
                                $('.msg').html(data.message);
                                $("#registrar").attr("disabled", false);
                            }
                        },
                        error: function () {
                            console.log("It failed");
                        }
                    })
                });

		   $('.registrarmesa').click(function(){
           var b = a(this), dataString;
           var holder = '';
           var exito = true;

           $(".obligate").each(function(){
               if($(this).val()==''){
                   $(this).focus();
                   holder=$(this).attr("data-content");
                   exito=false;
                   $(".msg").html("").show();
                   $(".msg").html("<div class='alert alert-danger'><i class='fa fa-exclamation-triangle'></i> "+holder+"</div>");
                   setTimeout(function() {
                       $(".msg").fadeOut(3500);
                   },1500);
                   return false;
               }
           });
           
           $(".checked").each(function(){
               if(!$(this).is(':checked')){
                   $(this).focus();
                   holder=$(this).attr("data-content");
                   exito=false;
                   $(".msg").html("").show();
                   $(".msg").html("<div class='alert alert-danger'><i class='fa fa-exclamation-triangle'></i> "+holder+"</div>");
                   setTimeout(function() {
                       $(".msg").fadeOut(3500);
                   },1500);
                   return false;
               }
           });

			$(".obligatemail").each(function(){
                           var validEmail =  /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/;
                           if(validEmail.test($(this).val())){

                           }else{
                               $(this).focus();
                               holder=$(this).attr("data-content");
                               exito=false;
                               $(".msg").html("").show();
                               $(".msg").html("<div class='alert alert-danger'><i class='fa fa-exclamation-triangle'></i> "+holder+"</div>");
                               setTimeout(function() {
                                   $(".msg").fadeOut(3500);
                               },1500);
                               return false;
                           }
                       });

			if(!exito)
               return false;


           var formData = new FormData($("#FormRegistro")[0]);

           $.ajax({
               type: "POST",
               url: base_url+"/public/mesa/registrar",
               data: formData,
               contentType: false,
               processData: false,
               dataType: 'json',
               beforeSend: function () {
                   $("#registrarmesa").attr("disabled", true);
               },
               success: function (data) {
                   if (data.response == 'success') {
                       $('#Formulario').modal('hide');
                       $('#modalMensaje').find(".modal-body").html(data.message);
                       $('#modalMensaje').modal('show');
                       setTimeout(function () {
                           $("#FormRegistro")[0].reset();
                           $("#registrarmesa").attr("disabled", false);
                       }, 1500);
                   } else {
                       $('.msg').html(data.message);
                       $("#registrarmesa").attr("disabled", false);
                   }
               },
               error: function () {
                   console.log("It failed");
               }
           })
       });

            })
        }


        (jQuery), function () {
            "use strict";
            $('#fono').keyup(function () {
                this.value = (this.value + '').replace(/[^0-9]/g, '');
            });

        }();
1