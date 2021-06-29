$(document).ready(function(){


    console.log("list js");
    var url = window.location.href;
    const urlSplit = url.split("/")
    let stateCheckBox;
    const parametroDetalleMaterial={
       PRESTADO:"PRESTADO",
     DISPONIBLE:'DISPONIBLE',
     DEVUELTO:"DEVUELTO",
     DANADO:"DANADO"
    }
    $('#tableFilter').hide();
      switch(urlSplit[4]){
        case "GestionDeMateriales":
            mostrarMateriales(null);
            mostrarCurso();
            break;
        // case "ControlDeMaterial":
        //     mostrarMateriales(null);
        //     break;
        case "Apoderados":
            mostrarApoderados();
            break;
        case "AdministrarMateriales":
             mostrarDetalleMaterial();
             break;
        case "Alumnos":
            mostrarEstudiantes(null,null);
            break;
        default:
          break;
      }

    $('#search_Curse').click(function(e){
            e.preventDefault();
              const curse = $('#search_name_curse').val();
            if(curse != "null"){
              $('#data_materiales_table').empty()
              mostrarMateriales(curse)
            }else{
              Swal.fire({
                title: 'Seleccionar Curso',
                icon: 'warning',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'atras'
              })
            }
          });

    $('#refresh_Curse').click(function(e){
            e.preventDefault();
            $('#data_materiales_table').empty()
            mostrarMateriales(null)
            $("#search_name_curse").val("null")
    });

    function mostrarMateriales(curse){
      console.log("ListMateriales"+curse)
                const parametro ={
                curse:curse,
                action:"Mostrar"

                }
                $.ajax({
                  url:"Controller/ControllerMaterial.php",
                  data:parametro
                })
                .done(function(response){
                  console.log(response)
                    const respuestaArray = JSON.parse(response)
                        let count=1;
                             var url = window.location.href;
                             const nombreModulo =url.split("/")[4];
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
            function mostrarCurso(){
              $.ajax({
                url:"Controller/ControllerMaterial.php",
                data:{action:"loadCurse"},
              })
              .done(function(response){
                  const respuestaArray = JSON.parse(response)
                 respuestaArray.forEach((element)=>{
                   $('#search_name_curse').append(
                      `
              <option value="${element.idCurso}">${element.descripcion}</option>
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
                    const arrApoderados = JSON.parse(responseApoderado)
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
                                              `<button class="btn_TblPrint btn-print" id="${element.DNI}" name="${element.firstName}"><i class="fas fa-print"></i></button>`: ''}
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

          function mostrarTotalEstudiantes(grado,seccion){
          const parametro ={
            grade:grado,
            section:seccion,
            action:"MostrarTotalEstudiantesPorGradoYSeccion"
          }
          $.ajax({
            url:"Controller/ControllerEstudiante.php",
            dataType: 'json',
            data: parametro
          }).done(function(response){
              $('#totalStudentsforGradeandSection').text(response);
          })
        }

          $('#search_student').click(function(e){
            e.preventDefault();
            // const param={
              const grade = $('#search_grade_student').val();
               const  section = $('#search_section_student').val();
            if(grade != "null" && section != "null"){
              $('#response_table_alumnos').empty()
              mostrarEstudiantes(grade,section)
              mostrarTotalEstudiantes(grade,section)
            }else{
              Swal.fire({
                title: 'Seleccionar Grado y Seccion',
                icon: 'warning',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'confirmar'
              })
                // console.log("seleccionar grado  y seccion") //aqui alerta jair
            }
          });

          $('#refresh_student').click(function(e){
            e.preventDefault();
            $('#response_table_alumnos').empty()
            mostrarEstudiantes(null,null)
            $('#totalStudentsforGradeandSection').empty();
            $("#search_section_student").val("null")
            $('#search_grade_student').val("null")
          });

           function mostrarEstudiantes(grado,seccion){
             const parametro ={
               grade:grado,
               section:seccion,
               action:"MostrarEstudiante"
             }
                $.ajax({
                    url:"Controller/ControllerEstudiante.php",
                    data:parametro
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
                                            <button class="btn-edit" id="mostrarApoderado" name="${element.idApoderado}"><i class="fas fa-eye"></i></button>
                                           </div>
                                          </td>
                                        </tr>
                                        `
                                        );
                                 })
                })
            }
             // prueba
            $(document).on('click','#checkDisponible',async function(e){
                let val = $(this).val();
                  if( $( this ).is( ':checked' ) ){
              const listData = await detalleMaterialFilter("filtrarDetalleMaterial",parametroDetalleMaterial.DISPONIBLE);
                $('#tableDefault').hide();
                $('#tableFilter').show();
                $('#btn-document').prop("disabled",true);
                $('#btn-document').css("background","rgba(120, 0, 0, 0.5)");
                mostrarDetalleMaterialHeader(parametroDetalleMaterial.DISPONIBLE)
                mostrarDetalleMaterialBody(listData,parametroDetalleMaterial.DISPONIBLE)
            }
                else{
                  $('#tableDefault').show();
                  $('#tableFilter').hide();
                  $('#btn-document').prop("disabled",true);
                }
             });

             $(document).on('click','#checkPrestado',async function(e){
              let val = $(this).val();
              stateCheckBox=parametroDetalleMaterial.PRESTADO
              if( $( this ).is( ':checked' ) ){
              const listData =  await detalleMaterialFilter("filtrarDetalleMaterial",parametroDetalleMaterial.PRESTADO);

                $('#tableDefault').hide();
                $('#tableFilter').show();
                $('#btn-document').prop("disabled",false);
                $('#btn-document').css("background","#C1121F");
                mostrarDetalleMaterialHeader(parametroDetalleMaterial.PRESTADO)
                mostrarDetalleMaterialBody(listData,parametroDetalleMaterial.PRESTADO)}
                else{
                  $('#tableDefault').show();
                  $('#tableFilter').hide();
                  $('#btn-document').prop("disabled",true);
                  $('#btn-document').css("background","rgba(120, 0, 0, 0.5)");
                }
             });


             $(document).on('click','#checkDevolucion', async function(e){
              let val = $(this).val();
              stateCheckBox=parametroDetalleMaterial.DEVUELTO
              if( $( this ).is( ':checked' ) ){
              const listData =await detalleMaterialFilter("filtrarDetalleMaterial",parametroDetalleMaterial.DEVUELTO);

              $('#tableDefault').hide();
              $('#tableFilter').show();
              $('#btn-document').prop("disabled",false);
              $('#btn-document').css("background","#C1121F");
              mostrarDetalleMaterialHeader(parametroDetalleMaterial.DEVUELTO)
              mostrarDetalleMaterialBody(listData,parametroDetalleMaterial.DEVUELTO)
              }else{
                $('#tableDefault').show();
                $('#tableFilter').hide();
                $('#btn-document').prop("disabled",true);
                $('#btn-document').css("background","rgba(120, 0, 0, 0.5)");
              }
             });

             $(document).on('click','#checkDanados', async function(e){
              let val = $(this).val();
              stateCheckBox=parametroDetalleMaterial.DANADO
              if( $( this ).is( ':checked' ) ){
              const listData =await detalleMaterialFilter("filtrarDetalleMaterial",parametroDetalleMaterial.DANADO);

              $('#tableDefault').hide();
              $('#tableFilter').show();
              $('#btn-document').prop("disabled",false);
              $('#btn-document').css("background","#C1121F");
              mostrarDetalleMaterialHeader(parametroDetalleMaterial.DANADO)
              mostrarDetalleMaterialBody(listData,parametroDetalleMaterial.DANADO)
              }else{
                $('#tableDefault').show();
                $('#tableFilter').hide();
                $('#btn-document').prop("disabled",true);
                $('#btn-document').css("background","rgba(120, 0, 0, 0.5)");
              }
             });


             $(document).on('click','#btn-document',async function(e){
              console.log("generar pdf" + stateCheckBox);
              var url = window.location.href;
              const idMaterial = url.split("/")[5];
              console.log(idMaterial);
              if (stateCheckBox == 'DANADO') {
                window.location="../util/reporteDañados.php?idMaterial="+idMaterial;
              }
            })


           async function detalleMaterialFilter(action,type){
              const idMaterial = url.split("/")[5];
              const data = await $.ajax({
                url:"../Controller/ControllerDetalleMaterial.php",
                data:{action:action,type:type, idMaterial:idMaterial},
               })
               return data
            }
            //problema 1 : mostrar data test => disponible y prestamo diferentes encabezados ()
            //problema 2 :

            //default : eliminar
            //checkbox disponible : accion eliminar,otorgar libro : codigoDetalle,estado
            //checkbox prestado : no hay acciones :  codigoDetalle , nombre y apellido ,grado y seccion
            //checkbox devolucion : idDevolucion,nombre y apellido,grado,seccion,codigoDetalle,fechahora de material devuelto y accion ver motivo

            //funcion de filtro
            function headerShow(type){
              let header
              switch(type){
                case parametroDetalleMaterial.DISPONIBLE:
                  header=`
                  <th>ID</th>
                  <th>Codigo Detalle</th>
                  <th>Estado</th>
                  <th>Acciones</th>
                  `
                  break;
                case parametroDetalleMaterial.PRESTADO:
                  header=`
                  <th>N°</th>
                  <th>Codigo Pecosa</th>
                  <th>Nombre y Apellido</th>
                  <th>Grado</th>
                  <th>Seccion</th>
                  <th>Estado</th>
                  <th>Acciones</th>
                  `
                  break;
                case parametroDetalleMaterial.DEVUELTO:
                 header= `
                  <th>ID</th>
                <th>Nombre y Apellido</th>
               <th>Grado</th>
               <th>Seccion</th>
               <th>Fecha Hora de Devolucion</th>
                <th>Acciones</th>
               `
               break;
               case parametroDetalleMaterial.DANADO:
                header= `
                 <th>N°</th>
               <th>Codigo de Libro</th>
              <th>Descripción</th>
               <th>Accion</th>
              `
              break;
               default:
               break;

              }
              return header;

            }
            function mostrarDetalleMaterialHeader(type){
              $('#tableFilter').html(
                        `
                        <table class="table-general">
                        <thead id="">
                            ${headerShow(type)}
                        </thead>
                        <tbody id="mostrarDataFilter">
                        </tbody>
                      </table>
                        `
                )
          }



            function mostrarDetalleMaterialBody(listData,type){
              const response = JSON.parse(listData)
              let count=1;
              response.forEach((element)=>{
                      $('#mostrarDataFilter').append(
                          `
                          <tr>
                          <td>${count++}</td>
                          ${bodyShow(element,type)}
                          </tr>
                          `
                          );
             })
            }
              function bodyShow(element,type){
                let body
                switch(type){
                  case parametroDetalleMaterial.DISPONIBLE:
                    body=`
                    <td>${element.codigo}</td>
                    <td>${element.status  === "OCUPADO" ? "<div class='inactive'>OCUPADO</div>" :
                    (element.status  === "DISPONIBLE" ? "<div class='available'>DISPONIBLE</div>" : "<div class='damage'>INACTIVO</div>")} </td>
                   <td><div class=buttons_table>
                    <button class="btn-delete" id="eliminarDetalleMaterial" name="${element.idDetalleMaterial}"><i class="fas fa-trash-alt"></i></button>
                    <button class="btn_OtorgarLibro" id="prestarLibro" name="${element.idDetalleMaterial}"style="background: var(--teal-light)"><i class="">Otorgar Libro</i></button>
                    </div>  </td>

                    `
                    break;
                  case parametroDetalleMaterial.PRESTADO:
                    body=`
                    <td>${element.codePecosa}</td>
                    <td>${element.firstName} ${element.LastName}</td>
                    <td>${element.grado}</td>
                    <td>${element.section}</td>
                    <td>${element.status  === "OCUPADO" ? "<div class='inactive'>OCUPADO</div>" : "<div class='available'>DISPONIBLE</div>"} </td>
                   <td>
                    <button class="btn_Devolucion" id="mostrar_devolucion" value="${element.idPrestamoDevolucion}" name="${element.idDetalleMaterial}"style="background: var(--crimson);"><i class="">Devolver</i></button>
                  </td>

                    `
                    break;
                  case parametroDetalleMaterial.DEVUELTO:
                   body= `
                 <td>${element.firstName} ${element.LastName}</td>
                 <td>${element.grado}</td>
                 <td>${element.section}</td>
                 <td>${element.fechaHoraDevolucion}</td>
                 <td>
                 <button class="btn_OtorgarLibro" id="mostrar_motivo" name="${element.idPrestamoDevolucion}"style="background: var(--crimson);"><i class="">Ver Motivo</i></button>
                 </td>

                 `
                 break;
                 case parametroDetalleMaterial.DANADO:
                  body= `
                <td>${element.codigo}</td>
                <td>${element.motivo}</td>
                <td>
                <button class="btn-delete" id="eliminarDetalleMaterial" name="${element.idDetalleMaterial}"><i class="fas fa-trash-alt"></i></button>
                </td>

                `
                break;
                 default:
                 break;

                }
                 return body;

              }


            //detalle materiales defalt - revision reutilizacion codigo
            function mostrarDetalleMaterial(){
               const idMaterial =url.split("/")[5];
              $.ajax({
                url:"../Controller/ControllerMaterial.php",
                data:{action:"DetalleMaterial",id:idMaterial},
              })
              .done(function(response){
                const responseJSON = JSON.parse(response)
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
                                      <td>${element.codigo}</td>
                                      <td>${element.status  === "OCUPADO" ? "<div class='inactive'>OCUPADO</div>" :
                                      (element.status  === "DISPONIBLE" ? "<div class='available'>DISPONIBLE</div>" : "<div class='damage'>INACTIVO</div>")} </td>
                                        <td>
                                        <div class=buttons_table>

                                        <button class="btn-delete" id="eliminarDetalleMaterial" name="${element.idDetalleMaterial}"><i class="fas fa-trash-alt"></i></button>

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
