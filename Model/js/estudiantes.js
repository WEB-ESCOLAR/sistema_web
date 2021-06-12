 $(document).ready(function(){


    $(document).on('click','.btn_TblDeleteEs',function(e){
              var id = $(this).attr("id");
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
                confirmButtonText: 'Yes, delete it!'
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
            var param={
                DniEstudiante: $('#DniEstudiante').val(),
                nombreEstudiante: $('#nombreEstudiante').val(),
                apellidoEstudiante: $('#apellidoEstudiante').val(),
                gradoEstudiante: $('#gradoEstudiante').val(),
                seccionEstudiante: $('#seccionEstudiante').val(),
                DniApoderado: $('#DniApoderado').val(),
                nombreApoderado: $('#nombreApoderado').val(),
                apellidoApoderado: $('#apellidoApoderado').val(),
                telefonoApoderado: $('#telefonoApoderado').val(),
                action:"AgregarEstudiante"
            }
             console.log(param);
             $.ajax({
                url:"Controller/ControllerEstudiante.php",
                type:"POST",
                data:param
            }).done(function(response){
                console.log("RESULTADO ESPERADO AGREGAR " + response);
                //$('#formulario_alumno').hide();
                //location.reload();

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
        
      })



  });