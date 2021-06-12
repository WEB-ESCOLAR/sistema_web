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

      $(document).on('click','#button_close_material',function(e){
          e.preventDefault();
          $('.modal').hide();
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
