//Javascript for registro.php
$(function(){
    
    $('.elim').click(function(event){
        $("input:checkbox[name=selec]:checked").each(function(){
            if (confirm('¿Seguro que desea eliminar el usuario?')) {
                $.ajax({
                type:'DELETE',
                url:'edit-user-modal.php?user_id='+$(this).val(),
                beforeSend:function(){
                    
                },
                success:function(data){
                    console.log(data);
                    if(data=="1"){
                        alert("Usuario eliminado correctamente");
                        location.reload();
                    }
                }
            })
            } else {
                alert('Eliminacion cancelada.');
            }
            
        })
    })
    
    
    $('.modif').click(function(event){
        $("input:checkbox[name=selec]:checked").each(function(){
            //console.log($(this).val());
            $.ajax({
                type:'POST',
                url:'edit-user-modal.php',
                data:'user_id=' + $(this).val(),
                beforeSend:function(){
                  openVentana(); 
                },
                success:function(data){
                    $('.cs-loader').hide();
                    $('#modal-form').show().html(data);
                }
            })
        });
    });
    

    
    function closeVentana(){
        $(".ventana").slideUp("fast");
    }
    
    $('.cerrar').click(function(){
        console.log("cerrar");
        closeVentana();
    })
    
    function openVentana(){
        $(".ventana").slideDown("slow");
    }
    
    $('input[type="checkbox"]').on('change', function() {
        $('input[type="checkbox"]').not(this).prop('checked', false);
    });
    
    
    
    
});