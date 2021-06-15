$(document).ready(function(){

    console.log("list js");
    var url = window.location.href;
    const urlSplit = url.split("/")
    // if(urlSplit[4] == "DetalleMateriales"){
    //       mostrarDetalleMaterial();
    // }else{
      // console.log(urlSplit[4])
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
                             console.log(nombreModulo);
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
                                          <button class="btn_TblUpdate" name="${element.id}" id="detalleMaterial" ><i class="fas fa-eye"></i></button>
                                          ${
                                            nombreModulo == "GestionDeMateriales" ?
                                            `<button class="btn_TblDelete" id="${element.id}"><i class="fas fa-trash-alt"></i></button>`
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
                                        <tr>
                                        <td>${count++}</td>
                                        <td>${element.DNI}</td>
                                         <td>${element.firstName} ${element.lastName}</td>
                                         <th>${element.state  === "NO PAGO" ? "<div class='inactive'>No Pago</div>" : "<div class='available'>Pago</div>"} </th>
                                          <td>${element.phone}</td>
                                          <td>
                                          <div style="display:flex;justify-content:space-between;">
                                             <div style="text-align:left;">
                                              <button class="btn-edit" id="editar_apoderado" name="${element.DNI}"><i class="fas fa-edit"></i></button>
                                             <button class="btn_TblPrint btn-print"  name="${element.firstName}"><i class="fas fa-print"></i></button>
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
                                        <button class="btn_Prestar" id="prestarLibro" name="${element.idDetalleMaterial}"><i class="">Otorgar Libro</i></button>
                                        <button class="btn_Devolver" id="mostrar_devolucion" name="${element.idDetalleMaterial}"><i class="">Devolver</i></button>
                                        <button class="btn_VerMotivo" id="mostrar_motivo" name="${element.idDevolucion}"><i class="">Ver Motivo</i></button>
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
