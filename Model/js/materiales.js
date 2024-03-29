$(document).ready(function(){

mostrarCurso();
      const refactorize = new Refactorize();
      const {GET,POST} = refactorize.methodHTTP();
      const {estudianteURL,materialesURL} = refactorize.consumeUrl();
      const {SUCCESS} = refactorize.typeICON();

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

             $(document).on('click','#agregar_material',async function(e){
                e.preventDefault();
                const formulario_material = $('#formulario_material').serialize();
                const form_concat=formulario_material+"&action=Agregar"
                console.log(form_concat)
                if($('#formulario_material').valid()){
                 await refactorize.getDataController(materialesURL,POST,form_concat)
                       $('#formulario_material').hide();
                    location.reload();
                }
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
            $("#tipoMotivo").on('change',function(){
              var dato = $('#tipoMotivo').val();
              if(dato == "Dañado"){
                  $('#box_area_motivo').show();
              } else if(dato =="Otros"){
                $('#box_area_motivo').show();

              }else{
                  $('#box_area_motivo').hide();
              }
              console.log("dato es " + dato);
          })

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
              cancelButtonText:"Cancelar",
              confirmButtonText: 'Si eliminar!'
            }).then((result) => {
              if (result.isConfirmed) {
                $.ajax({
                    url:"Controller/ControllerMaterial.php",
                    type:"POST",
                    data:param
                }).done(function(response){
                    alertModal("Material Eliminado Correctamente","",SUCCESS)
                    setTimeout(function(){
                      location.reload();
                    },2000)
                })
              }
            })
        })

})
