 $(document).ready(function(){
     var url = window.location.href;
        const urlSplit = url.split("/")[5]

          $('#btn_back').click(function(e){
             window.history.back();
          });

 	////////////////EVENTO PARA AGREAGR UN DETALLE MATERIAL (CANTIDAD)///////7
            $(document).on('click','#agregar_detallematerial',function(e){
               e.preventDefault();
               var param={
                 cantidad:$('#cantidad').val(),
                 idDetalleMaterial: urlSplit,
                 action:"AgregarDetalleCantidad"
               }
                $.ajax({
                   url:"../Controller/ControllerMaterial.php",
                   type:"POST",
                   data:param
               }).done(function(response){
               	    alertSuccess("Se registro correctamente","");
                    console.log(response)
                  setTimeout(function(){
                    location.reload();
                  },2000)
               })
            });

////////////////EVENTO PARA ELIMINAR UN DETALLE MATERIAL (CANTIDAD)///////7
            $(document).on('click','#eliminarDetalleMaterial',function(e){
                   var idDta = $(this).attr("name");
                   e.preventDefault();
                   const param={
                       idDta:idDta,
                       action:"EliminarDetalleMaterial"
                   }

                        Swal.fire({
                        title: 'Esta seguro de eliminar?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si , deseo eliminar!'
                      }).then((result) => {
                        if (result.isConfirmed) {
                          $.ajax({
                           url:"../Controller/ControllerMaterial.php",
                           type:"POST",
                           data:param
                           }).done(function(response){
                             location.reload();
                           })

                        }
                    })

               })
        //----------------------------
         $(document).on('click','#entregarLibro',function(e){
         e.preventDefault();
         const param={
             idDetaMate:$('#button_close_prestamo').val(), //id detallematerial
             idEstu:$('.buscarEstudiante').val(), //id
             action:"prestarMaterial"
         }
         $.ajax({
             url:"../Controller/ControllerMaterial.php",
             type:"POST",
             data:param
         }).done(function(response){
             location.reload();
         })
       })
       //npo
       $(document).on('click','#devolverLibro',function(e){
         e.preventDefault();
         const param={
             idDetaMate:$('#button_close_devolucion').val(),
             motivo:$('#motivo').val(),
             idPrestamoDevolucion:$("#mostrar_devolucion").val(),
             action:"Devolver"
         }
         console.log(param);
         $.ajax({
            url:"../Controller/ControllerMaterial.php",
            type:"POST",
            data:param
        }).done(function(response){
            location.reload();
        })
       })

       $(document).on('click','#mostrar_motivo',function(e){
         e.preventDefault();
         var idDevo = $(this).attr("name");
         const param={
            "idDevo":idDevo,
            "action":"verMotivo"
        }
        console.log("idDevo" + idDevo);
         $.ajax({
            url:"../Controller/ControllerMaterial.php",
            type:"GET",
            data:param,
            dataType: 'json'
        }).done(function(response){
          console.log(response);
            $('.verMotivo').show();
            $('#vermotivo').val(' '+response.motivo);
        })
       })

       $(document).on('click','#prestarLibro',function(e){
         e.preventDefault();
         $('#entregarLibro').prop("disabled",true);
         $('#entregarLibro').css("background","#5E80A6");
         $('#DNI').val('');
         $('#nombreEstudiante').val(' ');
         $('#apellidoEstudiante').val(' ');
         $('#gradoEstudiante').val(' ');
         $('#seccionEstudiante').val(' ');

         var idDetMat = $(this).attr("name");
         const param={
            "idDetMat":idDetMat,
        }
         $.ajax({
            url:"../Controller/ControllerMaterial.php",
            type:"POST",
        }).done(function(response){
            $('.formularioPrestamo').show();
            $('#button_close_prestamo').val(idDetMat);
         })
       })

       

        $(document).on('click','#mostrar_devolucion',function(e){
          e.preventDefault();
          var idDetMat = $(this).attr("name");
          const param={
             "idDetMat":idDetMat,
             "idPrestamoDevolucion":$("#mostrar_devolucion").val()
         }
         console.log(param)
          $.ajax({
             url:"../Controller/ControllerMaterial.php",
             type:"POST",
         }).done(function(response){
             $('.formularioDevolucion').show();
             $('#button_close_devolucion').val(idDetMat);
         })
        })

        //BUSCAR ALUMNO
        $(document).on('click','#buscarEstudiante',function(e){

           e.preventDefault();
           var dni = $('#DNI').val();
           const param={
               "DNI":dni,
               "action":"buscarAlumno"
           }
           console.log("DNI"+dni);
           $.ajax({
             url:"../Controller/ControllerMaterial.php",
             type:"GET",
             data:param,
             dataType: 'json',
           })
           .done(function(response){
              console.log(response);
              if (!response){
               Swal.fire({
                 title: 'No existe DNI ingresado',
                 icon: 'warning',
                 showCancelButton: false,
                 confirmButtonColor: '#3085d6',
                 cancelButtonColor: '#d33',
                 confirmButtonText: 'confirmar'
               })
             } else {
               $('#entregarLibro').prop("disabled",false);
               $('#entregarLibro').css("background","var(--primary)");
               $('.buscarEstudiante').val(response.idEstudiante);
               $('#nombreEstudiante').val(' '+response.firstName);
               $('#apellidoEstudiante').val(' '+response.LastName);
               $('#gradoEstudiante').val(' '+response.grado);
               $('#seccionEstudiante').val(' '+response.section);
               $('.btn-entregarLibro').prop("disabled",false);


                }


             })

       })

   






  });
