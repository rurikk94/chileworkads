function eliminarResena(id_resena) {

    var r = confirm("¿Está seguro de eliminarla?");
    if (r == true) {
        $.ajax({
            url: __URL__ + 'api/eliminarResena.php',
            type: 'GET',
            data: { id: id_resena },
            success: function(result) {
                console.log(result);
                alert("Resena Eliminada");
            },
            error: function(xhr) {
                //alert("Ocurrió un error: " + xhr.status + " " + xhr.statusText);
            }
        })
    }
}