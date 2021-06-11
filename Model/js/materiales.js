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