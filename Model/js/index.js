$(document).ready(function(){


  	$('.bar').on('click', function(){
  	  $('.contenido').toggleClass('open');
  	})
    // LOGIN USER
    // *************************
    $('#formulario_login').on('submit',function(e){
        e.preventDefault();
        var param = $(this).serialize()
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
    //BUTTONS MODALS
      $('#button_material').click(function(e){
            e.preventDefault();
            $('.modal').show();
            $('#formulario_material').show();
                // $('#formulario_apoderado').show();
        })

      $('#button_alumno').click(function(e){
            e.preventDefault();
            $('.modal').show();
            $('#formulario_alumno').show();
      })

      $(document).on('click','#button_close_prestamo',function(e){
          e.preventDefault();
          $('.modal').hide();
        });

      $(document).on('click','#button_close_material',function(e){
          e.preventDefault();
          $('.modal').hide();
        });

      $(document).on('click','#button_close_devolucion',function(e){
          e.preventDefault();
          $('.modalDevolver').hide();
        });
      $(document).on('click','#button_close_motivo',function(e){
          e.preventDefault();
          $('.modalVerMotivo').hide();
        });
            //fomrulario apoderado
      $('.btn_exit_X').click(function(e){
          e.preventDefault()
          $('.modal').hide();
      })




})
