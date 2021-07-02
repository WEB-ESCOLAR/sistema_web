$(document).ready(function(){


  	$('.bar').on('click', function(){
  	  $('.contenido').toggleClass('open');
      var current=$("#content_sidebar").attr('class');
      console.log("action " + current);
      if(current == "contenido"){
          $('.container').css("width","80%");
          $('.header-container').css("width","100%");
          $('.body-container').css("width","100%");
          $('.logout').css("right","0");
          $('#formulario_detalleMaterial').css("left","440px");
          $('#formulario_material').css("left","440px");
          $('#formulario_alumno').css("left","440px");

      }else{
         $('.container').css("width","95%");
         $('.header-container').css("width","80%");
         $('.body-container').css("width","80%");
        $('.logout').css("right","15%");
        $('#formulario_detalleMaterial').css("left","305px");
        $('#formulario_material').css("left","305px");
        $('#formulario_alumno').css("left","290px");
      }

  	})


    // $('#materiales').on('click',function(){
    //   console.log("materiales ")
    // })

    // $('#materiales').on('click',function(e){
    //   e.preventDefault();
    //   console.log("materiales ")
    //    var url = window.location.href;
    //    console.log("url is " + url)
    // })



    // LOGIN USER
    // *************************
    $('#formulario_login').on('submit',function(e){
        e.preventDefault();
        var param = $(this).serialize()
        console.log(param);
        $.ajax({
          url:"Controller/ControllerLogin.php",
          data:param+"&action=Login",
          dataType:"json"
        }).done(function(response){
          if(response == 1){
            window.location="Home";
          }
          $('#message_login').text(response);
        })
    })

    $(document).on('click','#logoutUser',function(e){
      e.preventDefault();
        $.ajax({
                url:"Controller/ControllerLogin.php",
                data:{action:"Logout"},
         }).done(function(response){
                  window.location="Login";
        })
    })
    // **************************
    // MODALS AND FORMS SHOW
    // ***************************
    function hide(){
        $('#formulario_material').hide();
    }
    function hide(){
          $('#formulario_alumno').hide();
    }
    //BUTTONS MODALS DETALLE MATERIAL


      $('#button_material').click(function(e){
            e.preventDefault();
            $('.modal').show();
            $('.modal').css("z-index","100");
            $('#formulario_material').show();

      })

      $('#button_detalleMaterial').click(function(e){
        e.preventDefault();
        $('.modal_agregar_cantidad').css("z-index","100");
          $('.modal_agregar_cantidad').show();
          $('#formulario_detalleMaterial').show();
      })
      $(document).on('click','#buttonCloseDetalleMaterial',function(e){
          e.preventDefault();
              $('.modal_agregar_cantidad').hide();
            $('#formulario_detalleMaterial').hide();
      })
      // $('#')
      // $(document).on('click','#prestarLibro',function(e){
      //    e.preventDefault();
      //   console.log("mostrar")
      //   $('.modalOtorgarLibro').show();
      //   $('#formulario_prestamo').show();
      // })



       // BUTTONES FORMS MODALS MODULES
      $('#button_alumno').click(function(e){
            e.preventDefault();
                    $('.box_form').css("width","700px");
            $('.modal').show();
            $('.modal').css("z-index","100");
            $('#titulo_EditarEstudiante').hide();
            $('#formulario_alumno').show();
            $('#modificar_Estudiante').hide();
            $('#agregar_Estudiante').show();
            $("#titulo_Estudiante").show();
            $('#formVerApoderado').hide();
            $("#titulo_EditarEstudiante").hide();
            $('#formulario_alumno').show();
            $('#form-apoderado').show();
            $('#nombreEstudiante').val("");
            $('#apellidoEstudiante').val("");
            $('#DniEstudiante').val("");
            $('#DniEstudiante').prop("readonly",false);
            $('#DniEstudiante').css("background","#0000");
            $('#gradoEstudiante').val("");
            $('#seccionEstudiante').val("");
      })

      $(document).on('click','#button_close_prestamo',function(e){
          e.preventDefault();
          // $('#DNI').empty(' ');
          $('.formularioPrestamo').hide();
        });

        $(document).on('click','#button_close_apoderado',function(e){
            e.preventDefault();
            $('.modal').hide();
          });

      $(document).on('click','#button_close_material',function(e){
          e.preventDefault();
          $('.modal').hide();
        });
        $(document).on('click','#atras_Libro ',function(e){
            e.preventDefault();
            $('#DNI').val('');
            $('#nombreEstudiante').val(' ');
            $('#apellidoEstudiante').val(' ');
            $('#gradoEstudiante').val(' ');
            $('#seccionEstudiante').val(' ');
            $('.formularioPrestamo').hide();
          });

      $(document).on('click','#button_close_devolucion',function(e){
          e.preventDefault();
          $('.formularioDevolucion').hide();
        });
      $(document).on('click','#button_close_motivo',function(e){
          e.preventDefault();
          $('.verMotivo').hide();
        });
            //fomrulario apoderado
      $('.btn_exit_X').click(function(e){
          e.preventDefault()
          $('.modal').hide();
      })

})

let Checked = null;
for (let CheckBox of document.getElementsByClassName('checkBoxFilter')){
	CheckBox.onclick = function(){
  	if(Checked!=null){
      Checked.checked = false;
      Checked = CheckBox;
    }
    Checked = CheckBox;
  }
}
// }
$(document).ready(function(){
  const icon_show="fas fa-eye";
   const icon_hide="fas fa-eye-slash";
   
   $('#show-hide1').on('click',function(e){
     e.preventDefault();
     var current=$(this).attr('action');
     if(current == 'hide'){
       $(this).prev().attr('type','text');
       $(this).removeClass(icon_show).addClass(icon_hide).attr('action','show');
     }
     if(current == 'show'){
         $(this).prev().attr('type','password');
       $(this).removeClass(icon_hide).addClass(icon_show).attr('action','hide');
     }
   })
   
     $('#show-hide2').on('click',function(e){
     e.preventDefault();
     var current=$(this).attr('action');
     if(current == 'hide'){
       $(this).prev().attr('type','text');
       $(this).removeClass(icon_show).addClass(icon_hide).attr('action','show');
     }
     if(current == 'show'){
         $(this).prev().attr('type','password');
       $(this).removeClass(icon_hide).addClass(icon_show).attr('action','hide');
     }
   })
   
   $('#form_recovery_password').submit(function(e){
     e.preventDefault();
     const param ={
       "password":$('#password').val(),
       "repeatpassword":$('#repeatpassword').val()
     }
     console.log(param);
     $('#form_recovery_password')[0].reset();
    
   })
   
 });