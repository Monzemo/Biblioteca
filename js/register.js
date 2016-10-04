//Javascript

$(function(){
  // codigo para seleccionar un formulario 
  $('#select_formulario').on('change',function(){
    var selectVal = $("#select_formulario option:selected").val();
    switch (selectVal) {
      case 'admin':
        // code
        ocultarFormularios();
        $('.altas-admin').show();
        break;
        
      case 'alumno':
        // code
        ocultarFormularios();
        $('.altas-alum').show();
        break;
        
      case 'maestro':
        // code
        ocultarFormularios();
        $('.altas-maestros').show();
        break;
        
      case 'externo':
        ocultarFormularios();
        $('.altas-visitas').show();
        // code
        break;
      
      default:
        // code
        ocultarFormularios();
    }
  });
  
  function ocultarFormularios(){
        $('.altas-admin').hide();
        $('.altas-alum').hide();
        $('.altas-maestros').hide();
        $('.altas-visitas').hide();
  }
  
  function limpiarFormularios(){
    $('.altas-admin').trigger("reset");
    $('.altas-alum').trigger("reset");
    $('.altas-maestros').trigger("reset");
    $('.altas-visitas').trigger("reset");
    
  }

  $('#registro-form').submit(function(event){
    event.preventDefault();
    //var data = new FormData($('#registro-administradores')[0]);

    return registrar(new FormData( this ));
  });
  
  function registrar(data){
    $.ajax({
      type:'POST',
      url:'db_register.php',
      data:data,
      processData:false,
      contentType:false,
      beforeSend:function(){
        ocultarFormularios();
        $(".loader").show();
      },
      success: function(data){
        console.log(data);
        if(data=="1"){
          alert("Usuario registrado correctamente");
          $('.loader').hide();
          limpiarFormularios();
        }else{
          console.log(data);
        }
        
      }
    });
    return false;
  }
  });
    