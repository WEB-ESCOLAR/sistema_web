$(document).ready(function(){

    probarConexion();
	$('.bar').on('click', function(){
	  $('.contenido').toggleClass('open');
	})
	$('#inicio').on('click', function(){
		console.log("show");
	  // $('.contenido').toggleClass('open');
	})


    // FUNCION DE CONEXION A SU BASE DE DATOS (obligatorio * )
    function probarConexion(){
        $.ajax({
                url:"Controller/ControllerMaterial.php",
                data:{action:"Conexion"},
         }).done(function(response){
                    // console.log(response);
        })
    }
    // -------




            function hide(){
                 $('#formulario_material').hide();
            }
	
            $('.button_material').click(function(e){
                e.preventDefault();
                console.log("show form material")
                $('#formulario_material').show();
            })
            $('#button_close_material').click(function(e){
                e.preventDefault();
                console.log("close material");
                $('#formulario_material').hide();
            })



            mostrarMateriales();
            function mostrarMateriales(){
                $.ajax({
                    url:"Controller/ControllerMaterial.php",
                    data:{action:"Mostrar"},
                })
                .done(function(response){
                    const respuestaArray = JSON.parse(response)
                        let count=1;
                        if (respuestaArray.length) {
                            console.log("exists")
                        }else{
                            console.log("vacio")
                        }
                         // if(respuestaArray.length > 0){
                             respuestaArray.forEach((element)=>{
                                    $('#resultado_json').append(
                                        `
                                        <tr>
                                        <td>${count++}</td>
                                        <td>${element.curse}</td>
                                         <td>${element.tipoMaterial == "Libros" ? "Libros" : element.tipoMaterial+'-'+element.nameMaterial}</td>
                                        <td>${element.grade}</td>
                                         <td>requererido aca</td>
                                         <td>requererido aca</td>
                                          <td>${element.ReceptionDate}</td>
                                          <td>${element.amount}</td>
                                          <td>
                                          <div class=buttons_table>
                                              <button class="btn_TblUpdate"><i class="fas fa-eye"></i></button>
                                             <button class="btn_TblDelete" id="${element.idMaterial}"><i class="fas fa-trash-alt"></i></button>
                                           </div>
                                          </td>
                                        </tr>
                                        `
                                        );
                                 })
                         // }else{
                         //    console.log("no hay registros");
                         //    $('#table_text_message').html("<h1>No hay Registros Aun...</h1>")
                         // }
                })

            }
            $(document).on('click','.btn_TblDelete',function(e){
                var id = $(this).attr("id");
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

            // ALUMNOS


})