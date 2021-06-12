$(document).ready(function(){

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
              //var id = $(this).attr("id");
              e.preventDefault();
                $.ajax({
                        url:"Controller/ControllerMaterial.php",
                        data:{action:"DetalleMaterial"},
                 }).done(function(response){
                          window.location="DetalleMateriales";
               })
            })

////////////////EVENTO PARA AGREAGR UN DETALLE MATERIAL (CANTIDAD)///////7
            $(document).on('click','#agregar_detallematerial',function(e){
               e.preventDefault();
               var param={
                 cantidad:$('#cantidad').val(),
                 action:"AgregarDetalleCantidad"
               }
                console.log(param);
                $.ajax({
                   url:"Controller/ControllerMaterial.php",
                   type:"POST",
                   data:param
               }).done(function(response){
                   console.log("RESULTADO ESPERADO AGREGAR " + response);
                   $('#data_detalleMaterial_table').hide();
                   location.reload();

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
                   console.log("idDta" + idDta);

                       $.ajax({
                           url:"Controller/ControllerMaterial.php",
                           type:"POST",
                           data:param
                       }).done(function(response){

                       location.reload();
                       })

               })

     })
             
            $(document).on('click',"#checkDisponible",function(e){
                
            })

             // btn_TblUpdate

        //     $(document).on('click','#detalleMaterial',function(e){
	       //    e.preventDefault();
	       //    console.log("detalle material")
	       //    window.location="DetalleMateriales";
	       // })


            $(document).on('click','#idMaterial',function(e){
              e.preventDefault();
              var id = $(this).attr("name");
              // const id = $('#btn_TblUpdate').attr("name");
              // console.log("detalle material is " + id);
              window.location="DetalleMateriales/" + id;
           }) 


          function showDetalleMaterial(){
           var url = window.location.href;
          const idMaterial =url.split("/")[5];
          $('#mensaje').append(`El id del Material es ` + idMaterial)
        }


          $('#btn_back').click(function(e){
             window.history.back();
          });
   

       
})
