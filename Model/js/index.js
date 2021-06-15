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

      }else{
         $('.container').css("width","95%");
         $('.header-container').css("width","80%");
         $('.body-container').css("width","80%");
           $('.logout').css("right","15%");
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
            $('#formulario_material').show();
      })

      $(document).on('click','#buttonCloseDetalleMaterial',function(e){
          e.preventDefault();
              $('.modal_agregar_cantidad').hide();
            $('#formulario_detalleMaterial').hide();
      })
      // $('#')
      $(document).on('click','#prestarLibro',function(e){
         e.preventDefault();
        console.log("mostrar")
        $('.modalOtorgarLibro').show();
        $('#formulario_prestamo').show();
      })



       // BUTTONES FORMS MODALS MODULES
      $('#button_alumno').click(function(e){
            e.preventDefault();
            $('.modal').show();
            $('#editar_Estudiante').hide();
            $('#formulario_alumno').show();
      })

      $(document).on('click','#button_close_prestamo',function(e){
          e.preventDefault();
          $('.formularioPrestamo').hide();
        });

      $(document).on('click','#button_close_material',function(e){
          e.preventDefault();
          $('.modal').hide();
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


          //
          var ctx = document.getElementById('myChart').getContext('2d');
          function graphics(){
            var myChart = new Chart(ctx, {
                  type: 'bar',
                  data: {
                      labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                      datasets: [{
                          label: '# of Votes',
                          data: [12, 19, 3, 5, 2, 3],
                          backgroundColor: [
                              'rgba(255, 99, 132, 0.2)',
                              'rgba(54, 162, 235, 0.2)',
                              'rgba(255, 206, 86, 0.2)',
                              'rgba(75, 192, 192, 0.2)',
                              'rgba(153, 102, 255, 0.2)',
                              'rgba(255, 159, 64, 0.2)'
                          ],
                          borderColor: [
                              'rgba(255, 99, 132, 1)',
                              'rgba(54, 162, 235, 1)',
                              'rgba(255, 206, 86, 1)',
                              'rgba(75, 192, 192, 1)',
                              'rgba(153, 102, 255, 1)',
                              'rgba(255, 159, 64, 1)'
                          ],
                          borderWidth: 1
                      }]
                  },
                  options: {
                      scales: {
                          y: {
                              beginAtZero: true
                          }
                      }
       }
        });
          }

            graphics();
})

let Checked = null;
for (let CheckBox of document.getElementsByClassName('check_estado')){
	CheckBox.onclick = function(){
  	if(Checked!=null){
      Checked.checked = false;
      Checked = CheckBox;
    }
    Checked = CheckBox;
  }
}