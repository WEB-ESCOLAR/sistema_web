 $(document).ready(function(){

  let dataExist=0;
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
          //raa
          $(document).on('click','#agregar_Estudiante',function(e){
            e.preventDefault();
            var datastring = $("#formulario_alumno").serialize();
             console.log(datastring);
             console.log(dataExist)
             $.ajax({
                url:"Controller/ControllerEstudiante.php",
                type:"POST",
                data:datastring+`&apoderadoExist=${dataExist}&action=AgregarEstudiante`,
            }).done(function(response){
                console.log("RESULTADO ESPERADO AGREGAR " + response);
                $('.modal').hide();
                $('#formulario_alumno').hide();
                location.reload();
            })
        });



// raaaaaaaaaa
      //   $('#search_student').click(function(e){
      //   e.preventDefault();
      //   const param={
      //     grade: $('#search_grade_student').val(),
      //     section: $('#search_section_student').val(),
      //     action: 'BuscarGradoAndSection'
      //   }
      //   $.ajax({
      //     url:"Controller/ControllerEstudiante.php",
      //     type:"POST",
      //     data:param
      //   }).done(function(response){
      //     console.log("resultado esperado es " + response)
      //   })
      // });
      //buscar alumno grado y seccion , action : BuscarGradoAndSection
      //mostrar total estudiantes , action : MostrarTotalEstudiantesPorGradoYSeccion


      $(document).on('click','#search_dni',function(e){
          e.preventDefault();
          const param={
            dni:$('#DniApoderado').val(),
            action:"SearchDniApoderado"
          }
          $.ajax({
            url:"Controller/ControllerEstudiante.php",
            type:"GET",
            data:param,
            dataType:"JSON"
          }).done(function(response){
            if(!response){
              Swal.fire({
                title: 'No existe DNI ingresado',
                icon: 'warning',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'confirmar'
              })
              $('#nombreApoderado').val("");
              $('#apellidoApoderado').val("");
              $('#telefonoApoderado').val("");
              dataExist=0
            }else{
              $('#nombreApoderado').val(response.firstName);
              $('#apellidoApoderado').val(response.lastName);
              $('#telefonoApoderado').val(response.phone);
              dataExist=1
              console.log(response)
            }
          })

      })
      // search_dni


      $(document).on('click','#editar-estudiante',function(e){ // mmodal editar
         e.preventDefault();
        $('#formulario_alumno').show();
        $('#form-apoderado').hide();
        $('#modificar_Estudiante').show();
        $("#titulo_Estudiante").hide();
        $("#titulo_EditarEstudiante").show();
        $("#titulo_MostrarApoderado").hide();
        $('#formVerApoderado').hide();
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
           //$('#DniEstudiante').prop("disabled",true);
           $('#DniEstudiante').prop("readonly",true);
           $('#DniEstudiante').css("background","rgba(0,0,0,0.10)");
           $('#form-apoderado').hide();
           $('#agregar_Estudiante').hide();
           $('#button_close_material').val(id);
         });

      });

      $(document).on('click','#modificar_Estudiante',function(e){
        e.preventDefault();
        var datastring = $("#formulario_alumno").serialize();
         console.log(datastring);
           $.ajax({
            url:"Controller/ControllerEstudiante.php",
            type:"POST",
            data:datastring+"&action=UpdateEstudiante",
         }).done(function(response){
            console.log("response is " + response )
            alertSuccess("Datos del Estudiante Actualizado Correctamente","");
            $('#form_estudiante').hide();
            $('.modal').hide();
            setTimeout(function(){
            location.reload();
            },2000)
         })
      })

      $(document).on('click','#mostrarApoderado',function(e){
           e.preventDefault();
           $('#formVerApoderado').show();
           $("#titulo_MostrarApoderado").show();
           $("#formulario_alumno").hide();
            var id = $(this).attr("name");
              const param={
                 "id":id,
                 "action":"DetalleApoderado"
             }
            $.ajax({
               url:"Controller/ControllerEstudiante.php",
               type:"GET",
               data:param,
               dataType: 'json',
            }).done(function(response){
              $('.modal').show();
              $('#VernombreApoderado').text(response.firstName);
              $('#verapellidoApoderado').text(response.lastName);
              $('#vertelefonoApoderado').text(response.phone);
              $('#verDniApoderado').text(response.DNI);

            });

         })

  });
