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
                    console.log(response);
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


            function graphics(){
              $.ajax({
                  url:"Controller/ControllerDashboard.php",
                  data:{action:"MostrarTotalPrestadosDevueltos"},
              })
              .done(function(responseGrafico){
                const arrayPrestadosDevueltos = JSON.parse(responseGrafico)
              let arrayMeses=[]
              arrayPrestadosDevueltos.forEach((element) => {
                let data = element.mes
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


  });
