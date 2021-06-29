$(document).ready(function(){
    let countRow=1;

    const refactorize = new Refactorize()
    const {GET} = refactorize.methodHTTP();
    const {estudianteURL,materialesURL,detalleMaterialURL,materialURL2} = refactorize.consumeUrl();
    let stateCheckBox;
    const headerTitleDisponibles=["N°","Codigo Detalle","Estado","Acciones"];
    const headerTitlePrestados=["N°","Codigo Pecosa","Nombre y Apellido","Grado","Seccion","Estado","Acciones"]

     
    console.log(refactorize.showDataForModule())

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
          console.log("raa")
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


    //refactorize 
    $('#search_Curse').click(function(e){
            e.preventDefault();
            if($('#search_name_curse').val() != "null"){
              $('#data_materiales_table').empty()
               mostrarMateriales(curse)
            }else{
               alertWarning('Seleccionar Curso');
            }
      
          });  
    //refactorize

  
    $('#refresh_Curse').click(function(e){
            e.preventDefault();
            $('#data_materiales_table').empty()
            mostrarMateriales(null)
            $("#search_name_curse").val("null")
    });


    //REVISION DE CODIGO
    async function mostrarMateriales(curse){
                const parametro ={
                  curse,action:"Mostrar"
                }
                const response = await refactorize.getDataController(materialesURL,GET,parametro)
                console.log(response)
                response.forEach((element)=>{
                            $('#data_materiales_table').append(
                                `
                                <tr>
                                <td>${countRow++}</td>
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
                                  <button class="btn-delete"  name="${element.id}" id="deleteMaterial"><i class="fas fa-trash-alt"></i></button>
                                   </div>
                                  </td>
                                </tr>
                                `
                                );
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

                    
          async function mostrarApoderados(){
                const param={action:"MostrarApoderado"}
                const response = await refactorize.getDataController(estudianteURL,GET,param)
                     response.forEach((element)=>{
                            $('#response_table_apoderado').append(
                                `
                                <tr >
                                <td>${countRow++}</td>
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
          }
                
                
       async function mostrarTotalEstudiantes(grade,section){
          const parametro ={
            grade,section,action:"totalGradeAndSection"
          }
          const response = await refactorize.getDataController(estudianteURL,GET,parametro)
          $('#totalStudentsforGradeandSection').text(response > 0 ? response : 0);
        }



          $('#search_student').click(function(e){
            e.preventDefault();
              const grade = $('#search_grade_student').val();
               const  section = $('#search_section_student').val();
            if(grade != "null" && section != "null"){
              $('#response_table_alumnos').empty()
              mostrarEstudiantes(grade,section)
              mostrarTotalEstudiantes(grade,section)
            }else{
              alertWarning("Seeccionar Grado y Seccion")
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


           async function mostrarEstudiantes(grade,section){
             const parametro ={
               grade,section,action:"MostrarEstudiante"
             }
             const response = await refactorize.getDataController(estudianteURL,GET,parametro)
             response.forEach((element)=>{
              $('#response_table_alumnos').append(
                  `
                  <tr>
                  <td>${countRow++}</td>
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
               
            }
            function useCheckBoxList(defaultTableHide,tableFilterHide,color){
              defaultTableHide ? $('#tableDefault').show() : $('#tableDefault').hide();
              tableFilterHide ?  $('#tableFilter').show() : $('#tableFilter').hide();
              $('#btn-document').css("background",color);
            }
            function pressCheckBox(type){
              const idMaterial = url.split("/")[5];
               return{
                  action:"filtrarDetalleMaterial",
                  idMaterial:idMaterial,
                  type
               }
             }
             function tableFilterShow(listData,type){
              stateCheckBox=type
              mostrarDetalleMaterialHeader(type)
              mostrarDetalleMaterialBody(listData,type)
             }

             // prueba
            $(document).on('click','#checkDisponible',async function(e){
              if( $( this ).is( ':checked' ) ){
              const listData = await refactorize.getDataController(detalleMaterialURL,GET,pressCheckBox(parametroDetalleMaterial.DISPONIBLE));
              $('#btn-document').prop("disabled",true);
              useCheckBoxList(false,true,"rgba(120, 0, 0, 0.5)") 
              tableFilterShow(listData,parametroDetalleMaterial.DISPONIBLE)
            }
                else{
                  useCheckBoxList(true,false,"rgba(120, 0, 0, 0.5)")
                }
             });
                
                
             $(document).on('click','#checkPrestado',async function(e){
              if( $( this ).is( ':checked' ) ){
                const p = pressCheckBox(parametroDetalleMaterial.PRESTADO)
                console.log(p)
              const listData =  await refactorize.getDataController(detalleMaterialURL,GET,pressCheckBox(parametroDetalleMaterial.PRESTADO));
              $('#btn-document').prop("disabled",false);
              useCheckBoxList(false,true,"#C1121F")
              tableFilterShow(listData,parametroDetalleMaterial.PRESTADO)
               }else{
                  useCheckBoxList(true,false,"rgba(120, 0, 0, 0.5)")
                }
             });
                
              $(document).on('click','#checkDevolucion', async function(e){
              if( $( this ).is( ':checked' ) ){
              const listData =await refactorize.getDataController(detalleMaterialURL,GET,pressCheckBox(parametroDetalleMaterial.DEVUELTO));
              $('#btn-document').prop("disabled",false);
              useCheckBoxList(false,true,"#C1121F")
              tableFilterShow(listData,parametroDetalleMaterial.DEVUELTO)
              }else{
                useCheckBoxList(true,false,"rgba(120, 0, 0, 0.5)")
              }
             });

             $(document).on('click','#checkDanados', async function(e){
                if( $( this ).is( ':checked' ) ){
              const listData = await refactorize.getDataController(detalleMaterialURL,GET,pressCheckBox(parametroDetalleMaterial.DANADO));
              $('#btn-document').prop("disabled",false);
              useCheckBoxList(false,true,"#C1121F")
              tableFilterShow(listData,parametroDetalleMaterial.DEVUELTO)
              }else{
                useCheckBoxList(true,false,"rgba(120, 0, 0, 0.5)")
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
            function mostrarDetalleMaterialBody(listData,type){
              let count=1;
              listData.forEach((element)=>{
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

            async function mostrarDetalleMaterial(){
              const idMaterial = url.split("/")[5];
              const parametro={ id:idMaterial,action:"DetalleMaterial"}
              const listData =await refactorize.getDataController(materialURL2,GET,parametro);
              listData.forEach((element)=>{
                $('#data_detalleMaterial_table').append(
                    `
                    <tr>
                    <td>${countRow++}</td>
                    <td>${element.codigo}</td>
                       <td>${element.status  === "OCUPADO" ? "<div class='inactive'>OCUPADO</div>" : "<div class='available'>DISPONIBLE</div>"} </td>
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
