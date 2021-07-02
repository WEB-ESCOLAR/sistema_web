class Refactorize{

    methodHTTP(){
        return{
            POST:"POST",
            GET:"GET"
        }
    }

    typeICON(){
        return{
            SUCCESS:"success",
            ERROR:"error",
            WARNING:"warning"
        }
    }
    // url:"../Controller/ControllerDetalleMaterial.php",

    consumeUrl(){
        // var nameProyect = window.location.pathname.split("/")[1];
        // var origin = window.location.origin
        const controllerDir = "Controller/"
        return{
            estudianteURL: controllerDir + "ControllerEstudiante.php",
            apoderadoURL: controllerDir + "ControllerApoderado.php",
            materialesURL: controllerDir + "ControllerMaterial.php",
            dashboardURL:controllerDir + "ControllerDashboard.php",
            usuarioURL:controllerDir + "ControllerLogin.php",
            detalleMaterialURL: "../"+controllerDir + "ControllerDetalleMaterial.php",
            materialURL2: "../"+controllerDir +  "ControllerMaterial.php",
        }
    }
    showDataForModule(){
        var url = window.location.href;
        const urlModuleName = url.split("/")
        const modulos=["GestionDeMateriales","Apoderados",
        "AdministrarMateriales","Alumnos"]
        modulos.forEach((element)=>{
            if(element == urlModuleName){
                
            }
        })
    }
    convertDatatableSpanish(){
        return{
            "decimal": ",",
            "thousands": ".",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoPostFix": "",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "loadingRecords": "Cargando...",
            "lengthMenu": "Mostrar _MENU_ registros",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "processing": "Procesando...",
            "search": "Buscar:",
            "searchPlaceholder": "Término de búsqueda",
            "zeroRecords": "No se encontraron resultados",
            "emptyTable": "Ningún dato disponible en esta tabla",
            "aria": {
                "sortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sortDescending": ": Activar para ordenar la columna de manera descendente"
            },
            //only works for built-in buttons, not for custom buttons
            "buttons": {
                "create": "Nuevo",
                "edit": "Cambiar",
                "remove": "Borrar",
                "copy": "Copiar",
                "csv": "fichero CSV",
                "excel": "tabla Excel",
                "pdf": "documento PDF",
                "print": "Imprimir",
                "colvis": "Visibilidad columnas",
                "collection": "Colección",
                "upload": "Seleccione fichero...."
            },
            "select": {
                "rows": {
                    _: '%d filas seleccionadas',
                    0: 'clic fila para seleccionar',
                    1: 'una fila seleccionada'
                }
            }
        }
    }

    async getDataController(url,type,parametro){
        const responseAsync = await $.ajax({
          url,dataType:"JSON",type,data:parametro,
         })
         return responseAsync
      }
    // //
    // clickEvent(){
    //     //click
    //     //data dentro ? 
    // }

}