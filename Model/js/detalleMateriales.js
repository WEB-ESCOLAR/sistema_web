 $(document).ready(function(){


          $('#btn_back').click(function(e){
             window.history.back();
          });

 	////////////////EVENTO PARA AGREAGR UN DETALLE MATERIAL (CANTIDAD)///////7
            $(document).on('click','#agregar_detallematerial',function(e){
               e.preventDefault();
               var param={
                 cantidad:$('#cantidad').val(),
                 action:"AgregarDetalleCantidad"
               }
                console.log(param);
                $.ajax({
                   url:"../Controller/ControllerMaterial.php",
                   type:"POST",
                   data:param
               }).done(function(response){
               	    alertSuccess("Se registro correctamente","");
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
                       $.ajax({
                           url:"../Controller/ControllerMaterial.php",
                           type:"POST",
                           data:param
                       }).done(function(response){
                      	 location.reload();
                       })

               })
        //----------------------------
         $(document).on('click','#entregarLibro',function(e){
         e.preventDefault();
         const param={
             idDetaMate:$('.detaLibro').val(),
             idEstu:$('.estudiante').val(),
             action:"prestarMaterial"
         }
         $.ajax({
             url:"Controller/ControllerMaterial.php",
             type:"POST",
             data:param
         }).done(function(response){
             console.log("respone is " + response )
             location.reload();
         })
       })

       $(document).on('click','#devolverLibro',function(e){
         e.preventDefault();
         const param={
             idDetaMate:$('.detLibro').val(),
             motivo:$('#motivo').val(),
             action:"Devolver"
         }
         console.log(param);
         $.ajax({
            url:"Controller/ControllerMaterial.php",
            type:"POST",
            data:param
        }).done(function(response){
            console.log("respone is " + response )
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
            url:"Controller/ControllerMaterial.php",
            type:"GET",
            data:param,
            dataType: 'json'
        }).done(function(response){
            $('.modalVerMotivo').show();
            $('#vermotivo').val(' '+response.motivo);
        })
       })


        //MOSTRANDO EL FRAME DE ENTREGAR LIBRO
        // $(document).on('click','#mostrar_alumno',function(e){ // mal solo es un evento 
        //   e.preventDefault();
        //   var idDetMat = $(this).attr("name");
        //   const param={
        //      "idDetMat":idDetMat,
        //  }
        //  //console.log("idDetMat"+idDetMat);
        //   $.ajax({
        //      url:"Controller/ControllerMaterial.php",
        //      type:"POST"
        //  }).done(function(response){
        //      $('.modal').show();
        //      $('.detaLibro').val(idDetMat);
        //      $('#entregarLibro').prop("disabled",true);
        //  })
        // })

        $(document).on('click','#mostrar_devolucion',function(e){
          e.preventDefault();
          var idDetMat = $(this).attr("name");
          const param={
             "idDetMat":idDetMat,
         }
          $.ajax({
             url:"Controller/ControllerMaterial.php",
             type:"POST",
         }).done(function(response){
             $('.modalDevolver').show();
             $('.detLibro').val(idDetMat);
         })
        })

        //BUSCAR ALUMNO
        $(document).on('click','#buscar_alumno',function(e){
           e.preventDefault();
           var dni = $('#DNI').val();
           const param={
               "DNI":dni,
               "action":"buscarAlumno"
           }
           console.log("DNI"+dni);
           $.ajax({
             url:"Controller/ControllerMaterial.php",
             type:"GET",
             data:param,
             dataType: 'json',
           })
           .done(function(response){
             //$('.modal').reload();
             $('.estudiante').val(response.idEstudiante);
             $('#nombreEstu').val(' '+response.firstName);
             $('#apellidoEstu').val(' '+response.LastName);
             $('#gradoEstu').val(' '+response.grado);
             $('#seccionEstu').val(' '+response.section);
             $('#entregarLibro').prop("disabled",false);
           })
       })




  });