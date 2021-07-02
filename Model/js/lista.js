$(document).ready(function(){
    let countRow=1;

    const refactorize = new Refactorize()
    const {GET,POST} = refactorize.methodHTTP();
    const {estudianteURL,materialesURL,detalleMaterialURL,materialURL2,apoderadoURL} = refactorize.consumeUrl();
    let stateCheckBox;
    const headerTitleDisponibles=["N°","Codigo Detalle","Estado","Acciones"];
    const headerTitlePrestados=["N°","Codigo Pecosa","Nombre y Apellido","Grado","Seccion","Estado","Acciones"]
    console.log(refactorize.showDataForModule())

    var url = window.location.href;
    const urlSplit = url.split("/")
    const parametroDetalleMaterial={
     DEFAULT:"DEFAULT",
     PRESTADO:"PRESTADO",
     DISPONIBLE:'DISPONIBLE',
     DEVUELTO:"DEVUELTO",
     DANADO:"DANADO"
    }

    // $('#tableFilter').hide();

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
              const curse = $('#search_name_curse').val()
              $('#data_materiales_table').DataTable().destroy();
               mostrarMateriales(curse)
            }else{
               alertWarning('Seleccionar Curso');
            }
      
          });  
    //refactorize

  
    $('#refresh_Curse').click(function(e){
            e.preventDefault();
            $('#data_materiales_table').DataTable().destroy();
            mostrarMateriales(null)
            // $('#data_materiales_table').empty();
            $("#search_name_curse").val("null")
    });


    //REVISION DE CODIGO
             async function mostrarMateriales(curse){
                const parametro ={
                  curse:curse,
                  action:"Mostrar"
                }
                const response = await refactorize.getDataController(materialesURL,GET,parametro);
                tableMaterial=$('#data_materiales_table').DataTable({
                  "language":refactorize.convertDatatableSpanish(),
                  processing: true,
                  lengthMenu: [10,20,30],
                  data:response,
                  columns:[
                    {data:"nombreCurso"},
                    {data:"tipoMaterial"},
                    {data:"grado"},
                    {data:"totalDisponible"},
                    {data:"totalInactivo"},
                    {data:"fechaRecepcion"},
                    {data:"cantidad"},
                    {"render":function(data,type,full,meta){
                      var id=full.id
                      return '<button class="btn-edit" name="'+id+'" id="detalleMaterial" ><i class="fas fa-eye"></i></button>'+' '+
                      '<button class="btn-delete"  name="'+id+'" id="deleteMaterial"><i class="fas fa-trash-alt"></i></button>'
                    }},
                    ],
                  
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

          

                    
          async function mostrarApoderados(){
                const param={action:"MostrarApoderado"}
                const response = await refactorize.getDataController(estudianteURL,GET,param);
                tableApoderado= $('#response_table_apoderado').DataTable({
                  "language":refactorize.convertDatatableSpanish(),
                  processing:true,
                  lengthMenu:[7,10,20,50],
                  data:response,
                  columns:[
                    {data:"DNI"},
                    { data: null, render: function ( data, type, row ) {
                      return data.firstName+' '+data.lastName;}},
                    {"render":function(data,type,full,meta){
                      var state=full.state
                      if(state==="NO PAGO"){
                        return '<td><div class="inactive">No Pago</div></td>'
                      }
                      else{
                        return '<td><div class="available">Pago</div></td>'
                      }
                    }},
                    {data:"phone"},
                    {
                      "render":function(data,type,full,meta){
                        var DNI=full.DNI
                        var firstName=full.firstName
                        var state=full.state
                        if(state==="PAGO"){
                          return '<button class="btn-edit" id="editar_apoderado" name="'+DNI+'"><i class="fas fa-edit"></i></button>'+' '+ 
                          '<button class="btn_TblPrint btn-print" id="'+DNI+'"  name="'+firstName+'"><i class="fas fa-print"></i></button>'
                        }else{
                          return '<button class="btn-edit" id="editar_apoderado" name="'+DNI+'"><i class="fas fa-edit"></i></button>'+' '+ 
                          '<button class="btn-apafa" id="'+DNI+'" name="'+firstName+'">Pago Apafa</button>'
                        }

                      }
                    }
                  ],
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
              // $('#response_table_alumnos').empty()
              $('#response_table_alumnos').DataTable().destroy();
              mostrarEstudiantes(grade,section)
              mostrarTotalEstudiantes(grade,section)
            }else{
              alertWarning("Seeccionar Grado y Seccion")
            }
          });


          $('#refresh_student').click(function(e){
            e.preventDefault();
            // $('#response_table_alumnos').empty()
            $('#response_table_alumnos').DataTable().destroy();
            mostrarEstudiantes(null,null)
            // $('#response_table_alumnos').DataTable().ajax.reload();
            // mostrarEstudiantes(null,null)
            $('#totalStudentsforGradeandSection').empty();
            $("#search_section_student").val("null")
            $('#search_grade_student').val("null")


          });


         async function mostrarEstudiantes(grado,seccion){
            const parametro ={
              grade:grado,
              section:seccion,
              action:"MostrarEstudiante"
            }
              const alumnos = await refactorize.getDataController(estudianteURL,GET,parametro);
                       tableEstudiante =  $('#response_table_alumnos').DataTable({
                        "language":refactorize.convertDatatableSpanish(),
                        processing: true,
                               lengthMenu: [7, 10, 20, 50, 100, 200, 500],
                              data:alumnos,
                               columns:[
                                 { data: "dni" },
                                 { data: "firstName" },
                                 { data: "LastName" },
                                 { data: "grado" },
                                 { data: "section" },
                                 { 
                                   "render":function(data,type,full,meta){
                                     var idEstudiante=full.idEstudiante
                                     var idApoderado=full.idApoderado
                                    return '<button class="btn-edit" id="editar-estudiante" name="'+idEstudiante+'"><i class="fas fa-edit"></i></button>'+" "+
                                    '<button class="btn-delete" id="eliminarEstudiante" name="'+idEstudiante+'"><i class="fas fa-trash-alt"></i></button>'+" "+
                                    '<button class="btn-edit" id="mostrarApoderado" name="'+idApoderado+'"><i class="fas fa-eye"></i></button>' 
                                     }
                               },
                               ],
                       })
           }


            function detalleMaterialAction(type){
              const idMaterial = url.split("/")[5];
               return{
                  action:"filtrarDetalleMaterial",
                  idMaterial:idMaterial,
                  type
               }
             }
            //  filtrarDetalleMaterial
             
             function tableFilterShow(listData,type){
              stateCheckBox=type
              mostrarDetalleMaterialHeader(type)
              mostrarDetalleMaterialBody(listData,type)
             }

             // prueba
            $(document).on('click','#checkDisponible',async function(e){
              if( $( this ).is( ':checked' ) ){
              const listData = await refactorize.getDataController(
                detalleMaterialURL,GET,
                detalleMaterialAction(parametroDetalleMaterial.DISPONIBLE));
              $('#btn-document').prop("disabled",true);
              $('#btn-document').css("background","rgba(120, 0, 0, 0.5)");
              // useCheckBoxList(false,true,"rgba(120, 0, 0, 0.5)") 
              tableFilterShow(listData,parametroDetalleMaterial.DISPONIBLE)
            }
                else{
                  mostrarDetalleMaterial();
                  $('#btn-document').css("background","rgba(120, 0, 0, 0.5)");
                  // useCheckBoxList(true,false,"rgba(120, 0, 0, 0.5)")
                }
             });
                
                
             $(document).on('click','#checkPrestado',async function(e){
              if( $( this ).is( ':checked' ) ){
  
              const listData =  await refactorize.getDataController(
                detalleMaterialURL,GET,
                detalleMaterialAction(parametroDetalleMaterial.PRESTADO));
              $('#btn-document').prop("disabled",false);
              $('#btn-document').css("background","#C1121F");
              tableFilterShow(listData,parametroDetalleMaterial.PRESTADO)
               }else{
                mostrarDetalleMaterial();
                  // useCheckBoxList(true,false,"rgba(120, 0, 0, 0.5)")
                  $('#btn-document').css("background","rgba(120, 0, 0, 0.5)");
                }
             });
                
              $(document).on('click','#checkDevolucion', async function(e){
              if( $( this ).is( ':checked' ) ){
              const listData =await refactorize.getDataController(
                detalleMaterialURL,GET,
                detalleMaterialAction(parametroDetalleMaterial.DEVUELTO));
              $('#btn-document').prop("disabled",false);
              $('#btn-document').css("background","#C1121F");
              // useCheckBoxList(false,true,"#C1121F")
              tableFilterShow(listData,parametroDetalleMaterial.DEVUELTO)
              }else{
                mostrarDetalleMaterial();
                $('#btn-document').css("background","rgba(120, 0, 0, 0.5)");
                // useCheckBoxList(true,false,"rgba(120, 0, 0, 0.5)")
              }
             });

             $(document).on('click','#checkDanados', async function(e){
               console.log("dañado")
                if( $( this ).is( ':checked' ) ){
              const listData = await refactorize.getDataController(
                detalleMaterialURL,GET,
                detalleMaterialAction(parametroDetalleMaterial.DANADO));
              $('#btn-document').prop("disabled",false);
              $('#btn-document').css("background","#C1121F");
              // useCheckBoxList(false,true,"#C1121F")
              tableFilterShow(listData,parametroDetalleMaterial.DANADO)
              }else{
                mostrarDetalleMaterial();
                $('#btn-document').css("background","rgba(120, 0, 0, 0.5)");
                // useCheckBoxList(true,false,"rgba(120, 0, 0, 0.5)")
              }
             });


             $(document).on('click','#btn-document',async function(e){
              console.log("generar pdf" + stateCheckBox);
              var url = window.location.href;
              const idMaterial = url.split("/")[5];
              console.log(idMaterial);
              if (stateCheckBox == 'PRESTADO') {
                window.location="../util/reportePrestados.php?idMaterial="+idMaterial;
              }else if(stateCheckBox == 'DEVUELTO') {
                window.location="../util/reportDevueltos.php?idMaterial="+idMaterial;
              }else if(stateCheckBox == 'DANADO') {
                window.location="../util/reporteDañados.php?idMaterial="+idMaterial;
              }
            })

            function mostrarDetalleMaterialHeader(type){
              $('#tableFilter').html(
                        `
                        <table class="table-general" id="detalleMaterialTable">
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
                case parametroDetalleMaterial.DEFAULT:
                  header=`
                    <th>Codigo</th>
                    <th>Estado</th>
									  <th>ACCIONES</th>
                  `
                break;
                case parametroDetalleMaterial.DISPONIBLE:
                  header=`
                   <th>Codigo Detalle</th>
                  <th>Estado</th>
                  <th>Acciones</th>
                  `
                  break;
                case parametroDetalleMaterial.PRESTADO:
                  header=`
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
                <th>Nombre y Apellido</th>
               <th>Grado</th>
               <th>Seccion</th>
               <th>Fecha Hora de Devolucion</th>
                <th>Acciones</th>
               `
               break;
               case parametroDetalleMaterial.DANADO:
                header= `
               <th>Codigo de Libro</th>
              <th>Descripción</th>
              <th>Fecha Hora Devolucion</th>
               <th>Accion</th>
              `
              break;
               default:
               break;
              }
              return header;

            }
            function mostrarDetalleMaterialBody(listData,type){
              // let count=1;
             $('#detalleMaterialTable').DataTable({
              "language":refactorize.convertDatatableSpanish(),
                processing: true,
                lengthMenu: [7, 10, 20, 50, 100, 200, 500],
                data:listData,
                columns:bodyShow(type)
              })
            }
              function bodyShow(type){
                let body
                switch(type){
                  case parametroDetalleMaterial.DEFAULT:
                    body=[
                        { data: "codigo" },
                      { "render":function(data,type,full,meta){
                        var status=full.status
                        if(status==="OCUPADO"){
                          return '<td><div class="inactive">OCUPADO</div></td>'
                        }else if(status=="DISPONIBLE"){
                          return '<td><div class="available">DISPONIBLE</div></td>'
                        }else{
                          return '<td><div class="damage">INACTIVO</div></td>'
                        }
                      } },
                      {"render":function(data,type,full,meta){
                        var idDetalleMaterial=full.idDetalleMaterial
                        return '<button class="btn-delete" id="eliminarDetalleMaterial" name="'+idDetalleMaterial+'"><i class="fas fa-trash-alt"></i></button>'
                        } }
                    ]
                    break;
                  case parametroDetalleMaterial.DISPONIBLE:
                    body=[
                      {data:"codigo"},
                      {"render":function(data,type,full,meta){
                        var status=full.status
                        if(status==="OCUPADO"){
                          return '<td><div class="inactive">OCUPADO</div></td>'
                        }else if(status==="DISPONIBLE"){
                          return '<td><div class="available">DISPONIBLE</div></td>'
                        }else{
                          return '<td><div class="damage">INACTIVO</div></td>'
                        }
                      }},
                      {"render":function(data,type,full,meta){
                        var idDetalleMaterial=full.idDetalleMaterial
                        return '<button class="btn-delete" id="eliminarDetalleMaterial" name="'+idDetalleMaterial+'"><i class="fas fa-trash-alt"></i></button>'+
                        '<button class="btn_OtorgarLibro" id="prestarLibro" name="'+idDetalleMaterial+'"style="background: var(--teal-light)"><i class="">Otorgar Libro</i></button>'
                      }}
                    ]
                    break;
                  case parametroDetalleMaterial.PRESTADO:
                    body=[
                      {data:"codePecosa"},
                      { data: null, render: function ( data, type, row ) {
                        return data.firstName+' '+data.LastName;}},
                      {data:"grado"},
                      {data:"section"},
                      {"render":function(data,type,full,meta){
                        var status=full.status
                        if(status==="OCUPADO"){
                          return '<td><div class="inactive">OCUPADO</div></td>'
                        }else{
                          return '<td><div class="available">DISPONIBLE</div></td>'
                        }
                      }},
                      {"render":function(data,type,full,meta){
                        var idDetalleMaterial=full.idDetalleMaterial
                        var idPrestamoDevolucion=full.idPrestamoDevolucion
                        return '<button class="btn_Devolucion" id="modal_devolucion" value="'+idPrestamoDevolucion+'" name="'+idDetalleMaterial+'"style="background: var(--crimson);"><i class="">Devolver</i></button>'
                      }}
                    ]
                    break;
                  case parametroDetalleMaterial.DEVUELTO:
                   body= [
                    { data: null, render: function ( data, type, row ) {
                      return data.firstName+' '+data.LastName;}},
                    {data:"grado"},
                    {data:"section"},
                    {data:"fechaHoraDevolucion"},
                    {"render":function(data,type,full,meta){
                      var idPrestamoDevolucion=full.idPrestamoDevolucion
                      return '<button class="btn_OtorgarLibro" id="modal_motivo" name="'+idPrestamoDevolucion+'"style="background: var(--crimson);"><i class="">Ver Motivo</i></button>'
                    }}
                   ]
                 break;
                 case parametroDetalleMaterial.DANADO:
                  body=[
                    {data:"codigo"},
                    {data:"motivo"},
                    {data:"fechaHoraDevolucion"},
                    {"render":function(data,type,full,meta){
                      var idDetalleMaterial=full.idDetalleMaterial
                      return '<button class="btn-delete" id="eliminarDetalleMaterial" name="'+idDetalleMaterial+'"><i class="fas fa-trash-alt"></i></button>'
                    }}
                  ] 
                break;
                 default:
                 break;
                }
                 return body;

              }

              async function mostrarDetalleMaterial (){
                const listData = await refactorize.getDataController(
                  detalleMaterialURL,GET,
                  detalleMaterialAction(parametroDetalleMaterial.DEFAULT));
                  tableFilterShow(listData,parametroDetalleMaterial.DEFAULT)
              }


})
