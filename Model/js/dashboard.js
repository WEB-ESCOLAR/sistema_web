$(document).ready(function(){
	// mostrarUltimoPagoAPAFA();
    // mostrarUsuarios();
        function mostrarTotalDeEstuYApo(){
                // console.log("total estu y apo");
                $.ajax({
                    url:"Controller/ControllerDashboard.php",
                    data:{action:"MostrarNumeroDeSyP"},
                    dataType: 'json',
                })
                .done(function(response){
                  // console.log(response[0]);
                 $('#CompCardDashboardTE').text(response[0].estudiantes);
                 $('#CompCardDashboardTA').text(response[0].apoderados);
               })
        }
        function mostrarTotalDeMaterial(){
                // console.log("total mate");
                $.ajax({
                    url:"Controller/ControllerDashboard.php",
                    data:{action:"MostrarNumeroDeMaterial"},
                    dataType: 'json',
                })
                .done(function(response){
                  // console.log(response[0]);
                 $('#CompCardDashboardTM').text(response[0].totalDeMateriales);
               })
        }
        function mostrarTotalPrestadosDevueltos(){
                // console.log("total mate");
                $.ajax({
                    url:"Controller/ControllerDashboard.php",
                    data:{action:"MostrarTotalPrestadosDevueltos"},
                    dataType: 'json',
                })
                .done(function(responsePrestados){
                  console.log(responsePrestados);
                  //const arrPrestados = JSON.parse(responsePrestados);
                  //console.log("cantidadPrestadosDevueltos" + arrPrestados);
                  })
        }



 	// mostrarUltimoPagoAPAFA();
    // mostrarUsuarios();
     var url = window.location.href;
    const urlSplit = url.split("/")
        if(urlSplit[4] == "Inicio" || urlSplit[4] == "Home"){
            mostrarUltimoPagoAPAFA();
            mostrarUsuarios();
             mostrarTotalDeEstuYApo();
             mostrarTotalDeMaterial();
             mostrarTotalPrestadosDevueltos();
             mostrarRegistrosPorNombreyTipo();
             mostrarPagosApafaPorMes();
             graphics();
        }
 	    function mostrarUltimoPagoAPAFA(){
            // console.log("pago apafita");
                $.ajax({
                    url:"Controller/ControllerDashboard.php",
                    data:{action:"MostrarUltimoPagoApafa"},
                    dataType: 'json',
                })
                .done(function(response){
                  // console.log(response[0]);
                 $('#CompLastPayAPAFANameA').text(response[0].apoderado);
                 $('#CompLastPayAPAFANameE').text(response[0].estudiante);
                 $('#CompLastPayAPAFAGrade').text(response[0].grado);
                 $('#CompLastPayAPAFASection').text(response[0].section);
                 $('#CompLastPayAPAFAFecha').text(response[0].fechaPago);
               })

        }

       function mostrarUsuarios(){
                $.ajax({
                    url:"Controller/ControllerDashboard.php",
                    data:{action:"MostrarUsuario"},
                })
                .done(function(response){
                    // console.log(response);
                    const respuestaArray = JSON.parse(response)
                             respuestaArray.forEach((element)=>{
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
                })
            }

       function mostrarRegistrosPorNombreyTipo(){
                $.ajax({
                    url:"Controller/ControllerDashboard.php",
                    data:{action:"MostrarTotalRegistrosPorNombreyTipo"},
                })
                .done(function(response){
                    console.log("Regitros por Nombre y Tipo"+response)
                    const respuestaArray = JSON.parse(response)
                             respuestaArray.forEach((element)=>{
                                    $('#component_dualcard_table_one').append(
                                        `
                                        <tr>
                                        <td>${element.descripcion}</td>
                                        <td>${element.tipoMaterial}</td>
                                        <td>${element.cantidad}</td>
                                        </tr>
                                        `
                                        );
                                 })
                })
       }

       function mostrarPagosApafaPorMes(){
                $.ajax({
                    url:"Controller/ControllerDashboard.php",
                    data:{action:"MostrarTotalPagosApafaPorMes"},
                })
                .done(function(response){
                    // console.log("Pagos por mes"+response)
                    const respuestaArray = JSON.parse(response)
                             respuestaArray.forEach((element)=>{
                                    $('#component_dualcard_table_two').append(
                                        `
                                        <tr>
                                        <td>${conversionName(element.MES)}</td>
                                        <td>${element.TOTAL}</td>
                                        </tr>
                                        `
                                        );
                                 })
                })
       }


            function graphics(){
              $.ajax({
                  url:"Controller/ControllerDashboard.php",
                  data:{action:"MostrarTotalPrestadosDevueltos"},
              })
              .done(function(responseGrafico){
                const arrayPrestadosDevueltos = JSON.parse(responseGrafico)
              let arrayMeses=[]
              arrayPrestadosDevueltos.forEach((element) => {
                let data = conversionName(element.mes)  
                arrayMeses.push(data)
              })
              console.log(arrayMeses);

              let arrayPrestados=[]
              arrayPrestadosDevueltos.forEach((element) => {

                let data = parseInt(element.PRESTADOS)
                arrayPrestados.push(data)
              })
              console.log(arrayPrestados);

              let arrayDevueltos=[]
              arrayPrestadosDevueltos.forEach((element) => {
                let data = parseInt(element.devueltos)
                arrayDevueltos.push(data)
              })
              console.log(arrayDevueltos);

              //GRAFICO DE BARRAS
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
            })
        }

        
        $(document).on('click','#button_Configuracion',function(e){
          e.preventDefault();
          if($('#contraseña1').val() == $('#contraseña2').val()){
              var dataString=$('#configuracionUsuario').serialize();
              console.log(dataString);
              $.ajax({
                  url:"Controller/ControllerUsuario.php",
                  type:"POST",
                  data:dataString+"&action=UpdateUsuario",
              }).done(function(response){
                  console.log(response);
                  setTimeout(function(){
                      // location.reload();
                      },2000)
              })
          }else{
              console.log('la contraseña no coincide ;V');
          }
      })


  });
