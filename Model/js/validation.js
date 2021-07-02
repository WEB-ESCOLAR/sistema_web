const minDataLength = 5
$('#configuracionUsuario').validate({
    rules: {
      firstName:{ required:true},
      lastName:{required:true},
      password: { required:true, minlength: minDataLength},
      contraseña2: { required:true, minlength: minDataLength}
    },
    messages: {
        firstName:{
            required:"Nombre requerido*",
        },
        lastName:{
            required:"Apellido requerida",
        },
        email:{
            required:"Email requerido*",
        },
      password:{
        required:"Contraseña requerido*",
        minlength:`La contraseña debe de contener minimo de ${minDataLength} caracteres`,
      },
      contraseña2:{
        required:"Repetir Contraseña requerido*",
        minlength:`La contraseña debe de contener minimo de ${minDataLength} caracteres`,
      }
    }
  });


  $('#formulario_apoderado').validate({
    rules:{
      nombre:{required:true, minlength:2,maxlength:30},
      apellido:{required:true, minlength:2,maxlength:30},
      telefono:{required:true, minlength:2,maxlength:9}
    },
    messages:{
      nombre:{
        required:"Nombre requerido*",
        minlength:"Minimo de 2 caracteres",
        maxlength:"Maximo 30 caracteres"
      },
      apellido:{
        required:"Apellido requerido*",
        minlength:"Minimo de 2 caracteres",
        maxlength:"Maximo 30 caracteres"
      },
      telefono:{
        required:"Telefono requerido*",
        minlength:"Minimo de 2 caracteres",
        maxlength:"Maximo 9 caracteres"
      }
    }
});


$('#formulario_alumno').validate({
    rules:{
        Nombre:{required:true, minlength:2,maxlength:30},
        Apellido:{required:true, minlength:2,maxlength:30},
        DNI:{required:true, minlength:2,maxlength:8},
        dni:{required:true, minlength:2,maxlength:8},
        nombre:{required:true, minlength:2,maxlength:30},
      apellido:{required:true, minlength:2,maxlength:30},
      celular:{required:true, minlength:2,maxlength:9},
      Seccion:{required:true},
      Grado:{required:true}
    },
    messages:{
        Nombre:{
        required:"Nombre  requerido*",
        minlength:"Minimo de 2 caracteres",
        maxlength:"Maximo 30 caracteres"
      },
      Apellido:{
        required:"Apellido  requerido*",
        minlength:"Minimo de 2 caracteres",
        maxlength:"Maximo 30 caracteres"
      },
      DNI:{
        required:"DNI  requerido*",
        minlength:"Minimo de 2 caracteres",
        maxlength:"Maximo 8 caracteres"
      },
      dni:{
        required:"DNI apoderado requerido*",
        minlength:"Minimo de 2 caracteres",
        maxlength:"Maximo 8 caracteres"
      },
      nombre:{
        required:"Nombre  requerido*",
        minlength:"Minimo de 2 caracteres",
        maxlength:"Maximo 30 caracteres"
      },
      apellido:{
        required:"Apellido  requerido*",
        minlength:"Minimo de 2 caracteres",
        maxlength:"Maximo 30 caracteres"
      },
      celular:{
        required:"Teléfono  requerido*",
        minlength:"Minimo de 2 caracteres",
        maxlength:"Maximo 9 caracteres"
      },
      Seccion:{
          required:"Seleccion la seccion"
      },
      Grado:{
          required:"Seleccione el grado"
      }
    }
});

$('#formulario_material').validate({
    rules:{
      curso:{required:true},
      grado:{required:true},
      fecha:{required:true},
      cantidad:{required:true, minlength:1,maxlength:2},
      tipo:{required:true},
    //   valueNotEquals: "0"
    },
    messages:{
      curso:{
        required:"Curso requerido"
      },
      grado:{
        required:"Grado requerido"
      },
      fecha:{
        required:"Fecha requerido"
      },
      cantidad:{
        required:"Cantidad requerida"
      },
      tipo:{
        required:"Tipo de material requerido"
      }
    }
});