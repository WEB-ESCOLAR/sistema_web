$(document).ready(function(){
    const refactorize = new Refactorize();
    const {GET,POST} = refactorize.methodHTTP();
    const {estudianteURL,dashboardURL,usuarioURL} = refactorize.consumeUrl();
    const {SUCCESS,WARNING,ERROR} = refactorize.typeICON();

      //revision here
       async  function mostrarTotalDeEstuYApo(){
                const param = { action:"MostrarNumeroDeSyP" }
                const response  = await refactorize.getDataController(dashboardURL,GET,param);
                  $('#CompCardDashboardTE').text(response.estudiantes);
                 $('#CompCardDashboardTA').text(response.apoderados);
        }
       async function mostrarTotalDeMaterial(){
                const param = { action:"MostrarNumeroDeMaterial" }
                const response  = await refactorize.getDataController(dashboardURL,GET,param);
                   $('#CompCardDashboardTM').text(response.totalDeMateriales);
        }


        //verificar aca
     var url = window.location.href;
    const urlSplit = url.split("/")
        if(urlSplit[4] == "Inicio" || urlSplit[4] == "Home"){
            mostrarUltimoPagoAPAFA();
            mostrarUsuarios();
             mostrarTotalDeEstuYApo();
             mostrarTotalDeMaterial();
             mostrarRegistrosPorNombreyTipo();
             mostrarPagosApafaPorMes();
             graphics();
        }
 	    async function mostrarUltimoPagoAPAFA(){
            const param = { action:"MostrarUltimoPagoApafa" }
            const response  = await refactorize.getDataController(dashboardURL,GET,param);
                   $('#CompLastPayAPAFANameA').text(response.apoderado);
                 $('#CompLastPayAPAFANameE').text(response.estudiante);
                 $('#CompLastPayAPAFAGrade').text(response.grado);
                 $('#CompLastPayAPAFASection').text(response.section);
                 $('#CompLastPayAPAFAFecha').text(response.fechaPago);
        }


       async function mostrarUsuarios(){
        const param = { action:"MostrarUsuario" }
        const response  = await refactorize.getDataController(dashboardURL,GET,param);
        response.forEach((element)=>{
                                    $('#component_litle_table_users').append(
                                        `
                                        <tr>
                                        <td>${element.nombre}</td>
                                        <td>${element.email}</td>
                                        <td>${element.rol}</td>
                                        <td>${element.status  === "off" ? "<div class='inactive'>INACTIVO</div>" : "<div class='available'>DISPONIBLE</div>"} </td>
                                        <td>${element.fecha}</td>
                                        </tr>
                                        `
                                        );
                                 })  
        
            }


      async function mostrarRegistrosPorNombreyTipo(){
        const param = { action:"MostrarTotalRegistrosPorNombreyTipo" }
        const response  = await refactorize.getDataController(dashboardURL,GET,param);
                             response.forEach((element)=>{
                                    $('#component_dualcard_table_one').append(
                                        `
                                        <tr>
                                        <td>${element.grado}</td>
                                        <td>${element.nombre}</td>
                                        <td>${element.tipo}</td>
                                        <td>${element.cantidad}</td>
                                        </tr>
                                        `
                                        );
                                 })
       }

       async function mostrarPagosApafaPorMes(){
        const param = { action:"MostrarTotalPagosApafaPorMes" }
        const response  = await refactorize.getDataController(dashboardURL,GET,param);
        response.forEach((element)=>{
          $('#component_dualcard_table_two').append(
              `
              <tr>
              <td>${conversionName(element.MES)}</td>
              <td>${element.TOTAL}</td>
              </tr>
              `
              );
       })
       }

          function getData(array,type){
              let arrayData=[]
              array.forEach((element)=>{
                let data = type == "PRESTADOS" ?  parseInt(element.PRESTADOS) : parseInt(element.devueltos)
                arrayData.push(data)
              })
              return arrayData;
          }

          async function graphics(){
            const param = { action:"MostrarTotalPrestadosDevueltos" }
            const response  = await refactorize.getDataController(dashboardURL,GET,param);
            let arrayMeses=[]
            let arrayPrestados = getData(response,"PRESTADOS")
            let arrayDevueltos =  getData(response,"DEVUELTOS")
            response.forEach((element) => {
              let data = conversionName(element.mes)  
              arrayMeses.push(data)
            })
              var ctx = document.getElementById('myChart').getContext('2d');
              var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                  labels: arrayMeses,
                  datasets: [{
                    label: 'Prestados',
                    data: arrayPrestados,
                    backgroundColor: ['#4064E3'],
                    borderColor: ['#0c37cc'],
                    borderWidth: 1
                  },{
                    label: 'Devueltos',
                    data: arrayDevueltos,
                    backgroundColor: ['#F47832'],
                    borderColor: ['#d6570f'],
                    borderWidth: 1
                  }]
                },
                  options:{
                    plugins:{
                      title:{
                        display:true,
                        text: 'CANTIDAD DE MATERIALES PRESTADOS Y DEVUELTOS POR MES',
                        fontSize: 20,
                      }
                    },scales:{
                          y:{beginAtZero: true}
                    }, legend:{
                      display:true,
                      position: 'top',
                      align:'right',
                    }
                      }
              })
        }

      
      
        $(document).on('click','#button_Configuracion',async function(e){
          e.preventDefault();
          const password=$('#password').val()
          const password2=$('#contraseña2').val()
          var dataString=$('#configuracionUsuario').serialize();
          console.log("r" + dataString)
          if($("#configuracionUsuario").valid()){
             if( 8 <= password.length ||  8 <= password2.length){
             alertModal("La contraseña debe ser minimo 7 caracteres","Verificar",WARNING);
          }else{
             if(password == password2){
              const param = dataString+"&action=UpdateUsuario"
               const response = await refactorize.getDataController(usuarioURL,POST,param);
               alertModal("Datos Actualizado Correctamente!","",SUCCESS);
               setTimeout(function(){
                    location.reload();
                },2000)
         
            }else{
              alertModal("La contraseña no coinciden","Verificar",WARNING);
            }
          }
          }
         
         
      })

      $('#configuracionUsuario').validate({
        rules: {
          password: { required:true, minlength: 2},
          contraseña2: { required:true, maxlength: 4}
        },
        messages: {
          password : "Contraseña es obligatorio*",
          contraseña2 : "Contraseña secundaria es obligatorio*",
        }
      });



  });
