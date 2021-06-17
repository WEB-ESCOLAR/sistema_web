$(document).ready(function(){


	$(document).on('click','.btn-apafa',function(e){
              e.preventDefault();
              var id = $(this).attr("id");
                 const param={
                  "id":id,
                  "action":"PagoApafa"
                }
               var name = $(this).attr("name");
                 Swal.fire({
                title: 'El apoderado ' + name + " realizara el pago de la boleta APAFA?",
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si'
              }).then((result) => {
                   $.ajax({
                      url:"Controller/ControllerEstudiante.php",
                      type:"POST",
                      data:param
                  }).done(function(responseApoderado){
                       Swal.fire(
                         'Modificado!',
                         'Pago realizado con Exito!',
                          'success'
                         )
                      location.reload();
                  })
                })

          })


     $(document).on('click','.btn-print',function(e){
             e.preventDefault();
              var name = $(this).attr("name");
              Swal.fire({
                title: 'Esta Seguro de Generar una boleta de Pago Apafa para ' + name,
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si'
              }).then((result) => {
                if (result.isConfirmed) {
                  Swal.fire(
                    'Boleta Generado con Exito!',
                    '',
                    'success'
                  )
                }
              })

     });
     // ******************************************************
        //------- CRUD
         $(document).on('click','#editar_apoderado',function(e){
              e.preventDefault();
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
                 $('#nombre').val(response.firstName);
                 $('#apellido').val(response.lastName);
                 $('#telefono').val(response.phone);
                 $('#dni').val(response.DNI);
                 $('#dni').prop("readonly",true);
                 $('#dni').css("background","rgba(0,0,0,0.10)");
               });

            })


         $(document).on('click','#btn_update_apoderado',function(e){
              e.preventDefault();
              // console.log("press");
               var datastring = $("#formulario_apoderado").serialize();
              //  const dni = $('#dni').val();
              //  const param={
              //       nombre:   $('#nombre').val(),
              //       apellido :  $('#apellido').val(),
              //        telefono : $('#telefono').val(),
              //       dni : $('#dni').val(),
              //       action :"UpdateApoderado"
              //  }
               console.log("datastring: "+datastring);
                 $.ajax({
                  url:"Controller/ControllerEstudiante.php",
                  type:"POST",
                  data:datastring+"&action=UpdateApoderado",
               }).done(function(response){
                  console.log("respone is " + response )
                  alertSuccess("Datos del Apoderado Actualizado Correctamente","");
                  $('#formulario_apoderado').hide();
                  $('.modal').hide();
                  setTimeout(function(){
                    //location.reload();
                  },2000)
               })
            })



})
