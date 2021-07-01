 $(document).ready(function(){
     
  const refactorize = new Refactorize();
  const {GET,POST} = refactorize.methodHTTP();
  const {estudianteURL,materialURL2,detalleMaterialURL} = refactorize.consumeUrl();
  const {SUCCESS} = refactorize.typeICON();

      var url = window.location.href;
        const urlSplit = url.split("/")[5]
          $('#btn_back').click(function(e){
             window.history.back();
          });

          function setDataOrEdit(response,boolean,background){
            let data = response === null ? ' ' : response
                 $('#entregarLibro').prop("disabled",boolean);
                  $('#entregarLibro').css("background",background);
                  $('.buscarEstudiante').val(data.idEstudiante);
                  $('#nombreEstudiante').val(data.firstName);
                  $('#apellidoEstudiante').val(data.LastName);
                  $('#gradoEstudiante').val(data.grado);
                  $('#seccionEstudiante').val(data.section);
          }

            // AGREGAR DETALLE MATERIAL
            $(document).on('click','#agregar_detallematerial',async function(e){
               e.preventDefault();
               var param={
                 cantidad:$('#cantidad').val(),
                 idDetalleMaterial: urlSplit,
                 action:"AgregarDetalleCantidad"
               }
               console.log(param)
               const response= await refactorize.getDataController(materialURL2,POST,param);
               console.log(response)
               alertSuccess("Se registro correctamente","",SUCCESS);
                      setTimeout(function(){
                    location.reload();
                  },2000)
            });
            // ELIMINAR DETALLE MATERIAL
            $(document).on('click','#eliminarDetalleMaterial',async function(e){
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
                      }).then( async (result) => {
                        if (result.isConfirmed) {
                        await refactorize.getDataController(materialURL2,POST,param);
                        location.reload() 
                        }
                    })

               })
        // OTORGAR LIBREO
        $(document).on('click','#prestarLibro',function(e){
          e.preventDefault();
          const idDetalle = $(this).attr("name")
         $('.formularioPrestamo').show();
         $('#button_close_prestamo').val(idDetalle)
       })

        //BUSCAR ALUMNO
        $(document).on('click','#buscarEstudiante',async function(e){
          e.preventDefault();
          var dni = $('#DNI').val();
          const param={
              "DNI":dni,
              "action":"buscarAlumno"
          }
          const response = await refactorize.getDataController(materialURL2,GET,param);
          if(!response){
           alertWarning("No existe el dni ingresado")
          }else{
           $('.buscarEstudiante').val(response.idEstudiante);
           $('.btn-entregarLibro').prop("disabled",false);
           setDataOrEdit(response,false,"var(--primary)")
            $('#entregarLibro').prop("disabled",false);
          }
      })

         $(document).on('click','#btn_entregarLibro',async function(e){
         e.preventDefault();
         const param={
             idDetaMate:$('#button_close_prestamo').val(), //id detallematerial
             idEstu:$('.buscarEstudiante').val(), //id
             action:"prestarMaterial"
         }
         await refactorize.getDataController(materialURL2,POST,param);
         location.reload();
       })

       //DEVOLUCION DE MATERIAL
      //  ------------------------------------
       $(document).on('click','#modal_devolucion', async function(e){
        e.preventDefault();
        var idDetMat = $(this).attr("name");
        var idPrestamoDevolucion = $(this).attr("value");
      $('#formulario_devolucion').val(idPrestamoDevolucion)
       console.log(idPrestamoDevolucion)
       $('.formularioDevolucion').show();
       $('#button_close_devolucion').val(idDetMat);
      })

       $(document).on('click','#btn_devolverLibro', async function(e){
         e.preventDefault();
         console.log("devovler libro")
         const param={
          idDetaMate:$('#button_close_devolucion').val(),
          motivo:$('#motivo').val(),
          type:$('#tipoMotivo').val(),
          idPrestamoDevolucion:$("#formulario_devolucion").val(),
          action:"Devolver"
         }
         console.log(param)
         await refactorize.getDataController(materialURL2,POST,param);
         location.reload();
       })
       // -----------------------------------------------------------

       //MOSTRAR MOTIVO DE DEVOLUCION POR MODAL
       $(document).on('click','#modal_motivo',async function(e){
         e.preventDefault();
         const idDevo = $(this).attr("name")
         const param={
            "idDevo":idDevo,
            "action":"verMotivo"
        }
        const response = await refactorize.getDataController(materialURL2,GET,param);
        if(response != null){
            $('.verMotivo').show();
            $('#vermotivo').val(' '+response.motivo);
            if(response.asunto == "Otros"){
                   $('#MotivoLabel').show();
                   $('#MotivoDiv').show();
               }else{
                 $('#MotivoLabel').hide();
                 $('#MotivoDiv').hide();
                
               }
        }
       })


      

   






  });
