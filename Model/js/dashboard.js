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

 	// mostrarUltimoPagoAPAFA();
    // mostrarUsuarios();
     var url = window.location.href;
    const urlSplit = url.split("/")
        if(urlSplit[4] == "Inicio"){
            mostrarUltimoPagoAPAFA();
            mostrarUsuarios();
             mostrarTotalDeEstuYApo();
             mostrarTotalDeMaterial();
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
  });