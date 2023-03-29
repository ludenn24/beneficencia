

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
                        url: base_url+"/public/registrar",
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