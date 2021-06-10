$(document).ready(function(){

    mostrarApoderados();
    mostrarMateriales();
    mostrarEstudiantes();
    mostrarDetalleMaterial();

    function mostrarMateriales(){
                $.ajax({
                  url:"Controller/ControllerMaterial.php",
                  data:{action:"Mostrar"},
                })
                .done(function(response){
                    const respuestaArray = JSON.parse(response)
                        let count=1;
                             var url = window.location.href;
                             const nombreModulo =url.split("/")[4];
                             console.log(nombreModulo);
                             respuestaArray.forEach((element)=>{
                                    $('#data_materiales_table').append(

                                        `
                                        <tr>
                                        <td>${count++}</td>
                                        <td>${element.curse}</td>
                                         <td>${element.tipoMaterial == "Libros" ? "Libros" : element.tipoMaterial+'-'+element.nameMaterial}</td>
                                        <td>${element.grade}</td>
                                         <td>requerido aca</td>
                                         <td>requererido aca</td>
                                          <td>${element.ReceptionDate}</td>
                                          <td>${element.amount}</td>
                                          <td>
                                          <div class=buttons_table>
                                          <button class="btn_TblUpdate" name="${element.idMaterial}" id="detalleMaterial" ><i class="fas fa-eye"></i></button>
                                          ${
                                            nombreModulo == "Materiales" ?
                                            `<button class="btn_TblDelete" id="${element.idMaterial}"><i class="fas fa-trash-alt"></i></button>`
                                            : ''
                                          }
                                           </div>
                                          </td>
                                        </tr>
                                        `
                                        );
                                 })
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
                                         <th>${element.state  === "NO PAGO" ? "<div class='requirement_payment'>No Pago</div>" : "<div class='sucess_payment'>Pago</div>"} </th>
                                          <td>${element.phone}</td>
                                          <td>
                                          <div style="display:flex;justify-content:space-between;">
                                             <div style="text-align:left;">
                                              <button class="btn_TblUpdate" id="editar_apoderado" name="${element.DNI}"><i class="fas fa-edit"></i></button>
                                             <button class="btn_TblPrint print_apafa" name="${element.firstName}"><i class="fas fa-print"></i></button>
                                             </div>
                                            <button class="btn_TblPagoApafa" id="${element.DNI}" name="${element.firstName}"
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
                                            <button class="btn_TblUpdate"><i class="fas fa-edit"></i></button>
                                            <button class="btn_TblDeleteEs" id="${element.idEstudiante}"><i class="fas fa-trash-alt"></i></button>
                                           </div>
                                          </td>
                                        </tr>
                                        `
                                        );
                                 })
                })
            }

            function mostrarDetalleMaterial(){
              $.ajax({
                url:"Controller/ControllerMaterial.php",
                data:{action:"DetalleMaterial"},
              })
              .done(function(response){
                  //const respuestaArray = JSON.parse(response)
                  const respuestaArray =[
                    {idDetalleMaterial:1,idMaterial:10, status:"DISPONIBLE", idDevolucion:1},
                    {idDetalleMaterial:2,idMaterial:10, status:"DISPONIBLE", idDevolucion:2},
                    {idDetalleMaterial:3,idMaterial:10, status:"DISPONIBLE", idDevolucion:3},
                    {idDetalleMaterial:4,idMaterial:10, status:"DISPONIBLE", idDevolucion:4}
                  ]
                      let count=1;
                           respuestaArray.forEach((element)=>{
                                  $('#data_detalleMaterial_table').append(
                                      `
                                      <tr>
                                      <td>${count++}</td>
                                      <td>${element.idMaterial}</td>
                                      <td>${element.status}</td>
                                        <td>
                                        <div class=buttons_table>
                                        <button class="btn_Prestar" id="mostrar_alumno" name="${element.idDetalleMaterial}"><i class="">Prestar</i></button>
                                        <button class="btn_Devolver" id="mostrar_devolucion" name="${element.idDetalleMaterial}"><i class="">Devolver</i></button>
                                        <button class="btn_VerMotivo" id="mostrar_motivo" name="${element.idDevolucion}"><i class="">Ver Motivo</i></button>
                                         </div>
                                        </td>
                                      </tr>
                                      `
                                      );
                               })
              })
            }
})
