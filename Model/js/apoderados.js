$(document).ready(function(){

  const refactorize = new Refactorize();
  const {GET,POST} = refactorize.methodHTTP();
  const {estudianteURL} = refactorize.consumeUrl();
  const {SUCCESS} = refactorize.typeICON();

	$(document).on('click','.btn-apafa',function(e){
              e.preventDefault();
              var id = $(this).attr("id");
                 const param={"id":id,"action":"PagoApafa"}
               var name = $(this).attr("name");
                 Swal.fire({
                title: 'El apoderado ' + name + " realizara el pago de la boleta APAFA?",
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si'
              }).then(async (result) => {
                  if(result.isConfirmed){                
                  await refactorize.getDataController(estudianteURL,POST,param);
                  location.reload();
                  }
                })
          })

          //r
     $(document).on('click','.btn-print',function(e){
             e.preventDefault();
              var name = $(this).attr("name");
							var id = $(this).attr("id");
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
                  alertModal("Boleta Generado con Exito!","",SUCCESS);
									window.location="./util/boletaApafa.php?id=" + id;
                }
              })
     });
     // ******************************************************
        //------- CRUD
         $(document).on('click','#editar_apoderado',async function(e){
              e.preventDefault();
               var id = $(this).attr("name");
                 const param={
                    "id":id,
                    "action":"DetalleApoderado"
                }
               const response  = await refactorize.getDataController(estudianteURL,GET,param);
                if(response != null){
                  $('.modal').show();
                 $('#nombre').val(response.firstName);
                 $('#apellido').val(response.lastName);
                 $('#telefono').val(response.phone);
                 $('#dni').val(response.DNI);
                 $('#dni').prop("readonly",true);
                 $('#dni').css("background","rgba(0,0,0,0.10)");
                }
            })


         $(document).on('click','#btn_update_apoderado',async function(e){
              e.preventDefault();
               var datastring = $("#formulario_apoderado").serialize();
               const param = datastring+"&action=UpdateApoderado"
               const response  = await refactorize.getDataController(estudianteURL,POST,param);
              if(response){
                 alertModal("Datos del Apoderado Actualizado Correctamente","",SUCCESS);
                  $('#formulario_apoderado').hide();
                  $('.modal').hide();
                  setTimeout(function(){
                    location.reload();
                  },2000)
              }
            })



})
