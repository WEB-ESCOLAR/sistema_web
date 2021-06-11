$(document).ready(function(){


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
               var id = $(this).attr("id");
               window.location="DetalleMateriales";
                $("#idDetalleMaterial").append("lorem ipsom")
               console.log("presionando boton detalle ");
             
           })
            $(document).on('click',"#checkDisponible",function(e){
                
            })

})