function mensajesError(titulo,mensaje){
    Swal.fire({
        title: titulo,
        html: mensaje,
        icon: 'error'
    });
    }

    function mensajesOK(titulo,mensaje){
    Swal.fire({
        title: titulo,
        html: mensaje,
        icon: 'success'
    });
    }