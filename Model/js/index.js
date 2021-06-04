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
                url:"Controller/ControllerEstudiante.php",
                data:{action:"Conexion"},
         }).done(function(response){
                    console.log(response);
        })
    }
    // -------




            function hide(){
                 $('#formulario_material').hide();
            }

            //BUTTONS MODALS 
            $('#button_material').click(function(e){
                e.preventDefault();
                 $('.modal').show();
                 $('#formulario_material').show();
                // $('#formulario_apoderado').show();
            })

            $('#button_alumno').click(function(e){
                e.preventDefault();
                   $('.modal').show();
                   $('#formulario_alumno').show();
            })



            // $('#button_close_material').click(function(e){
            //   e.preventDefault();
            //   $('.modal').hide();
            // });


            $(document).on('click','#button_close_material',function(e){
                e.preventDefault();
                $('.modal').hide();
            });

            //fomrulario apoderado
            $('.btn_exit_X').click(function(e){
                e.preventDefault()
                $('.modal').hide();
            })


             mostrarApoderados();
            mostrarMateriales();
            mostrarEstudiantes();
           

            //mostrarMateriales();
            function mostrarMateriales(){
                $.ajax({
                    url:"Controller/ControllerMaterial.php",
                    data:{action:"Mostrar"},
                })
                .done(function(response){
                    // console.log(response)
                    const respuestaArray = JSON.parse(response)
                        let count=1;
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
            // ACTIVIDAD DE JOSE  *****************************
            // APODERADOS
            function mostrarApoderados(){
                  $.ajax({
                    url:"Controller/ControllerEstudiante.php",
                    data:{action:"MostrarApoderado"},
                })
                .done(function(responseApoderado){
                  console.log(responseApoderado);
                    const arrApoderados = JSON.parse(responseApoderado)
                    console.log("apoderados " + arrApoderados)
                        let count=1;
                             arrApoderados.forEach((element)=>{
                                    $('#response_table_apoderado').append(
                                        `
                                        <tr>
                                        <td>${count++}</td>
                                        <td>${element.DNI}</td>
                                         <td>${element.firstName} ${element.lastName}</td>
                                         <th>${element.state  === "NO PAGO" ? "<div class='requirement_payment'>No Pago</div>" : "<div class='sucess_payment'>Pago</div>"} </th>
                                          <td>${element.phone}</td>
                                          <td>
                                          <div style="display:flex;justify-content:space-between;">
                                             <div style="text-align:left;">
                                              <button class="btn_TblUpdate" id="editar_apoderado" name="${element.DNI}"><i class="fas fa-edit"></i></button>
                                             <button class="btn_TblPrint print_apafa" name="${element.firstName}"><i class="fas fa-print"></i></button>
                                             </div>
                                            <button class="btn_TblPagoApafa" id="pagoApafa" name="${element.firstName}"
                                            ${element.state === "PAGO" ? 'style=display:none;' : null}
                                            >Pago Apafa</button>

                                           </div>
                                          </td>
                                        </tr>
                                        `
                                        );
                                 })
                })
            }
         
            //-----------------------------------------------------
         
            $(document).on('click','#pagoApafa',function(e){
              e.preventDefault();
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
                if (result.isConfirmed) {
                  Swal.fire(
                    'Boleta Generado con Exito!',
                    '',
                    'success'
                  )
                }
              })
            })


             $(document).on('click','.print_apafa',function(e){
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

            //-.----------------------------
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
                 $('#dni').prop("disabled",true);
                // console.log(id);
                // console.log(response);
               });
               
            })


              $(document).on('click','#btn_update_apoderado',function(e){
              e.preventDefault();
              console.log("press");
               var datastring = $("#formulario_apoderado").serialize();
               const dni = $('#dni').val();
               const param={
                    nombre:   $('#nombre').val(),
                    apellido :  $('#apellido').val(),
                     telefono : $('#telefono').val(),
                    dni : $('#dni').val(),
                    action :"UpdateApoderado"
               }
               console.log(datastring);
                 $.ajax({
                  url:"Controller/ControllerEstudiante.php",
                  type:"POST",
                  data:param,
               }).done(function(response){
                  console.log("respone is " + response )
               })
               // console.log(datastring);
            })
            // btn_update_apoderado

            // END APODERADO -------------------
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

           
            function mostrarEstudiantes(){
                $.ajax({
                    url:"Controller/ControllerEstudiante.php",
                    data:{action:"MostrarEstudiante"},
                })
                .done(function(response){
                    // console.log(response)
                    const respuestaArray = JSON.parse(response)
                        let count=1;
                         // if(respuestaArray.length > 0){
                             respuestaArray.forEach((element)=>{
                                    $('#response_table_alumnos').append(
                                        `
                                        <tr>
                                        <td>${count++}</td>
                                        <td>${element.dni}</td>
                                         <td>${element.firstName}</td>
                                        <td>${element.LastName}</td>
                                          <td>${element.grado}</td>
                                          <td>${element.section}</td>
                                          <td>
                                          <div class=buttons_table>
                                              <button class="btn_TblUpdate"><i class="fas fa-edit"></i></button>
                                             <button class="btn_TblDelete" id="${element.idEstudiante}"><i class="fas fa-trash-alt"></i></button>
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

})
