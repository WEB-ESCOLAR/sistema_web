$(document).ready(function(){

mostrarCurso();

      showDetalleMaterial();
            $("#tipoMaterial").on('change',function(){
                var dato = $('#tipoMaterial').val();
                if(dato == "Otros"){
                    $('#box_name_material').show();
                }else{
                    $('#box_name_material').hide();
                }
                console.log("dato es " + dato);
            })

             $(document).on('click','#agregar_material',function(e){
                e.preventDefault();
                var param={
                    curso: $('#curso').val(),
                    grado: $('#grado').val(),
                    fechaRecepcion: $('#fecha_recepcion').val(),
                    cantidad: $('#cantidad').val(),
                    tipoMaterial: $('#tipoMaterial').val(),
                    nombreMaterial:$('#nombreMaterial').val(),
                    action:"Agregar"
                }
                 console.log(param);
                 $.ajax({
                    url:"Controller/ControllerMaterial.php",
                    type:"POST",
                    data:param
                }).done(function(response){
                    console.log("RESULTADO ESPERADO AGREGAR " + response);
                    $('#formulario_material').hide();
                    location.reload();

                })
            });


            $(document).on('click','#detalleMaterial',function(e){
              e.preventDefault();
                var url = window.location.href;
                const nombreModulo =url.split("/")[4];
                var id = $(this).attr("name");
                console.log("detalle material is " + id);
                if(nombreModulo === "GestionDeMateriales"){
                    window.location="AdministrarMateriales/" + id;
                }else{
                    console.log("detalle material")
                   window.location="DetalleMaterial/" + id;
                }
           })


          function showDetalleMaterial(){
           var url = window.location.href;
          const idMaterial =url.split("/")[5];
          $('#mensaje').append(`El id del Material es ` + idMaterial)
        }

        function mostrarCurso(){
          $.ajax({
            url:"Controller/ControllerMaterial.php",
            data:{action:"loadCurse"},
          })
          .done(function(response){
              const respuestaArray = JSON.parse(response)
             respuestaArray.forEach((element)=>{
               $('#curso').append(
                  `
          <option value="${element.idCurso}">${element.descripcion}</option>
                  `
            );
           })
          }).fail(function(er){
            console.log("error" + er)
          })
        }

        $(document).on('click','#deleteMaterial',function(e){
            var id = $(this).attr("name");
            e.preventDefault();
            const param={
                "id":id,
                "action":"Eliminar"
            }
            Swal.fire({
              title: 'Esta seguro de eliminar?',
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              if (result.isConfirmed) {
                $.ajax({
                    url:"Controller/ControllerMaterial.php",
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




       //PRESTAR LIBRO







     // })

            // $(document).on('click',"#checkDisponible",function(e){

            // })

             // btn_TblUpdate

        //     $(document).on('click','#detalleMaterial',function(e){
	       //    e.preventDefault();
	       //    console.log("detalle material")
	       //    window.location="DetalleMateriales";
	       // })





})
