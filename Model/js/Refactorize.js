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