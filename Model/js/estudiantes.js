 $(document).ready(function(){


    $(document).on('click','#eliminarEstudiante',function(e){
              var id = $(this).attr("name");
              e.preventDefault();
              const param={
                  "id":id,
                  "action":"EliminarEstudiante"
              }
              console.log("id"+id);
              Swal.fire({
                title: '¿Esta seguro de eliminar?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'confirmar'
              }).then((result) => {
                if (result.isConfirmed) {
                  $.ajax({
                      url:"Controller/ControllerEstudiante.php",
                      type:"POST",
                      data:param
                  }).done(function(response){

                       Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                          )
                      location.reload();
                  })
                }
              })
          })

          $(document).on('click','#agregar_Estudiante',function(e){
            e.preventDefault();
            var datastring = $("#formulario_alumno").serialize();
             console.log(datastring);
             $.ajax({
                url:"Controller/ControllerEstudiante.php",
                type:"POST",
                data:datastring+"&action=AgregarEstudiante",
            }).done(function(response){
                console.log("RESULTADO ESPERADO AGREGAR " + response);
                $('.modal').hide();
                $('#formulario_alumno').hide();

            })
        });

        $('#search_student').click(function(e){
        e.preventDefault();
        const param={
          grade: $('#search_grade_student').val(),
          section: $('#search_section_student').val(),
          action: 'BuscarGradoAndSection'
        }
        $.ajax({
          url:"Controller/ControllerEstudiante.php",
          type:"POST",
          data:param
        }).done(function(response){
          console.log("resultado esperado es " + response)
        })
        
      });
      $(document).on('click','#editar-estudiante',function(e){ // mmodal editar
        e.preventDefault();
        $('#formulario_alumno').show();
        $('#editar_Estudiante').show();
        $("#titulo_Estudiante").val("Editar Estudiante")

         var id = $(this).attr("name");
           const param={
              "id":id,
              "action":"DetalleEstudiante"
           }
         $.ajax({
            url:"Controller/ControllerEstudiante.php",
            type:"GET",
            data:param,
            dataType: 'json',
         }).done(function(response){
           $('.modal').show();
           $('#nombreEstudiante').val(response.firstName);
           $('#apellidoEstudiante').val(response.LastName);
           $('#DniEstudiante').val(response.dni);
           $('#gradoEstudiante').val(response.grado);
           $('#seccionEstudiante').val(response.section);
           $('#DniEstudiante').prop("disabled",true);
           $('#DniEstudiante').css("background","rgba(0,0,0,0.10)");
           $('#form-apoderado').hide();
           $('#agregar_Estudiante').hide();
          //  $('#titulo_Estudiante').hide();
          //  $('#titulo_EditarEstudiante').show();
           $('#button_close_material').val(id);
         });
         
      });

      $(document).on('click','#editar_Estudiante',function(e){
        e.preventDefault();
         var datastring = $("#formulario_alumno").serialize();
         const dni = $('#DniEstudiante').val();
         const param={
              idEstudiante: $('#button_close_material').val(),
              nombreEstudiante:       $('#nombreEstudiante').val(),
              apellidoEstudiante :    $('#apellidoEstudiante').val(),
              gradoEstudiante :       $('#gradoEstudiante').val(),
              seccionEstudiante :     $('#seccionEstudiante').val(),
              DniEstudiante :         $('#DniEstudiante').val(),
              action :"UpdateEstudiante"
         }
         console.log(param);
           $.ajax({
            url:"Controller/ControllerEstudiante.php",
            type:"POST",
            data:param,
         }).done(function(response){
            console.log("respone is " + response )
            alertSuccess("Datos del Estudiante Actualizado Correctamente","");
            $('#formulario_alumno').hide();
            $('.modal').hide();
            setTimeout(function(){
            // location.reload();
            })
         })
      })



  });