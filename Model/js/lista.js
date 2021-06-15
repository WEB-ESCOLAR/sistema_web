$(document).ready(function(){


    console.log("list js");
    var url = window.location.href;
    const urlSplit = url.split("/")
    const parametroDetalleMaterial={
       PRESTADO:"PRESTADO",
     DISPONIBLE:'DISPONIBLE',
     DEVUELTO:"DEVUELTO"
    }
    $('#tableFilter').hide();
    // if(urlSplit[4] == "DetalleMateriales"){
    //       mostrarDetalleMaterial();
    // }else{
      // console.log(urlSplit[4])
      console.log(urlSplit[4])
      switch(urlSplit[4]){
        case "GestionDeMateriales":
            mostrarMateriales();
            break;
        case "ControlDeMaterial":
            mostrarMateriales();
            break;
        case "Apoderados":
            mostrarApoderados();
            break;
        case "AdministrarMateriales":
             mostrarDetalleMaterial();
             break;
        case "Alumnos":
            mostrarEstudiantes();
            break;
        default:
          break;
      }
    // }

     // mostrarMateriales();
     //    mostrarApoderados();
     //    mostrarEstudiantes();


    function mostrarMateriales(){
      console.log("mostrar materiales")
                $.ajax({
                  url:"Controller/ControllerMaterial.php",
                  data:{action:"Mostrar"},
                })
                .done(function(response){
                  // console.log(response)
                    const respuestaArray = JSON.parse(response)
                    console.log("RESPONSE PHP IS " + response)
                        let count=1;
                             var url = window.location.href;
                             const nombreModulo =url.split("/")[4];
                             console.log(respuestaArray);
                             respuestaArray.forEach((element)=>{
                                    $('#data_materiales_table').append(

                                        `
                                        <tr>
                                        <td>${count++}</td>
                                        <td>${element.nombreCurso}</td>
                                         <td>${element.tipoMaterial == "Libros" ? "Libros" : element.tipoMaterial+'-'+element.nombreMaterial}</td>
                                        <td>${element.grado}</td>
                                         <td>${element.totalDisponible}</td>
                                         <td>${element.totalInactivo}</td>
                                          <td>${element.fechaRecepcion}</td>
                                          <td>${element.cantidad}</td>
                                          <td>
                                          <div class=buttons_table>
                                          <button class="btn-edit" name="${element.id}" id="detalleMaterial" ><i class="fas fa-eye"></i></button>
                                          ${
                                            nombreModulo == "GestionDeMateriales" ?
                                            `<button class="btn-delete"  name="${element.id}" id="deleteMaterial"><i class="fas fa-trash-alt"></i></button>`
                                            : ''
                                          }
                                           </div>
                                          </td>
                                        </tr>
                                        `
                                        );
                                 })
                }).fail(function(er){
                  console.log("error" + er)
                })
            }


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
                                        <tr >
                                        <td>${count++}</td>
                                        <td>${element.DNI}</td>
                                         <td>${element.firstName} ${element.lastName}</td>
                                         <th>${element.state  === "NO PAGO" ? "<div class='inactive'>No Pago</div>" : "<div class='available'>Pago</div>"} </th>
                                          <td>${element.phone}</td>
                                          <td>
                                          <div style="display:flex;justify-content:space-between;">
                                             <div style="text-align:left;">
                                              <button class="btn-edit" id="editar_apoderado" name="${element.DNI}"><i class="fas fa-edit"></i></button>
                                              ${element.state === "PAGO" ?
                                              `<button class="btn_TblPrint btn-print"  name="${element.firstName}"><i class="fas fa-print"></i></button>`: ''}
                                             </div>
                                            <button class="btn-apafa" id="${element.DNI}" name="${element.firstName}"
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

           function mostrarEstudiantes(){
                $.ajax({
                    url:"Controller/ControllerEstudiante.php",
                    data:{action:"MostrarEstudiante"},
                })
                .done(function(response){
                    const respuestaArray = JSON.parse(response)
                        let count=1;
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
                                            <button class="btn-edit" id="editar-estudiante" name="${element.idEstudiante}"><i class="fas fa-edit"></i></button>
                                            <button class="btn-delete" id="eliminarEstudiante" name="${element.idEstudiante}"><i class="fas fa-trash-alt"></i></button>
                                           </div>
                                          </td>
                                        </tr>
                                        `
                                        );
                                 })
                })
            }

            //
            $(document).on('click','#checkDisponible',async function(e){
              const listData = await detalleMaterialFilter(parametroDetalleMaterial.DISPONIBLE);
                console.log("DISPONIBLE " + listData)
                $('#tableDefault').hide();

                $('#tableFilter').show();
                mostrarDetalleMaterialHeader(parametroDetalleMaterial.DISPONIBLE)
                mostrarDetalleMaterialBody(listData,parametroDetalleMaterial.DISPONIBLE)
             });
             $(document).on('click','#checkPrestado',async function(e){
              const listData =  await detalleMaterialFilter(parametroDetalleMaterial.PRESTADO);
                console.log("prestado " + listData)
                $('#tableDefault').hide();
                $('#tableFilter').show();
                mostrarDetalleMaterialHeader(parametroDetalleMaterial.PRESTADO)
                mostrarDetalleMaterialBody(listData,parametroDetalleMaterial.PRESTADO)
             });


             $(document).on('click','#checkDevolucion', async function(e){
              const listData =await detalleMaterialFilter(parametroDetalleMaterial.DEVUELTO);
              console.log("devolucion " + listData)
              mostrarDetalleMaterialHeader(listData,parametroDetalleMaterial.DEVUELTO)
             });

           async function detalleMaterialFilter(type){
              const data = await $.ajax({
                url:"../Controller/ControllerDetalleMaterial.php",
                data:{action:"filtrarDetalleMaterial",type:type},
               })
               return data
            }
            //problema 1 : mostrar data test => disponible y prestamo diferentes encabezados ()
            //problema 2 : 

            //default : eliminar
            //checkbox disponible : accion eliminar,otorgar libro : codigoDetalle,estado
            //checkbox prestado : no hay acciones :  codigoDetalle , nombre y apellido ,grado y seccion
            //checkbox devolucion : codigoDetalle,estado

            //funcion de filtro
            function mostrarDetalleMaterialHeader(type){
                $('#tableFilter').append(
                          `
                          <table class="table-general">
                          <thead>
                              <tr>
                              ${
                                type == parametroDetalleMaterial.PRESTADO ?
                                `<th>ID</th>
                                 <th>Nombre y Apellido</th>
                                 <th>Grado</th>
                                 <th>Seccion</th>
                                 <th>Estado</th>
                                 <th>Acciones</th>
                                  `
                                 :
                                 `<th>ID</th>
                                 <th>Codigo Detalle</th>
                                 <th>Estado</th> 
                                  <th>Acciones</th>
                                 `
                                }
                              </tr>
                          </thead>
                          <tbody id="mostrarDataFilter">
                          </tbody>
                        </table>
                          `       
                  )
            }


          
            function mostrarDetalleMaterialBody(listData,type){
              const response = JSON.parse(listData)
              console.log(response)
              console.log("type is " + type)
              let count=1;
              response.forEach((element)=>{
                      $('#mostrarDataFilter').append(
                          `
                          <tr>
                          <td>${count++}</td>
                          ${type === parametroDetalleMaterial.PRESTADO ?
                            `
                            <td>${element.firstName} ${element.LastName}</td>
                            <td>${element.grado}</td>
                            <td>${element.section}</td>
                            `
                          :
                          `<td>${element.idDetalleMaterial}</td>`
                          }
                            <td>${element.status  === "OCUPADO" ? "<div class='inactive'>OCUPADO</div>" : "<div class='available'>DISPONIBLE</div>"} </td>
                            <td>
                            <div class=buttons_table>
                              ${type == parametroDetalleMaterial.DISPONIBLE ? 
                                `<button class="btn_VerMotivo" id="eliminarDetalleMaterial" name="${element.idDetalleMaterial}"><i class="">Eliminar</i></button>`
                              : `${type == parametroDetalleMaterial.DEVUELTO}`  ?
                              `<button class="btn_VerMotivo" id="mostrar_motivo" name="${element.idDevolucion}"><i class="">Ver Motivo</i></button>`
                              : ''
                              }
                            </div>
                            </td>
                          </tr>
                          `
                          );
             })
            }



            //detalle materiales defalt - revision reutilizacion codigo
            function mostrarDetalleMaterial(){
              console.log("listar detalle")
               const idMaterial =url.split("/")[5];
              $.ajax({
                url:"../Controller/ControllerMaterial.php",
                data:{action:"DetalleMaterial",id:idMaterial},
              })
              .done(function(response){
                const responseJSON = JSON.parse(response)
                console.log(responseJSON)
                        if(response == 0){
                          console.log("false")
                        }else{
                          $('#rowsEmptyMessage').hide();
                          let count=1;
                           responseJSON.forEach((element)=>{
                                  $('#data_detalleMaterial_table').append(
                                      `
                                      <tr>
                                      <td>${count++}</td>
                                      <td>${element.idDetalleMaterial}</td>
                                         <td>${element.status  === "OCUPADO" ? "<div class='inactive'>OCUPADO</div>" : "<div class='available'>DISPONIBLE</div>"} </td>
                                        <td>
                                        <div class=buttons_table>
                               
                                        <button class="btn_VerMotivo" id="eliminarDetalleMaterial" name="${element.idDetalleMaterial}"><i class="">Eliminar</i></button>

                                         </div>
                                        </td>
                                      </tr>
                                      `
                                      );
                               })
                        }
              })
            }


})
